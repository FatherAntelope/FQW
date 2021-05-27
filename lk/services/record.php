<?php
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
if (!isset($_COOKIE['user_token']))
    header("Location: /error/401.html");
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";
$user = new User($_COOKIE['user_token']);
if ($user->getUserStatusCode() === 400 || $user->getUserStatusCode() === 403) {
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.html");
}
if (!$user->isUserRole("Patient"))
    header("Location: /error/403.html");

$user_data = $user->getUserData();

$whose_user = 2;
if ($_GET['type'] == 'doctor')
    require $_SERVER['DOCUMENT_ROOT']."/lk/services/record_doctor.php";
elseif ($_GET['type'] == 'procedure')
    require $_SERVER['DOCUMENT_ROOT']."/lk/services/record_procedure.php";
elseif ($_GET['type'] == 'examination')
    require $_SERVER['DOCUMENT_ROOT']."/lk/services/record_examination.php";
elseif ($_GET['type'] == 'event')
    require $_SERVER['DOCUMENT_ROOT']."/lk/services/record_event.php";
else {
    header("Location: /lk/");
    exit;
}
?>