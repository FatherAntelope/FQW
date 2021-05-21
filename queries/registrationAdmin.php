<?php
require $_SERVER['DOCUMENT_ROOT'] . "/functions/curl.php";
//регистрация
$url = 'http://109.68.212.98/api/med/registration';
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
