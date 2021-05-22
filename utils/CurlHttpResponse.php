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
function utils_call_api($url, $config = false) {
    // параметры по умолчанию
    $headers = [];
    $method = 'GET';
    $data = false;

    if (array_key_exists('method', $config)) {
        $method = $config['method'];
        switch($method) {
            case 'POST':
            case 'PUT':
            case 'PATCH':
                $headers[] = 'Content-Type: application/json';
        }
    }
    if (array_key_exists('token', $config)) {
        $headers[] = 'Authorization: Bearer ' . $config['token'];
    }
    if (array_key_exists('data', $config)) {
        $data = $config['data'];
    }

    $curl = curl_init();
    switch ($method) {
        case 'POST':
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            }
            break;
        case 'PUT':
            curl_setopt($curl, CURLOPT_PUT, 1);
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            }
            break;
        case 'PATCH':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
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
?>