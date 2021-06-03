<?php
/**
 * AJAX запрос на удаление профиля пользователя
 */
require $_SERVER['DOCUMENT_ROOT'] . '/utils/CurlHttpResponse.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';

$url = protocol.'://'.domain_name_api.'/api/med/users/'.$_POST['delete_user_id'];
$config = [
    'token' => $_COOKIE['user_token'],
    'method' => 'DELETE'
];
$user = utils_call_api($url, $config);
?>
