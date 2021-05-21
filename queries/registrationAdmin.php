<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/curl.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
//регистрация
$url = "https://".domain_name_api."/api/med/registration";
$method = "POST";
$data = [
    "user" => [
        "email" => "fatherantelope@gmail.com",
        "username" => "FatherAntelope",
        "password" => "24758910",
        "name" => "Владлен",
        "surname" => "Горбунов",
        "patronymic" => "Вячеславович",
        "phone_number" => "+79273208929",
        "role" => "Admin"
    ]
];

$response = utils_call_api($method , $url, $data);
print_r($response->status_code);
print_r($response->data);
?>
