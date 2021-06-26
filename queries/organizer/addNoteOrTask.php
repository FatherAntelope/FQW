<?php
/**
 * Запрос на создание заметки или задачи
 */
if(!isset($_COOKIE['user_token'])) {
    header("Location: /error/403.php");
}
$token = $_COOKIE['user_token'];

require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";

// если идентификатор заметки не был передан, значит
// мы хотим создать новую заметку
if (!isset($_POST['note_id'])) {
    $note_title = $_POST['note_title'];

    $url = api_point('/organizer/notes');
    $config = [
        'method' => 'POST',
        'token' => $token,
        'data' => [
            'title' => $note_title,
        ],
    ];
    $new_note = utils_call_api($url, $config);
    if ($new_note->status_code !== 201) {
        bad_request();
    }
    echo json_encode($new_note->data);
} else {
    $note_id = $_POST['note_id'];
    // чтобы создать задание нужно хотя бы описание
    $task_description = $_POST['task_description'];
    if (isset($_POST['task_status'])) {
        $task_status = $_POST['task_status'];
    } else {
        $task_status = 'Not done';
    }
    $url = api_point('/organizer/notes/'.$note_id.'/tasks');
    $config = [
        'method' => 'POST',
        'token' => $token,
        'data' => [
            'description' => $task_description,
            'status' => $task_status,
        ],
    ];
    $new_task = utils_call_api($url, $config);
    if ($new_task->status_code !== 201) {
        bad_request();
    }
    echo json_encode($new_task->data);
}
