<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
//регистрация
$url = "https://".domain_name_api."/api/med/registration";
$method = "POST";
$data = [
    "user" => [
        "email" => "fatherantelope@gmail.com",
        "password" => "24758910",
        "name" => "Владлен",
        "surname" => "Горбунов",
        "patronymic" => "Вячеславович",
        "phone_number" => "+7 (927) 320-89-29",
        "role" => "Admin"
    ]
];
$response = utils_call_api($method , $url, $data);
print_r($response->status_code);
print_r($response->data['user']['token']);

echo "<br><br>";


$url = "https://".domain_name_api."/api/med/admin";
$data = [
    "admin" => [
        "position" => "Main"
    ]
];
$auth_token = 'Authorization: Bearer '.$response->data['user']['token'];

$response = utils_call_api($method , $url, $data, [$auth_token]);
print_r($response->status_code);
print_r($response->data);

?>
