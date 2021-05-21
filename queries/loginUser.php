<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/curl.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
//авторизация
$url = "https://".domain_name_api."/api/med/users/login";
$method = "POST";
$data = [
    "user" => [
        "email" => $_POST["user_login"],
        "password" => $_POST["user_password"]
    ]
];

$response = utils_call_api($method, $url, $data);
if($response->status_code === 200) {
    setcookie('user_token', $response->data['user']['token'], time()+(60*60*24*30), "/");
} else {
    die(header("HTTP/1.0 400 Bad Request"));
}
?>
