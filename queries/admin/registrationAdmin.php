<?php
/**
 * AJAX запрос на регистрацию пользователя
 * Регистрация администратора
 * Регистрация пациента
 * Регистрация медперсонала
 */
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";

$url = protocol."://".domain_name_api."/api/med/registration";
// Получение сгенерированного пароля в переменную
$password_generate = passwordGenerate();

// Формирование данных пользователя для регистрации
$data = [
    "user" => [
        "email" => "fatherantelope@gmail.com",
        "password" => $password_generate,
        "name" => "Админ",
        "surname" => "Админ",
        "patronymic" => "Админ",
        "phone_number" => "+7 (800) 888-88-88",
        "role" => "Admin",
        "photo" => ""
    ]
];

// Формирование конфига для API
$config = [
    "method" => "POST",
    "data" => $data
];

// Получение данных после запроса к точке API - авторизации пользователя
$user = utils_call_api($url, $config);

// Если HTTP-код 400 (неверный запрос) или 403 (нет доступа доступа) после обращения к API сервера БД,
// то завершаем выполнение скрипта
if($user->status_code === 400 || $user->status_code === 403) {
    die(header("HTTP/1.0 400 Bad Request"));
    exit;
}

$url = protocol."://".domain_name_api."/api/med/admin";
$data = [
    "admin" => [
        "position" => "Main"
    ]
];
$config = [
    "method" => "POST",
    "token" => $user->data['user']['token'],
    "data" => $data
];
$admin = utils_call_api($url, $config);

// Формирование сообщения для отправки пароля на почту зарегистрированного пользователя и его отправка
$message = "Здравствуйте, ".$_POST['user_name']." ".$_POST['user_patronymic']."!";
$message .= "\nВаш пароль для входа в профиль: ".$password_generate;
$message .= "\nПосле входа рекомендуем сменить пароль в настройках на тот, который вы запомните!";
$message .= "\nЕсли вы не регистрировались в системе, то проигнорируйте это сообщение.";
sendMessageToEmail(email_info, "fatherantelope@gmail.com","Пароль доступа к профилю", "Сатурн МИС", "utf-8", $message);
?>