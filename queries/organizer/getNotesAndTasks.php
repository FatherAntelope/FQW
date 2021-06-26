<?php
/**
 * Запрос на возврат информации о всех заметках и задачах пользователя
 */
if(!isset($_COOKIE['user_token'])) {
    header("Location: /error/403.php");
}
$token = $_COOKIE['user_token'];

require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";

$url_user = api_point('/api/med/user');
$user = utils_call_api($url_user, ['token' => $token]);
if ($user->status_code !== 200) {
    bad_request();
}

$url = api_point('/organizer/notes');
$notes = utils_call_api($url, ['token' => $token]);
if ($notes->status_code !== 200) {
    bad_request();
}

$indexed_notes = [];
// для каждой заметки получаем его задачи
for ($i = 0; $i < count($notes->data); $i++) {
    $note = $notes->data[$i];
    // если заметка не наша, то проходим мимо
    if ($note['user'] !== $user->data['user']['id']) {
        continue;
    }
    $url = api_point('/organizer/notes/' . $note['id'] . '/tasks');
    $tasks = utils_call_api($url, ['token' => $token]);

    // перестраиваием массив так, чтобы в качестве
    // ключей стояли идентификаторы заметок, чтобы
    // можно было сразу искать по ключу, а не проходиться по всему
    // массиву в поисках конкретной заметки по его id
    $note_id = $note['id'];
    unset($note['id']);
    $indexed_notes[$note_id] = $note;

    // так же, как и массив заметок перестраиваем массив задач
    $indexed_tasks = [];
    for ($j = 0; $j < count($tasks->data); $j++) {
        $task_id = $tasks->data[$j]['id'];
        unset($tasks->data[$j]['id']);
        $indexed_tasks[$task_id] = $tasks->data[$j];
    }
    // добавляем массив задач в текущую заметку
    $indexed_notes[$note_id]['tasks'] = $indexed_tasks;
}

echo json_encode($indexed_notes);