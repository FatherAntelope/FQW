<?php
/**
 * AJAX Запрос на отправку сообщения на e-почту поддержке приложения
 */
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";
$message = "Сообщение от: ".$_POST['user_name']."\n";
$message.= $_POST['user_message'];
sendMessageToEmail($_POST['user_email'], email_support, "Пример", $_POST['user_email'], "utf-8", $message);
?>