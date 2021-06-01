<?php
/**
 * AJAX запрос на создание услуг
 */
if(!isset($_COOKIE['user_token']))
    header("Location: /error/403.php");

require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";
// Создание услуги
$url = protocol."://".domain_name_api."/api/med/service";
$data = [
    "sanatory" => 1,
    "name" => ucfirst($_POST['service_name']),
    "cost" => $_POST['service_cost']
];
$config = [
    "method" => "POST",
    "data" => $data,
    "token" => $_COOKIE['user_token']
];
$service = utils_call_api($url, $config);
if($service->status_code === 400 || $service->status_code === 403) {
    die(header("HTTP/1.0 400 Bad Request"));
    exit;
}

print_r($_POST);
// Создание специальности от услуги
if($_POST['service_type'] === "speciality") {
    $url = protocol."://".domain_name_api."/api/med/speciality";
    $data = [
        "service" => $service->data['id']
    ];
    $config = [
        "method" => "POST",
        "data" => $data,
        "token" => $_COOKIE['user_token']
    ];
    $speciality = utils_call_api($url, $config);
}

if($_POST['service_type'] === "procedure") {
    $url = protocol."://".domain_name_api."/api/med/procedure";
    $data = [
        "service" => $service->data['id'],
        "photo" => base64_encode(file_get_contents($_FILES['service_photo']['tmp_name'])),
        "description" => $_POST['service_description'],
        "contraindications" => $_POST['procedure_contraindications'],
        "purposes" => $_POST['procedure_destinations'],
        "placement" => $_POST['service_placement']

    ];
    $config = [
        "method" => "POST",
        "data" => $data,
        "token" => $_COOKIE['user_token']
    ];
    $procedure = utils_call_api($url, $config);
}

if($_POST['service_type'] === "examination") {
    $url = protocol."://".domain_name_api."/api/med/survey";
    $data = [
        "service" => $service->data['id'],
        "photo" => base64_encode(file_get_contents($_FILES['service_photo']['tmp_name'])),
        "description" => $_POST['service_description'],
        "purposes" => $_POST['examination_destinations'],
        "placement" => $_POST['service_placement']
    ];
    $config = [
        "method" => "POST",
        "data" => $data,
        "token" => $_COOKIE['user_token']
    ];
    $examination = utils_call_api($url, $config);
}

if($_POST['service_type'] === "event") {
    $url = protocol."://".domain_name_api."/api/med/event";
    $data = [
        "service" => $service->data['id'],
        "photo" => base64_encode(file_get_contents($_FILES['service_photo']['tmp_name'])),
        "description" => $_POST['service_description'],
        "begin_data" => $_POST['event_date_start'],
        "end_data" =>$_POST['event_date_end'],
        "placement" => $_POST['service_placement']
    ];
    $config = [
        "method" => "POST",
        "data" => $data,
        "token" => $_COOKIE['user_token'],

    ];
    $event = utils_call_api($url, $config);
}

// Создание расписания для услуги
$url = protocol."://".domain_name_api."/api/med/timetable";
$data = [
    "service" => $service->data['id'],
    "dates" => null
];
$config = [
    "method" => "POST",
    "data" => $data,
    "token" => $_COOKIE['user_token']
];
$timetable = utils_call_api($url, $config);
?>