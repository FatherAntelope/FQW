<?php
/**
 * AJAX запрос на регистрацию пользователя
 * Регистрация администратора
 * Регистрация пациента
 * Регистрация медперсонала
 */
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
require $_SERVER['DOCUMENT_ROOT']. "/utils/functions.php";

$url = protocol."://".domain_name_api."/api/med/registration";
// Получение сгенерированного пароля в переменную
$password_generate = passwordGenerate();

// Формирование данных пользователя для регистрации
$data = [
    "user" => [
        "email" => $_POST['user_email'],
        "password" => $password_generate,
        "name" => ucfirst(strtolower($_POST['user_name'])),
        "surname" => ucfirst(strtolower($_POST['user_surname'])),
        "patronymic" => ucfirst(strtolower($_POST['user_patronymic'])),
        "phone_number" => $_POST['user_phone'],
        "role" => $_POST['user_role'],
        "photo" => ($_FILES['user_photo']['tmp_name'] !== "") ? base64_encode(file_get_contents($_FILES['user_photo']['tmp_name'])) : ""
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

// Регистрация администратора
if ($_POST['user_role'] === "Admin") {
    $url = protocol."://".domain_name_api."/api/med/admin";
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

// Регистрация пациента
if ($_POST['user_role'] === "Patient") {
    $url = protocol."://".domain_name_api."/api/med/patient";
    $data = [
        "patient" => [
            "birth_date" => $_POST['patient_date_birth'],
            "gender" => $_POST['patient_gender'],
            "region" => $_POST['patient_region'],
            "city" => ucfirst(strtolower($_POST['patient_locality'])),
            "type" => $_POST['patient_category'],
            "complaints" => $_POST['patient_subjective_complaint']
        ]
    ];
    $config = [
        "method" => "POST",
        "token" => $user->data['user']['token'],
        "data" => $data
    ];
    $patient = utils_call_api($url, $config);

    // Запись его паспортных данных в БД
    $url = protocol."://".domain_name_api."/api/med/passport";
    $data = [
        "passport" => [
            "series_number" => $_POST['patient_passport_id'],
            "code" => $_POST['patient_passport_code'],
            "date" => $_POST['patient_passport_date_issue'],
            "by_whom" => $_POST['patient_passport_who_issue']
        ]
    ];
    $config = [
        "method" => "POST",
        "token" => $user->data['user']['token'],
        "data" => $data
    ];
    $passport = utils_call_api($url, $config);
}

// Регистрация медперсонала
if ($_POST['user_role'] === "Doctor") {

}


// Формирование сообщения для отправки пароля на почту зарегистрированного пользователя и его отправка
$message = "Здравствуйте, ".$_POST['user_name']." ".$_POST['user_patronymic']."!";
$message .= "\nВаш пароль для входа в профиль: ".$password_generate;
$message .= "\nПосле входа рекомендуем сменить пароль в настройках на тот, который вы запомните!";
$message .= "\nЕсли вы не регистрировались в системе, то проигнорируйте это сообщение.";
sendMessageToEmail(email_info, $_POST['user_email'],"Пароль доступа к профилю", "Сатурн МИС", "utf-8", $message);
?>