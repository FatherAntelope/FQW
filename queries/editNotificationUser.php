<?php
if(isset($_POST['user_notification'])) {
    echo count($_POST['user_notification']);
} else {
    die(header("HTTP/1.0 400 Bad Request"));
}