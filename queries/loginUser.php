<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/curl.php";
//авторизация
$url = 'http://109.68.212.98/api/med/users/login';
$data = [
    "user" => [
        "email" => $_POST['user_login'],
        "password" => $_POST['user_password']
    ]
];

$response = utils_call_api("POST", $url, $data);

print_r($response->data);
?>
