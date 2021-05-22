<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";
if(!isset($_COOKIE['user_token']))
    header("Location: /error/401.php");
$user = new User($_COOKIE['user_token']);
if($user->getUserStatusCode() === 400) {
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.php");
}
$user_data = $user->getUserData();
$whose_user = $user_data['role'];

if($whose_user === "Admin") {
    $whose_user = 1;
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/settings/settings_admin.php";
} elseif ($whose_user === "Patient") {
    $whose_user = 2;
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/settings/settings_patient.php";
} elseif ($whose_user === "Doctor") {
    $whose_user = 3;
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/settings/settings_doctor.php";
}
?>