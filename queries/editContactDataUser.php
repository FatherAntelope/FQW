<?php
/**
 * AJAX запрос на редактирование контактных данных пользователя
 */
require $_SERVER['DOCUMENT_ROOT'] . '/utils/CurlHttpResponse.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';

$url = protocol.'://'.domain_name_api.'/api/med/user';

$data = [
    'user' => [
        'email' => $_POST['user_email'],
        'phone_number' => $_POST['user_phone']
    ]
];

$token = isset($_COOKIE['user_token']) ? $_COOKIE['user_token'] : '';
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