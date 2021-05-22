<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
require $_SERVER['DOCUMENT_ROOT']. "/utils/functions.php";

$url = "https://".domain_name_api."/api/med/registration";
$method = "POST";
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
$user = utils_call_api($method , $url, $data);
if($user->status_code === 200) {

}


$message = "Ваш пароль: ".$password_generate;
$message .= "\nПосле входа рекомендуем сменить пароль в настройках на тот, который вы запомните!";
sendMessageToEmail("info@fqw.ru", $_POST['user_email'], "Ваш пароль для входа", $message);
?>