<?php
$whose_user = 2;
if($whose_user === 1)
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/profile_admin.php";
elseif ($whose_user === 2)
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/profile_patient.php";
elseif ($whose_user === 3)
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/profile_doctor.php";
?>