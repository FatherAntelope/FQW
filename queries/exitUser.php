<?php
setcookie('USER_ID', '', time() - (60*60*24*30), "/");

header("Location: /");
?>