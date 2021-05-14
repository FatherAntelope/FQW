<?php
if($_POST['user_password'] === '12345') {
    setcookie('USER_ID', "Lol", time()+(60*60*24*30), "/");
} else {
    die(header("HTTP/1.0 400 Bad Request"));
}
?>
