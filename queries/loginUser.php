<?php
require $_SERVER['DOCUMENT_ROOT'] . "/functions/curl.php";
//авторизация
$url = 'http://109.68.212.98/api/med/users/login';
$data = [
    "user" => [
        "email" => $_POST['user_login'],
        "password" => password_hash($_POST['user_password'], PASSWORD_ARGON2I)
    ]
];

$response = utils_call_api("POST", $url, $data);

print_r($response->data);
?>
