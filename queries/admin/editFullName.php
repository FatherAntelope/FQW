<?php
/**
 * AJAX запрос на изменение ФИО администратора
 */

if (!isset($_COOKIE['user_token'])) {
    header("Location: /error/401.php");
}
require $_SERVER['DOCUMENT_ROOT'] . '/utils/CurlHttpResponse.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';

$url = protocol . '://' . domain_name_api . '/api/med/user';

$data = [
    'user' => [
        'name' => $_POST['admin_name'],
        'surname' => $_POST['admin_surname'],
        'patronymic' => $_POST['admin_patronymic']
    ]
];
$config = [
    'method' => 'PUT',
    'data' => $data,
    'token' => $_COOKIE['user_token']
];

$response = utils_call_api($url, $config);
if ($response->status_code === 400 || $response->status_code === 403) {
    die(header("HTTP/1.0 400 Bad Request"));
    exit;
}

?>
