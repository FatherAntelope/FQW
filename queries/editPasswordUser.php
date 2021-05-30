<?php
/**
 * AJAX запрос на редактирование пароля пользователя
 */
require $_SERVER['DOCUMENT_ROOT'] . '/utils/CurlHttpResponse.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';

$url = protocol.'://'.domain_name_api.'/api/med/user';

$token = isset($_COOKIE['user_token']) ? $_COOKIE['user_token'] : '';
$config = [
    'token' => $token
];

$user_data = utils_call_api($url, $config);

$new_password = $_POST['user_new_password'];
$old_password = $_POST['user_old_password'];

// если введенные пароли совпадают
if (strcmp($new_password, $old_password) == 0) {
    die(header("HTTP/1.0 400 Bad Request"));
    exit;
}

// если введенный старый пароль не верный
// Для этой проверки пробуем войти с введенным паролем.
// Если вход прошел успешно, то пароль верный, иначе 400 Bad Request
$login_url = protocol.'://'.domain_name_api.'/api/med/users/login';
$data = [
    'user' => [
        'email' => $user_data->data['user']['email'],
        'password' => $old_password
    ]
];
$config = [
    'method' => 'POST',
    'data' => $data,
];
$login_response = utils_call_api($login_url, $config);
if ($login_response->status_code === 400) {
    die(header("HTTP/1.0 400 Bad Request"));
    exit;
}

// если все ок, то меняем пароль
$data = [
    'user' => [
        'password' => $new_password
    ]
];

$config = [
    'method' => 'PUT',
    'data' => $data,
    'token' => $token
];

$response = utils_call_api($url, $config);
if($response->status_code === 400 || $response->status_code === 403) {
    die(header("HTTP/1.0 400 Bad Request"));
    exit;
}
?>