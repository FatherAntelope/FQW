<?php
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