<?php
if ($_POST['user_email'] === 'mail@mail.ru') {
    setcookie('USER_MAIL', "Lol", time() + (60 * 60 * 24 * 30), "/");
} else {
    die(header("HTTP/1.0 400 Bad Request"));
}
?>