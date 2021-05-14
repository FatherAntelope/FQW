<?php
if($_POST['user_new_password'] === $_POST['user_old_password']) {
    die(header("HTTP/1.0 400 Bad Request"));
} else {
    echo 1234;
}