<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
require $_SERVER['DOCUMENT_ROOT']. "/utils/functions.php";

$url = "https://".domain_name_api."/api/med/registration";
$password_generate = passwordGenerate();

$data = [
    "user" => [
        "email" => $_POST['user_email'],
        "password" => $password_generate,
        "name" => $_POST['user_name'],
        "surname" => $_POST['user_surname'],
        "patronymic" => $_POST['user_patronymic'],
        "phone_number" => $_POST['user_phone'],
        "role" => $_POST['user_role']
    ]
];

$config = [
    "method" => "POST",
    "data" => $data
];

$user = utils_call_api($url, $config);
if($user->status_code === 400) {
    die(header("HTTP/1.0 400 Bad Request"));
}

if ($_POST['user_role'] === "Admin") {
    $url = "https://".domain_name_api."/api/med/admin";
    $method = "POST";
    $data = [
        "admin" => [
            "position" => $_POST['admin_post']
        ]
    ];
    $config = [
        "method" => "POST",
        "token" => $user->data['user']['token'],
        "data" => $data
    ];
    $admin = utils_call_api($url, $config);
}

if ($_POST['user_role'] === "Patient") {

}

if ($_POST['user_role'] === "Doctor") {

}

$message = "Здравствуйте, ".$user->data['user']['name']." ".$user->data['user']['patronymic'];
$message .= "\nВаш пароль для входа в профиль: ".$password_generate;
$message .= "\nПосле входа рекомендуем сменить пароль в настройках на тот, который вы запомните!";
$message .= "\nЕсли вы не регистрировались в системе, то проигнорируйте это сообщение";
sendMessageToEmail("info@fqw.ru", $_POST['user_email'], "Ваш пароль для входа", $message);
echo "<pre>";
print_r($_FILES);
print_r($_POST);
print_r($user->data);
print_r($user->status_code);
?>