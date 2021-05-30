<?php
/**
 * Генерирует пароль
 * @param int $length длина пароля (по умолчанию 8)
 * @return string сгенерированный пароль
 */
function passwordGenerate(int $length = 8): string {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-?\\';
    return substr(str_shuffle($characters), 0, $length);
}

/**
 * Формирует и отправляет сообщение на почту поддержке
 * @param $from string от кого сообщение
 * @param $to string кому сообщение
 * @param $subject string наименование темы
 * @param $name string имя отправителя
 * @param $charset string кодировка сообщения
 * @param $message string сообщение
 */
function sendMessageToEmail(string $from, string $to, string $subject, string $name, string $charset, string $message) {
    //правильное формирование данных для отправки на почту (кодирование, формирование заголовка для HTTP запроса)
    $subject = "=?$charset?B?".base64_encode($subject)."?=";
    $headers = "From: $name <$from>\r\n";
    $headers.= "Reply-to: $from\r\n";
    $headers.= "Content-type: text/plain; charset=$charset\r\n";
    //отправка сообщения на почту
    mail($to, $subject, $message, $headers);
}

/**
 * Кодирует строку в кодировке UTF-8
 * @author https://github.com/akmubi
 * @param string $str строка
 * @return string|false преобразованная строка 
 */
function normJsonStr(string $str) : string {
    $str = preg_replace_callback('/\\\\u([a-f0-9]{4})/i', create_function('$m', 'return chr(hexdec($m[1])-1072+224);'), $str);
    return iconv('cp1251', 'utf-8', $str);
}

/**
 * Формирует и возвращает ссылку на фотографию для верного отображения
 * @param $user_photo string ссылка на фотографию без корневой папки
 * @return string ссылка на базовую фотографию, если отсутствует фотография в БД, иначе ссылка на фотографию из БД
 */
function getUrlUserPhoto ($user_photo) : string {
    return ($user_photo === null) ?  "/images/user.png" : (protocol."://" . domain_name_api . $user_photo);
}

/**
 * Формирует и возвращает код роли пользователя
 * @param $user_role string роль пользователя
 * @return int код роли пользователя
 * @example Аdmin 1
 * @example Patient 2
 * @example Doctor 3
 * @example other 0
 */
function getUserRoleCode(string $user_role) : int {
    if($user_role === "Admin")
        return 1;
    if ($user_role === "Patient")
        return 2;
    if ($user_role === "Doctor")
        return 3;
    return 0;
}
?>
