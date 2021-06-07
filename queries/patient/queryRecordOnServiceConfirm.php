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
 * @param int time_offset смещение по времени (в минутах). ТОЛЬКО ДЛЯ ВРЕМЕНИ!
 * @return string дата и время в iso формате (yyyy-mm-ddThh:mm:ssZ)
 */
function construct_datetime(string $datetime_string, int $time_offset = 0) : string {
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

$doctor_id = $_POST['record_id_doctor'];

// нужны данные по этой услуге (в частности её название)
$url = api_point('/api/med/service/'.$_POST['record_id_service']);
$config = [
    'method' => 'GET',
    'token' => $token,
];
$service = utils_call_api($url, $config);
if ($service->status_code !== 200) {
    bad_request();
}

$service_id = $service->data['id'];

// Создание записи
$url = api_point('/organizer/records');
$config = [
    'method' => 'POST',
    'token' => $token,
    'data' => [
        'name' => $service->data['name'],
        'date_start' => construct_datetime($_POST['record_time']),
        // смещение в 15 минут
        'date_end' => construct_datetime($_POST['record_time'], 15),
    ],
];
$record = utils_call_api($url, $config);

// если запись не создалась, то виним в этом отправителя
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
