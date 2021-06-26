<?php
/**
 * Запрос на изменение данных заметки или задачи
 */
if(!isset($_COOKIE['user_token'])) {
    header("Location: /error/403.php");
}
$token = $_COOKIE['user_token'];

require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";

$note_id = $_POST['note_id'];
$data = [];

// не обязательные поля - заголовок заметки и дата создания заметки
if (isset($_POST['note_title'])) {
    $data['title'] = $_POST['note_title'];
}

if (isset($_POST['note_date_of_creation'])) {
    $data['date_of_creation'] = $_POST['note_date_of_creation'];
}

// если был передан не только идентификатор заметки, значит мы
// хотим изменить эту заметку
if (!empty($data)) {
    $url = api_point('/organizer/notes/'. $note_id);
    $config = [
        'method' => 'PATCH',
        'token' => $token,
        'data' => $data,
    ];
    $updated_note = utils_call_api($url, $config);
    if ($updated_note->status_code !== 200) {
        bad_request();
    }
}

// если был передан идентификатор задачи, значит мы
// хотим изменить эту задачу
if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    // не обязательные поля - статус и описание заметки
    $data = [];
    if (isset($_POST['task_description'])) {
        $data['description'] = $_POST['task_description'];
    }
    if (isset($_POST['task_status'])) {
        $data['status'] = $_POST['task_status'];
    }

    $url = api_point('/organizer/notes/'.$note_id.'/tasks/'.$task_id);
    $config = [
        'method' => 'PATCH',
        'token' => $token,
        'data' => $data,
    ];
    $updated_task = utils_call_api($url, $config);
    if ($updated_task->status_code === 404) {
        not_found();
    } elseif ($updated_task->status_code !== 200) {
        bad_request();
    }
}

echo json_encode([]);