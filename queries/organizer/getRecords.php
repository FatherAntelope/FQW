<?php
/**
 * Запрос на возврат всех записей пациента
 */
if(!isset($_COOKIE['user_token'])) {
    header("Location: /error/403.php");
}
$token = $_COOKIE['user_token'];

require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";

// достаём всех пациентов, если id пациента не был предоставлен
if (isset($_POST['patient_id'])) {
    $patient_id = $_POST['patient_id'];
} else {
    $url_patient = api_point('/api/med/patient');
    $patient = utils_call_api($url_patient, ['token' => $token]);
    if ($patient->status_code !== 200) {
        bad_request();
    }

    $patient_id = $patient->data['id'];
}

// только предопределенные типы услуг
$service_type = $_POST['service_type'] ?? '';

// нужно для фильтрации услуг, так как в таблице с записями
// отсутствует тип услуги. Приходится использовать фильтрацию,
// чтобы не было пересечения с другими записями и однозначной
// идентификации типа услуги
$url_filter = '';
switch ($service_type) {
    case 'procedure':
        $url_filter = '?service_type=Procedure';
        break;
    case 'doctor':
        $url_filter = '?service_type=Speciality';
        break;
    case 'survey':
        $url_filter = '?service_type=Survey';
        break;
    case 'event':
        $url_filter = '?service_type=Event';
        break;
}

/**
 * Перестраивает массив так, чтобы в качестве ключей стояли идентификаторы
 * @param array $collection массив данных с одним из полей id, нужных для перестройки
 * @return array перестроенный массив
 */
function make_indexed_array(array $collection) : array {
    $indexed_collection = [];
    for ($i = 0; $i < count($collection); $i++) {
        $id = $collection[$i]['id'];
        unset($collection[$i]['id']);
        $indexed_collection[$id] = $collection[$i];
    }
    return $indexed_collection;
}

/**
 * Отнимает часы из даты в формате ISO
 * @param string $iso_date_string строка с датой в формате ISO
 * @param int $hours количество часов, которые необходимо отнять
 * @return string строка с измененной датой в формате ISO, в которой были отняты часы
 */
function iso_date_sub_hour(string $iso_date_string, int $hours) : string {
    try {
        $date = new DateTime($iso_date_string);
        $date->sub(new DateInterval('PT'.$hours.'H'));
        return $date->format('Y-m-d') . 'T' . $date->format('H:i:s') . 'Z';

    } catch (Exception $e) {
        return $iso_date_string;
    }
}

/**
 * Добавляет часы в дату в формате ISO
 * @param string $iso_date_string строка с датой в формате ISO
 * @param int $hours количество часов, которые необходимо прибавить
 * @return string строка с измененной датой в формате ISO, в которой были прибавлены часы
 * @throws Exception ошибка чтения даты или количества часов
 */
function iso_date_add_hour(string $iso_date_string, int $hours) : string {
    try {
        $date = new DateTime($iso_date_string);
        $date->add(new DateInterval('PT'.$hours.'H'));
        return $date->format('Y-m-d') . 'T' . $date->format('H:i:s') . 'Z';
    } catch (Exception $e) {
        return $iso_date_string;
    }
}


// в зависимости от часового пояса, клиент может отправить дату
// с знаком '+' или '-', означающей добавление или вычитание последующего времени
$separator = '';
if (isset($_POST['start']) && isset($_POST['end'])) {
    if (strpos($_POST['start'], '+') !== false and strpos($_POST['end'], '+') !== false) {
        $separator = '+';
    } elseif (strpos($_POST['start'], '-') !== false and strpos($_POST['end'], '-') !== false) {
        $separator = '-';
    }

    // по последующему времени определяем часовой пояс, чтобы
    // при отправке данных обратно клиенту его учитывать
    if ($separator !== '') {
        $date_start = explode($separator, $_POST['start'])[0];
        $date_end = explode($separator, $_POST['end'])[0];

        $time_zone = explode(':', explode($separator, $_POST['start'])[1])[0];
    } else {
        $date_start = $_POST['start'];
        $date_end = $_POST['end'];
        $time_zone = 0;
    }

    // выборка записей только из конкретно заданного интервала
    $url_filter .= '&date_start__gte=' . $date_start;
    $url_filter .= '&date_end__lte=' . $date_end;
}

// Запись
$url = protocol.'://'.domain_name_api.'/organizer/records' . $url_filter;
$records = utils_call_api($url, ['token' => $token]);
if ($records->status_code !== 200) {
    bad_request();
}

$filtered_records = [];
for ($i = 0; $i < count($records->data); $i++) {
    $record = $records->data[$i];
    if ($record['patient'] == $patient_id) {
        $filtered_records[$record['id']] = $record;
    }
}

// Запись-Услуга
$url = protocol.'://'.domain_name_api.'/organizer/service_records' . $url_filter;
$service_records = utils_call_api($url, ['token' => $token]);
if ($service_records->status_code !== 200) {
    bad_request();
}
$indexed_service_records = make_indexed_array($service_records->data);

// Запись-Услуга-Медперсона
if ($service_type === 'doctor') {
    $url = protocol.'://'.domain_name_api.'/organizer/medpersona_service_records';
    $medpersona_service_records = utils_call_api($url, ['token' => $token]);
    if ($medpersona_service_records->status_code !== 200) {
        bad_request();
    }
    for ($i = 0; $i < count($medpersona_service_records->data); $i++) {
        $medpersona_service_record = $medpersona_service_records->data[$i];
        $record_service_id = $medpersona_service_record['record_service'];
        if (array_key_exists($record_service_id, $indexed_service_records)) {
            $indexed_service_records[$record_service_id]['medpersona_service_record'] = $medpersona_service_record;
        }
    }
}

for ($i = 0; $i < count($service_records->data); $i++) {
    $service_record = $service_records->data[$i];
    $record_id = $service_record['record'];
    if (array_key_exists($record_id, $filtered_records)) {
        $filtered_records[$record_id]['service_record'] = $indexed_service_records[$service_record['id']];
    }
}

// Услуги
$url = api_point('/api/med/service' . $url_filter);
$services = utils_call_api($url, ['token' => $token]);
if ($services->status_code !== 200) {
    bad_request();
}
$indexed_services = make_indexed_array($services->data);

header('Content-Type: application/json');
$json_response = [];
foreach ($filtered_records as $record_id => $record) {
    $event = [];
    $event['id'] = $record_id;
    $event['title'] = $record['name'];
    if ($separator === '+') {
        $event['start'] = iso_date_sub_hour($record['date_start'], intval($time_zone));
        $event['end'] = iso_date_sub_hour($record['date_end'], intval($time_zone));
        $event['date_of_creation'] = iso_date_sub_hour($record['date_of_creation'], intval($time_zone));
    } elseif ($separator === '-') {
        $event['start'] = iso_date_add_hour($record['date_start'], intval($time_zone));
        $event['end'] = iso_date_add_hour($record['date_end'], intval($time_zone));
        $event['date_of_creation'] = iso_date_add_hour($record['date_of_creation'], intval($time_zone));
    } else {
        $event['start'] = $record['date_start'];
        $event['end'] = $record['date_end'];
        $event['date_of_creation'] = $record['date_of_creation'];
    }
    $event['editable'] = $record['editable'];
    $event['description'] = $record['description'];
    $event['service_type'] = $service_type;
    if (array_key_exists('service_record', $record)) {
        $service_id = $record['service_record']['service'];
        $event['cost'] = $indexed_services[$service_id]['cost'];
        $event['service_id'] = $service_id;
        if (array_key_exists('medpersona_service_record', $record['service_record'])) {
            $event['medpersona_id'] = $record['service_record']['medpersona_service_record']['medpersona'];
        }
    }
    $json_response[] = $event;
}
echo json_encode($json_response);


