<?php
$whose_user = 2;
if($whose_user === 1)
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/settings/settings_admin.php";
elseif ($whose_user === 2)
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/settings/settings_patient.php";
elseif ($whose_user === 3)
    require $_SERVER['DOCUMENT_ROOT'] . "/lk/settings/settings_doctor.php";
?>