<?php
/**
 * Запрос на возврат деталей услуги для конкретной записи
 */
if(!isset($_COOKIE['user_token'])) {
    header("Location: /error/403.php");
}
$token = $_COOKIE['user_token'];

require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";

/**
 * Отправляет запрос на сервер для получения данных специалистов конкретной услуги
 * @param int $service_id идентификатор услуги
 * @param string $token токен пользователя
 * @return array ФИО специалистов услуги в качестве данных и статус ответа
 */
function get_doctors_name(int $service_id, string $token) : array {
    $response = [];
    $status_code = 200;

    $url = api_point('/api/med/service/' . $service_id . '/servicemedper');
    $service_doctor = utils_call_api($url, ['token' => $token]);
    if ($service_doctor->status_code !== 200) {
        $status_code = $service_doctor->status_code;
    }
    // Сохраняем идентификаторы всех докторов
    for ($i = 0; $i < count($service_doctor->data); $i++) {
        // Достаем идентификаторы пользователей для докторов
        $doctor_id = $service_doctor->data[$i]['medpersona'];
        $url = api_point('/api/med/medics/' . $doctor_id);
        $doctor_info = utils_call_api($url, ['token' => $token]);
        if ($doctor_info->status_code !== 200) {
            continue;
        }
        $user_id = $doctor_info->data['user'];

        // Достаем ФИО пользователя
        $url = api_point('/api/med/users/' . $user_id);
        $user_info = utils_call_api($url, ['token'=> $token]);
        if ($user_info->status_code !== 200) {
            continue;
        }
        $response['doctors'][$doctor_id]['name'] = $user_info->data['user']['name'];
        $response['doctors'][$doctor_id]['surname'] = $user_info->data['user']['surname'];
        $response['doctors'][$doctor_id]['patronymic'] = $user_info->data['user']['patronymic'];
    }
    return [
        'data' => $response,
        'status_code' => $status_code,
    ];
}

$service_type = $_POST['service_type'];
$service_id = $_POST['service_id'];

function get_service_detail(string $service_type, int $service_id, string $token) : array {
    $url = api_point('/api/med/service/'.$service_id.'/');

    $response = [];
    switch ($service_type) {
        case 'doctor': {
            // для услуги специалиста достается специализация и его ФИО
            $doctor_id = $_POST['doctor_id'];
            $url = api_point('/api/med/medics/' . $doctor_id);
            $doctor_info = utils_call_api($url, ['token' => $token]);
            if ($doctor_info->status_code === 404) {
                not_found();
            } elseif ($doctor_info->status_code !== 200) {
                bad_request();
            }
            $response['id'] = $doctor_id;
            $response['specialization'] = $doctor_info->data['specialization'];

            $url = api_point('/api/med/users/' . $doctor_info->data['user']);
            $user_info = utils_call_api($url, ['token' => $token]);
            if ($user_info->status_code !== 200) {
                bad_request();
            }
            $response['doctor']['name'] = $user_info->data['user']['name'];
            $response['doctor']['surname'] = $user_info->data['user']['surname'];
            $response['doctor']['patronymic'] = $user_info->data['user']['patronymic'];

            break;
        }
        case 'procedure': {
            // специфичные поля для процедуры
        }
        case 'survey':
        {
            // достаются ФИО специалистов, предоставляющих данную услугу
            $response = get_doctors_name($service_id, $token);
            if ($response['status_code'] === 404) {
                not_found();
            } elseif ($response['status_code'] !== 200) {
                bad_request();
            }
            $response = $response['data'];
        }
        case 'event': {
            // общее для процедуры, обследования и мероприятия данные
            $url .= $service_type;
            $service = utils_call_api($url, ['token' => $token]);
            if ($service->status_code === 404) {
                not_found();
            } elseif ($service->status_code !== 200) {
                bad_request();
            }
            $response['id'] = $service->data['id'];
            $response['location'] = $service->data['placement'];
            break;
        }
    }
    return $response;
}

echo normJsonStr(json_encode(get_service_detail($service_type, $service_id, $token)));

