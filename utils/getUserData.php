<?php
if(!isset($_COOKIE['user_token']))
    header("Location: /auth.php");

require $_SERVER['DOCUMENT_ROOT'] . "/utils/curl.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";

$url = "https://".domain_name_api."/api/med/user";
$method = "GET";
$auth_token = 'Authorization: Bearer '.$_COOKIE['user_token'];
$user_data = utils_call_api($method, $url, null, [$auth_token]);
if($user_data->status_code === 400) {
    setcookie('user_token', '', 0, "/");
    header("Location: /auth.php");
}

?>