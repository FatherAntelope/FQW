<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/curl.php";
//регистрация
$url = "https://".domain_name_api."/api/med/registration";
$data = [
    "user" => [
        "email" => "gorbunov.vladlen2014@gmail.com",
        "username" => "Admin",
        "password" => "123456789",
        "name" => "Владлен",
        "surname" => "Горбунов",
        "patronymic" => "Вячеславович",
        "phone_number" => "+79273208929",
        "role" => "Admin"
    ]
];

$response = utils_call_api("POST", $url, $data);
echo "<pre>";
print_r($response->data);
print_r($response->data->token);
echo "</pre>";
?>
