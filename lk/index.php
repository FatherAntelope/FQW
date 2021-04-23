<?php
$whoseProfile = 1;
if($whoseProfile === 1)
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/profile_admin.php";
elseif ($whoseProfile === 2)
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/profile_patient.php";
elseif ($whoseProfile === 3)
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/profile_doctor.php";
?>