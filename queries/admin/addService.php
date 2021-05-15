<?php
if($_POST['service_name'] === 'Специальность') {
    echo '123';
} else {
    die(header("HTTP/1.0 400 Bad Request"));
}
//print_r($_POST);