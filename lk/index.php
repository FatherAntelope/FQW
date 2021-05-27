<?php
/**
 * Загружает соответствующую страницу роли страницу (модуль) профиля.
 * Проводит проверку доступа.
 */
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';

// Если токен авторизованного пользователя не существует, то направляет на страницу ошибки 401 (нет авторизации)
if(!isset($_COOKIE['user_token']))
    header("Location: /error/401.html");
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";

// Выгрузка данных пользователя
$user = new User($_COOKIE['user_token']);

// Если HTTP-код после обращения к выгрузке данных пользователя по API 400 или 403, то ...
if($user->getUserStatusCode() === 400 || $user->getUserStatusCode() === 403) {
    //Очищаются Cookie и происходит направление на страницу авторизации
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.html");
}
$user_data = $user->getUserData();
$whose_user = getUserRoleCode($user_data['role']);

if($whose_user === 1) {
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/profile_admin.php";
} elseif ($whose_user === 2) {
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/profile_patient.php";
} elseif ($whose_user === 3) {
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/profile_doctor.php";
}
?>