<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/getUserData.php";

$whose_user = $user_data->data['user']['role'];

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