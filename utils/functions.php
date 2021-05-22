<?php
function passwordGenerate(int $length = 8): string {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-?\\';
    $password = substr(str_shuffle($characters), 0, $length);
    return $password;
}

function sendMessageToEmail($from, $to, $subject, $message) {
    $headers = "From: FQW.ru <$from>\r\nContent-type: text/plain; charset=windows-1251 \r\n";
    mail($to, $subject, $message, $headers);
}


