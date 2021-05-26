<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";
$message = "Сообщение от: ".$_POST['user_name']."\n";
$message.= $_POST['user_message'];
sendMessageToEmail($_POST['user_email'], email_support,"Сообщение от пользователя", $_POST['user_email'], "utf-8", $message);
?>