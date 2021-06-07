<?php
if (!isset($_COOKIE['user_token'])) {
    header("Location: /error/401.php");
}
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
require $_SERVER['DOCUMENT_ROOT']. "/utils/functions.php";

$url = protocol."://".domain_name_api."/api/med/medicpatient";
$data = [
    "medpersona" => $_POST['doctor_id'],
    "patient" => $_POST['patient_id']
];
$config = [
    "method" => "POST",
    "token" => $_COOKIE['user_token'],
    "data" => $data
];
$medicpatient = utils_call_api($url, $config);
?>