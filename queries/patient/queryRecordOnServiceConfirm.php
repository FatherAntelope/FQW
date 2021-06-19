<?php
if (!isset($_COOKIE['user_token'])) {
    header("Location: /error/401.php");
}
$token = $_COOKIE['user_token'];

require $_SERVER['DOCUMENT_ROOT'] . '/utils/CurlHttpResponse.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';

/**
 * Строит дату и время в iso формате (yyyy-mm-ddThh:mm:ssZ)
 * @param string $datetime_string дата и время в формате dd.mm w hh.mm
 * @param int $time_offset смещение по времени (в минутах). ТОЛЬКО ДЛЯ ВРЕМЕНИ! ДАТЫ НЕ КАСАЕТСЯ!
 * @return string дата и время в iso формате (yyyy-mm-ddThh:mm:ssZ)
 */
function construct_datetime(string $datetime_string, int $time_offset = 0) : string {
    // текущий год
    $year = date('Y');

    // дата и время dd.mm w hh:mm
    $datetime_parts = explode(' ', $datetime_string);

    // время hh:mm
    $time = $datetime_parts[count($datetime_parts) - 1];
    $time_parts = explode(':', $time);
    $hour = $time_parts[0];
    $minute = $time_parts[1];

    // расчет смещения
    $mod = ($minute + $time_offset) % 60;
    $div = intval(($minute + $time_offset) / 60);

    $hour = ($hour + $div) % 24;
    $minute = $mod;

    $time = sprintf("%'.02d", $hour) . ':' . sprintf("%'.02d", $minute) . ':00';

    // день и месяц dd.mm
    $day_month_parts = explode('.', $datetime_parts[0]);
    $day = $day_month_parts[0];
    $month = $day_month_parts[1];

    // yyyy-mm-ddT(tt:tt):00Z;
    // пример: 2021-06-07T08:00:00Z
    return $year.'-'.$month.'-'.$day.'T'.$time.'Z';
}

// Общие для каждой из услуг поля
$service_type = $_POST['record_service_type'];
$service_id = $_POST['record_id_service'];
$time = $_POST['record_time'];

// возможные варианты типов услуг
$allowed_service_types = ['doctor', 'procedure', 'survey', 'event'];

// если переданный тип не соответствует ожидаемым типам, то bad request
if (!in_array($service_type, $allowed_service_types)) {
    bad_request();
}

// нужны данные по этой услуге (в частности её название)
$url = api_point('/api/med/service/'.$service_id);
$config = [
    'method' => 'GET',
    'token' => $token,
];
$service = utils_call_api($url, $config);
if ($service->status_code !== 200) {
    bad_request();
}

$service_name = $service->data['name'];

// Поскольку мы точно знаем, что переданный тип точно соответствует
// одному из существующих, то мы с уверенностью можем создать запись и
// запись-услугу до начала работы с конкретными типами услуг

// Создание записи
$url = api_point('/organizer/records');
$config = [
    'method' => 'POST',
    'token' => $token,
    'data' => [
        'name' => $service_name,
        'date_start' => construct_datetime($time),
        // смещение в 15 минут
        'date_end' => construct_datetime($time, 15),
    ],
];
$record = utils_call_api($url, $config);
// если запись не создалась, то bad request
if ($record->status_code !== 201) {
    bad_request();
}
$record_id = $record->data['id'];

// Создание запись-услуги
$url = api_point('/organizer/service_records');
$config = [
    'method' => 'POST',
    'token' => $token,
    'data' => [
        'record' => $record_id,
        'service' => $service_id,
    ],
];
$service_record = utils_call_api($url, $config);
if ($service_record->status_code !== 201) {
    bad_request();
}

switch ($service_type) {
    case 'doctor': {
        // сначала нужно убедиться, что данная услуга является
        // не процедурой, не мероприятием и не обследованием
        // Это можно сделать с помощью фильтра услуг
        // (оставить только специальности). Если среди них не будет нашей услуги, \
        // значит для нее мы не создаем связку запись-услуга-медперсонал
        $url = api_point('/api/med/service?service_type=Speciality');
        $specialities = utils_call_api($url, ['token' => $token]);
        if ($specialities->status_code !== 200) {
            bad_request();
        }

        $need_creation = false;
        for ($i = 0; $i < count($specialities->data); $i++) {
            $speciality = $specialities->data[$i];
            if ($speciality['id'] == $service_id) {
                $need_creation = true;
                break;
            }
        }

        if ($need_creation) {
            // необходим id врача
            $doctor_id = $_POST['record_id_doctor'];

            // Создание запись-услуги-медперсоны
            $url = api_point('/organizer/medpersona_service_records');
            $config = [
                'method' => 'POST',
                'token' => $token,
                'data' => [
                    'record_service' => $service_record->data['id'],
                    'medpersona' => $doctor_id,
                ],
            ];
            $medpersona_service_record = utils_call_api($url, $config);
            if ($medpersona_service_record->status_code !== 201) {
                bad_request();
            }
        }
        break;
    }
    // на данный момент никаких необходимых исключительных действий
    // для следующих типов услуг нет
    case 'procedure':
    case 'survey':
    case 'event':
        break;
    default:
        bad_request();
}

// Создание/Изменение расписания

// пытаемся найти уже существующее расписание услуги
$url = api_point('/api/med/timetable?service='.$service_id);
$config = [
    'method' => 'GET',
    'token' => $token
];
$timetable = utils_call_api($url, $config);
// если тело ответа - пустое, то это означает, что у услуги
// на данный момент нет никакого расписания (а можно было бы и
// сделать так, что при добавлении новой услуги, создавалось и
// его расписание)
if (empty($timetable->data)) {
    // создание нового расписания для услуги
    $url = api_point('/api/med/timetable');
    $config = [
        'method' => 'POST',
        'token' => $token,
        'data' => [
            'service' => $service_id,
            'dates' => [
                // начальная дата - первая запись на услугу
                construct_datetime($time),
            ],
        ],
    ];
    $new_timetable = utils_call_api($url, $config);
    // если что-то при создании пошло не так, bad request
    if ($new_timetable->status_code !== 201) {
        bad_request();
    }
    // если же расписание уже существует, то нам остаётся
    // лишь обновить данные добавлением новой даты созданной
    // записи
} else {
    $timetable_id = $timetable->data[0]['id'];
    // добавление новой даты в список уже существующих
    // data[0] поскольку данные возвращаются в виде массива, даже
    // если поиск по конкретной услуге всегда должен давать одно
    // расписание :D
    $existed_dates = $timetable->data[0]['dates'];
    $existed_dates[] = construct_datetime($time);

    $url = api_point('/api/med/timetable/'.$timetable_id);
    $config = [
        'method' => 'PATCH',
        'token' => $token,
        'data' => [
            'dates' => $existed_dates,
        ],
    ];
    $updated_timetable = utils_call_api($url, $config);
    if ($updated_timetable->status_code !== 200) {
        bad_request();
    }
}
