<?php

class CurlHttpResponse {
    public $data;
    public $status_code;

    function __construct($response_data, $status_code) {
        $this->data = $response_data;
        $this->status_code = $status_code;
    }
}

// отправляет и принимает данные только в формате json
function utils_call_api($method, $url, $data = false,
                        $headers = array('Content-Type: application/json')) {
    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            }
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            }
            break;
        // GET, DELETE методы
        default:
            if ($data) {
                $url = sprintf("%s?%s", $url, http_build_query($data));
            }
    }
    // установка параметров
    curl_setopt($curl, CURLOPT_URL, $url);
    // возврат в виде строки
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    // авторизация
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    $result = curl_exec($curl);
    if (!$result) {
        die("Connection Failure");
    }

    $content_type = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
    if ($content_type !== null) {
        // если тип содержимого - json, то декодируем
        if (strpos($content_type, "application/json") !== false) {
            $result = json_decode($result, true);
        }
    }

    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    return new CurlHttpResponse($result, $status_code);
}

$data = [
    "user" => [
        "email" => "gorbunov12151.vladl@gmail.com",
        // "username" => "Admin1214",
        "password" => "123456781325230",
        // "name" => "Владлен",
        // "surname" => "Горбунов",
        // "patronymic" => "Вячеславович",
        // "phone_number" => "+79273208929",
        // "role" => "Admin"
    ]
];

// Пример использования:
$url = 'https://530083-cu85770.tmweb.ru/api/med/users/login';

$response = utils_call_api("POST", $url, $data);

print_r($response->data);
echo 'Status code: ', $response->status_code;

?>