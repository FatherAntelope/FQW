<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
//регистрация
$url = "https://".domain_name_api."/api/med/registration";
$data = [
    "user" => [
        "email" => "gorbunov.vladlen2014@gmail.com",
        "password" => "24758910",
        "name" => "Владлен",
        "surname" => "Горбунов",
        "patronymic" => "Вячеславович",
        "phone_number" => "+7 (927) 320-89-29",
        "role" => "Admin"
    ]
];

$config = [
    "method" => "POST",
    "data" => $data
];

$user = utils_call_api($url, $config);
if($user->status_code === 400) {
    die(header("HTTP/1.0 400 Bad Request"));
}

$url = "https://".domain_name_api."/api/med/admin";
$method = "POST";
$data = [
    "admin" => [
        "position" => $_POST['admin_post']
    ]
];
$config = [
    "method" => "POST",
    "token" => $user->data['user']['token'],
    "data" => $data
];
$response = utils_call_api($url, $config);

//$url = "https://".domain_name_api."/api/med/patient";
//$method = "POST";
//$data = [
//    "patient" => [
//        "birth_date" => "1999-03-23",
//        "gender" => "Male",
//        "region" => "Республика Башкортостан",
//        "city" => "Уфа",
//        "bonus" => "Unknown",
//        "status" => "Accept",
//        "api_tracker" => "xxxxxxxx",
//        "type" => "Vacationer",
//        "group" => "Диабетик",
//        "complaints" => "..."
//    ]
//];

//$url = "https://".domain_name_api."/api/med/admin";
//$method = "POST";
//$data = [
//    "admin" => [
//        "position" => "Main"
//    ]
//];


//$auth_token = 'Authorization: Bearer '.$token;
//
//$response = utils_call_api($method , $url, $data, [$auth_token]);
//print_r($response->status_code);
//print_r($response->data);

?>
