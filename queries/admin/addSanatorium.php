<?php
/**
 * AJAX запрос на создание санатория
 */
if(!isset($_COOKIE['user_token']))
    header("Location: /error/403.php");

require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";


$url = protocol."://".domain_name_api."/api/med/sanatorium";

// Формирование данных для регистрации санатория
$data = [
    "name" => "Янган-Тау",
    "email" => "market@yantau.ru",
    "phone_number" => "8 (800) 707-50-14",
    "address" => "село Янгантау"
];

// Формирование конфига для API
$config = [
    "method" => "POST",
    "data" => $data,
    "token" => $_COOKIE['user_token']
];
$response = utils_call_api($url, $config);
print_r($response);

?>