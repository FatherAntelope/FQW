<?php
if(!isset($_COOKIE['user_token'])) {
    header("Location: /error/403.php");
}
$token = $_COOKIE['user_token'];

require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";

$note_id = $_POST['note_id'];

// если передался идентификатор задачи, значит мы хотим её удалить
if (isset($_POST['task_id'])) {
    $url = api_point('/organizer/notes/' . $note_id . '/tasks/' . $_POST['task_id']);
    $config = [
        'method' => 'DELETE',
        'token' => $token,
    ];
    $task = utils_call_api($url, $config);
    if ($task->status_code !== 204) {
        bad_request();
    }
} else {
    // иначе хотим удалить именно заметку
    $url = api_point('/organizer/notes/' . $note_id);
    $config = [
        'method' => 'DELETE',
        'token' => $token,
    ];
    $note = utils_call_api($url, $config);
    if ($note->status_code !== 204) {
        bad_request();
    }
}

echo json_encode([]);