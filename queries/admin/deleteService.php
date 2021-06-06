<?php
/**
 * AJAX запрос на удаление услуги
 */
require $_SERVER['DOCUMENT_ROOT'] . '/utils/CurlHttpResponse.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';

$url = protocol.'://'.domain_name_api.'/api/med/service/'.$_POST['delete_service_id'];
$config = [
    'token' => $_COOKIE['user_token'],
    'method' => 'DELETE'
];
$service = utils_call_api($url, $config);
?>
