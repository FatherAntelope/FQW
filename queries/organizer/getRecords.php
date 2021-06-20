<?php
if(!isset($_COOKIE['user_token'])) {
    header("Location: /error/403.php");
}
$token = $_COOKIE['user_token'];

require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";

$service_type = '';
if (isset($_POST['service_type'])) {
    $service_type = $_POST['service_type'];
} else {
    bad_request();
}

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
    default:
        bad_request();
}

function make_indexed_array(array $collection) : array {
    $indexed_collection = [];
    for ($i = 0; $i < count($collection); $i++) {
        $id = $collection[$i]['id'];
        unset($collection[$i]['id']);
        $indexed_collection[$id] = $collection[$i];
    }
    return $indexed_collection;
}

function iso_date_sub_hour(string $iso_date_string, int $hours) : string {
    $date = new DateTime($iso_date_string);
    $date->sub(new DateInterval('PT'.$hours.'H'));
    return $date->format('Y-m-d') . 'T' . $date->format('H:i:s') . 'Z';
}
function iso_date_add_hour(string $iso_date_string, int $hours) : string {
    $date = new DateTime($iso_date_string);
    $date->add(new DateInterval('PT'.$hours.'H'));
    return $date->format('Y-m-d') . 'T' . $date->format('H:i:s') . 'Z';
}

$separator = '';
if (strpos($_POST['start'], '+') !== false and strpos($_POST['end'], '+') !== false) {
    $separator = '+';
} elseif (strpos($_POST['start'], '-') !== false and strpos($_POST['end'], '-') !== false) {
    $separator = '-';
}

if ($separator !== '') {
    $date_start = explode($separator, $_POST['start'])[0];
    $date_end = explode($separator, $_POST['end'])[0];

    $time_zone = explode(':', explode($separator, $_POST['start'])[1])[0];
} else {
    $date_start = $_POST['start'];
    $date_end = $_POST['end'];
    $time_zone = 0;
}

$url_filter .= '&date_start__gte=' . $date_start;
$url_filter .= '&date_end__lte=' . $date_end;

// Запись
$url = protocol.'://'.domain_name_api.'/organizer/records' . $url_filter;
$records = utils_call_api($url, ['token' => $token]);
if ($records->status_code !== 200) {
    bad_request();
}
$indexed_records = make_indexed_array($records->data);

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
    if (array_key_exists($record_id, $indexed_records)) {
        $indexed_records[$record_id]['service_record'] = $indexed_service_records[$service_record['id']];
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
for ($i = 0; $i < count($records->data); $i++) {
    $event = [];
    $record = $indexed_records[$records->data[$i]['id']];
    $event['id'] = $records->data[$i]['id'];
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
        $event['start'] =$record['date_start'];
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
echo normJsonStr(json_encode($json_response));
