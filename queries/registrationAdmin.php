<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
//регистрация
//$url = "https://".domain_name_api."/api/med/registration";
//$method = "POST";
//$data = [
//    "user" => [
//        "email" => "fatherantelope@gmail.com",
//        "password" => "24758910",
//        "name" => "Владлен",
//        "surname" => "Горбунов",
//        "patronymic" => "Вячеславович",
//        "phone_number" => "+7 (927) 320-89-29",
//        "role" => "Admin"
//    ]
//];
//$response = utils_call_api($method , $url, $data);
//print_r($response->status_code);
//print_r($response->data['user']['token']);

//$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MjMsImV4cCI6MTYyMTc4NDE0OX0.MkBpmCHiUncwCxopD3AcQxCfa1MKkgZ_riZA8LJ_2lM";
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

$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MjMsImV4cCI6MTYyMTc4NDE0OX0.MkBpmCHiUncwCxopD3AcQxCfa1MKkgZ_riZA8LJ_2lM";
$url = "https://".domain_name_api."/api/med/admin";
$method = "POST";
$data = [
    "admin" => [
        "position" => "Main"
    ]
];


$auth_token = 'Authorization: Bearer '.$token;

$response = utils_call_api($method , $url, $data, [$auth_token]);
print_r($response->status_code);
print_r($response->data);

?>
