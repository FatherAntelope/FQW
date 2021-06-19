<?php
if (!isset($_COOKIE['user_token']))
    header("Location: /error/401.php");
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";
$user = new User($_COOKIE['user_token']);
if ($user->getStatusCode() === 400 || $user->getStatusCode() === 403) {
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.php");
}
if ($user->isUserRole("Patient"))
    $whose_user = 2;
elseif ($user->isUserRole("Admin"))
    $whose_user = 1;
else
    header("Location: /error/403.php");

$user_data = $user->getData();

if ($_GET['type'] == 'doctor' && isset($_GET['id']))
    require $_SERVER['DOCUMENT_ROOT']."/lk/services/record_doctor.php";
elseif ($_GET['type'] == 'procedure')
    require $_SERVER['DOCUMENT_ROOT']."/lk/services/record_procedure.php";
elseif ($_GET['type'] == 'survey')
    require $_SERVER['DOCUMENT_ROOT']."/lk/services/record_examination.php";
elseif ($_GET['type'] == 'event')
    require $_SERVER['DOCUMENT_ROOT']."/lk/services/record_event.php";
else {
    header("Location: /lk/");
    exit;
}
?>