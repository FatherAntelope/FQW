<?php
/**
 * AJAX запрос на редактирование контактных данных пользователя
 */
require $_SERVER['DOCUMENT_ROOT'] . '/utils/CurlHttpResponse.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';

$url = protocol.'://'.domain_name_api.'/api/med/user';
$user_email = '';
$user_phone = '';
if (array_key_exists('user_phone', $_POST)) {
    $user_email = $_POST['user_email'];
}
if (array_key_exists('user_email', $_POST)) {
    $user_phone = $_POST['user_phone'];
}


$data = [
    'user' => [
        'email' => $user_email,
        'phone_number' => $user_phone
    ]
];

$token = '';
if (array_key_exists('user_token', $_COOKIE)) {
    $token = $_COOKIE['user_token'];
}

$config = [
    'method' => 'PUT',
    'data' => $data,
    'token' => $token
];

 $response = utils_call_api($url, $config);
if($response->status_code !== 200) {
    die(header("HTTP/1.0 400 Bad Request"));
//    echo json_encode(array('success' => 1));
//} else {
//    echo json_encode(array('success' => 0));
}

?>