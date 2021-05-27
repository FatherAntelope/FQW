<?php
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
if(!isset($_COOKIE['user_token']))
    header("Location: /error/401.php");
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";
$user = new User($_COOKIE['user_token']);
if($user->getUserStatusCode() === 400 || $user->getUserStatusCode() === 403) {
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.php");
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