<?php
/**
 * Загружает соответствующий по роли пользователя профиль.
 * Проводит проверку доступа.
 */

// Если токен авторизованного пользователя не существует, то направляет на страницу ошибки 401 (нет авторизации)
if(!isset($_COOKIE['user_token']))
    header("Location: /error/401.php");
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";

// Выгрузка данных пользователя
$user = new User($_COOKIE['user_token']);

// Если HTTP-код после обращения к выгрузке данных пользователя по API 400 или 403, то ...
if($user->getStatusCode() === 400 || $user->getStatusCode() === 403) {
    //Очищаются Cookie и происходит направление на страницу авторизации
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.php");
}
$user_data = $user->getData();
$whose_user = getUserRoleCode($user_data['role']);

if($whose_user === 1) {
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/settings/settings_admin.php";
} elseif ($whose_user === 2) {
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/settings/settings_patient.php";
} elseif ($whose_user === 3) {
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/settings/settings_doctor.php";
}
?>
