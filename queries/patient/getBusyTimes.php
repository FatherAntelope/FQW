<?php
if (!isset($_COOKIE['user_token'])) {
    header("Location: /error/401.php");
}
$token = $_COOKIE['user_token'];

require $_SERVER['DOCUMENT_ROOT'] . '/utils/CurlHttpResponse.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';

/**
 * Извлекает дату и время в формате dd.mm hh:mm из даты в iso формате (yyy-mm-ddThh:mm:ssZ)
 * @param string $datetime_string дата и время в формате в iso формате
 * @return array дата и время в формате dd.mm hh:mm
 */
function get_date_and_time(string $datetime_string) : array {
    // разделяем дату и время на отдельные части (yyyy-mm-dd и hh:mm:ssZ)
    $datetime_parts = explode('T', $datetime_string);
    $date = $datetime_parts[0];
    // избавляемся от символа Z в конце
    $time = rtrim($datetime_parts[1], 'Z ');

    // дата yyyy-mm-dd
    $date_parts = explode('-', $date);
    $month = $date_parts[1];
    $day = $date_parts[2];

    // время hh:mm
    $time_parts = explode(':', $time);
    $hour = $time_parts[0];
    $minute = $time_parts[1];

    return ["$day.$month", "$hour:$minute"];
}

//if (!isset($_POST['date_start']) or !isset($_POST['date_end']))
//    bad_request();
$service_id = $_POST['record_id_service'];

$url = api_point('/api/med/timetable?service='.$service_id);
$config = [
    'method' => 'GET',
    'token' => $token,
];
$timetable = utils_call_api($url, $config);
if ($timetable->status_code !== 200) {
    bad_request();
}

$dates = [];
if (!empty($timetable->data)) {
    $dates = $timetable->data[0]['dates'];
}

$converted_dates = [];
for ($i = 0; $i < count($dates); $i++) {
    $date_time_parts = get_date_and_time($dates[$i]);
    $date = $date_time_parts[0];
    $time = $date_time_parts[1];
    $converted_dates[$date][] = $time;
}
echo json_encode($converted_dates);