<?php

/**
 * Представляет собой структуру ответа от сервера
 * @author https://github.com/akmubi
 */
class CurlHttpResponse {

    /** @var $data тело ответа */
    public $data;
    /** @var int $status_code код состояния */
    public $status_code;

    function __construct($response_data, $status_code) {
        $this->data = $response_data;
        $this->status_code = $status_code;
    }
}
 
/**
 * Отправляет запрос во данному адресу
 * @author https://github.com/akmubi
 * @param string $url адрес, куда отправляется запрос
 * @param $config - конфигурация запроса. Включает в себя такие настройки, как:
 *  + метод (GET, POST, PUT, PATCH, DELETE)
 *  + токен аутентификации (Bearer Token)
 *  + данные (тело) запроса
 * @return CurlHttpResponse полученный ответ
 */
function utils_call_api($url, $config = false): CurlHttpResponse {
    // параметры по умолчанию
    $content_type = [];
    $headers = [];
    $method = 'GET';
    $data = false;

    if ($config !== false) {
        if (array_key_exists('method', $config)) {
            $method = $config['method'];
            switch($method) {
                case 'POST':
                case 'PUT':
                case 'PATCH':
                    $content_type[] = 'application/json';
            }
        }
        if (array_key_exists('token', $config)) {
            $token = $config['token'];
            if (strlen($token) != 0) {
                $headers[] = 'Authorization: Bearer ' . $token;
            }
        }
        if (array_key_exists('data', $config)) {
            $data = $config['data'];
        }
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
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
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
        case 'DELETE':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
//            if ($data) {
//                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
//            }
            break;
        // GET метод
        default:
            if ($data) {
                $url = sprintf("%s?%s", $url, http_build_query($data));
            }
    }
    // установка параметров
    curl_setopt($curl, CURLOPT_URL, $url);
    // возврат в виде строки
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

    if (count($content_type) > 0) {
        $content_type_str = 'Content-Type: ';
        for ($i = 0; $i < count($content_type); $i++) {
            $content_type_str .= $content_type[$i];
            if ($i != count($content_type) - 1) {
                $content_type_str .= '; ';
            }
        }
        $headers[] = $content_type_str;
    }

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    // авторизация
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    $result = curl_exec($curl);
    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ( ($status_code - 200) < 0 or ($status_code - 200) >= 100) {
        header('Location: /error/502.php');
        exit();
    }

    $content_type = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
    if ($content_type !== null) {
        // если тип содержимого - json, то декодируем
        if (strpos($content_type, "application/json") !== false) {
            $result = json_decode($result, true);
        }
    }

    curl_close($curl);
    return new CurlHttpResponse($result, $status_code);
}
?>