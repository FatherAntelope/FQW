<?php
/**
 * AJAX запрос на редактирование уведомлений пользователя
 */
//Если не выбран ни 1 параметр, то вернет ошибку
if(!isset($_POST['user_notification'])) {
    die(header("HTTP/1.0 400 Bad Request"));
}
// /* НЕ ГОТОВО!!! РЕАЛИЗАЦИИ УВЕДОМЛЕНИЙ ЕЩЁ НЕТ!!! */
// require $_SERVER['DOCUMENT_ROOT'] . '/utils/CurlHttpResponse.php';
// require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';

// $url = protocol.'://'.domain_name_api.'/api/med/user/notification_settings';

// $notification_time = 5;
// // $notification_time = $_POST['']

// $data = [
//     'settings' => [
//         'time' => $notification_time;
//     ]
// ];

// $token = isset($_COOKIE['user_token']) ? $_COOKIE['user_token'] : '';
// $config = [
//     'method' => 'PUT',
//     'data' => $data,
//     'token' => $token
// ];

// $response = utils_call_api($url, $config);
// if($response->status_code === 400 || $response->status_code === 403) {
//     die(header("HTTP/1.0 400 Bad Request"));
//     exit;
// }
?>