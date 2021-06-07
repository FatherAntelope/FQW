<?php
if (!isset($_COOKIE['user_token'])) {
    header("Location: /error/401.php");
}
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
require $_SERVER['DOCUMENT_ROOT']. "/utils/functions.php";

$url = protocol."://".domain_name_api."/api/med/medicpatient?patient=".$_POST['patient_id'];
$config = [
    "method" => "DELETE",
    "token" => $_COOKIE['user_token'],
];
$medicpatient = utils_call_api($url, $config);
?>