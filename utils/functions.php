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

function normJsonStr($str){
    $str = preg_replace_callback('/\\\\u([a-f0-9]{4})/i', create_function('$m', 'return chr(hexdec($m[1])-1072+224);'), $str);
    return iconv('cp1251', 'utf-8', $str);
}

function getUrlUserPhoto ($user_photo) : string {
    return ($user_photo === null) ?  "/images/user.png" : ("https://" . domain_name_api . $user_photo);
}

