<?php
require $_SERVER['DOCUMENT_ROOT'] . "/queries/utils.php";
//авторизация
$url = 'http://109.68.212.98/api/med/users/login';
$data = [
    "user" => [
        "email" => $_POST['user_login'],
        "password" => password_hash($_POST['user_password'], PASSWORD_ARGON2I)
    ]
];

//регистрация
$url1 = 'http://109.68.212.98/api/med/registration';
$data1 = [
    "user" => [
        "email" => "mail@mail.ru",
        "username" => "Vladlen",
        "password" => "123456789",
        "firstName" => "Владлен",
        "secondName" => "Горбунов",
        "thirdName" => "Вячеславович",
        "phone_number" => "+79273208929",
        "role" => "Patient"
    ]
];

$response = utils_call_api("POST", $url, $data);

print_r($response->data);
?>
