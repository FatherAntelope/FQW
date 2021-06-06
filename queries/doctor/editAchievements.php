<?php
if (!isset($_COOKIE['user_token'])) {
    header("Location: /error/401.php");
}
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
require $_SERVER['DOCUMENT_ROOT']. "/utils/functions.php";

$url = protocol."://".domain_name_api."/api/med/medpersona";
$data = [
    "medpersona" => [
        "education" => $_POST['doctor_education_json'],
        "specialization" => $_POST['doctor_specialization'],
    ]
];
$config = [
    "method" => "PATCH",
    "token" => $_COOKIE['user_token'],
    "data" => $data
];
$doctor = utils_call_api($url, $config);
