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
 * Формирует полный путь к ресурсу по относительному адресу
 * @param $relative_address относительный адрес ресурса
 * @return string полный адрес ресурса
 */
function api_point(string $relative_address) : string {
    return protocol . '://' . domain_name_api . $relative_address;
}


/**
 * Отправляет заголовок со статусом 400 и закрывает подключение
 */
function bad_request() {
    header('HTTP/1.0 400 Bad Request');
    die();
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

/**
 * Принимает ФИО и возвращает инициалы
 *
 * @param string $surname фамилия
 * @param string $name имя
 * @param $patronymic null|string отчество
 * @return string инициалы
 */
function getItitialsFullName(string $surname, string $name, $patronymic) : string {
    return $surname." ".mb_substr($name,0,1,'UTF-8'). ". ".mb_substr($patronymic,0,1,'UTF-8').".";
}

/**
 * Перевод категории пользователя на русский из базы данных
 * @param string $patient_category_en
 * @return string русский перевод категории пользователя
 */
function getPatientCategoryRu(string $patient_category_en) : string {
    if($patient_category_en == "Treating")
        return "Лечащийся";
    if ($patient_category_en == "Vacationer")
        return "Отдыхающий";
    if ($patient_category_en == "Discharged")
        return "Выписан";
    return "Данная категория не найдена";
}

function getPatientGenderRu(string $patient_gender_en) : string{
    return ($patient_gender_en == "Male") ? $patient_gender = "Мужской" : $patient_gender = "Женский";
}

function getAdminPositionRu(string $admin_position_en) : string {
    if($admin_position_en == "Main")
        return "Главный администратор";
    if ($admin_position_en == "Registrar")
        return "Регистратор";
    if ($admin_position_en == "Maintenance")
        return"Управляющий услугами";
    return "Данная должность не найдена";
}

function getDoctorPositionRu(string $doctor_position_en) : string {
    if($doctor_position_en == "Specialist")
        return "Специалист по услугам";
    if ($doctor_position_en == "Doctor")
        return "Врач";
    return "Данная должность не найдена";
}

function getDoctorQualificationRu(int $doctor_qualification_med) : string {
    if($doctor_qualification_med == 0)
        return "Без категории";
    if ($doctor_qualification_med == 1)
        return "Первая";
    if($doctor_qualification_med == 2)
        return "Вторая";
    if ($doctor_qualification_med == 3)
        return "Высшая";
    return "Данная категория не найдена";
}

function getTextYear($year) {
    $year = abs($year);
    $t1 = $year % 10;
    $t2 = $year % 100;
    return ($t1 == 1 && $t2 != 11 ? "год" : ($t1 >= 2 && $t1 <= 4 && ($t2 < 10 || $t2 >= 20) ? "года" : "лет"));
}
?>
