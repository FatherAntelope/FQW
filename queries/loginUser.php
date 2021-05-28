<?php
/**
 * AJAX Запрос на авторизацию пользователя
 * @api отправка логина и пароля, получение токена пользователя при успехе
 */
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";

$url = protocol."://".domain_name_api."/api/med/users/login";
$data = [
    "user" => [
        "email" => $_POST["user_login"],
        "password" => $_POST["user_password"]
    ]
];

$config = [
    "method" => "POST",
    "data" => $data
];

$response = utils_call_api($url, $config);
/**
 * Если вернулся HTTP-код 200 и роль у пользователя указана (существует) роль, то создаем кукки с токеном пользователя
 * Иначе вызов ошибки 400 и прекращение выполнения скрипта
 */
if($response->status_code === 200 && $response->data['user']['role'] !== "") {
    setcookie('user_token', $response->data['user']['token'], time()+(60*60*24*30), "/");
} else {
    die(header("HTTP/1.0 400 Bad Request"));
}
?>
