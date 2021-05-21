<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/curl.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
//авторизация
$url = "http://".domain_name_api."/api/med/users/login";
$method = "POST";
$data = [
    "user" => [
        "email" => "",
        "password" => ""
    ]
];

$response = utils_call_api($method, $url, $data);
print_r($response->data);
?>
