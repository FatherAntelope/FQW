<?php

if(!isset($_COOKIE['user_token'])) {
    header("Location: /error/401.php");
}

require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";

$token = $_COOKIE['user_token'];
$user = new User($token);

if($user->getStatusCode() === 400 || $user->getStatusCode() === 403) {
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.php");
}
$user_data = $user->getData();

if(!$user->isUserRole("Patient"))
    header("Location: /error/403.php");

$whose_user = 2;
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/images/logo-mini.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/organizer/style.css">
<!--    <link rel="stylesheet" href="/css/font-awesome.css">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>

    <link href='/css/fullcalendar/main.css' rel='stylesheet' />
    <script src='/js/fullcalendar/main.js'></script>
    <title>СанКонтроль</title>
    <style>
        .fc-event{
            cursor: pointer;
        }

        .title-editable {
            background-color: #f7f7f7;
            border: 1px solid #f7f7f7;
        }

        .calendar-spinner {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 200px;
            left: 0;
            opacity: 0.7;
            z-index: 99;
        }
    </style>
</head>
<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>

<!--Основной контент страницы-->
<div class="page-content">
    <div class="container pt-3 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/lk/" style="color: var(--dark-cyan-color)">Профиль</a></li>
                <li class="breadcrumb-item active" aria-current="page">Органайзер</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card border-info">
                    <div class="card-header">Календарь</div>
                    <div class="card-body">
                        <!-- Значок загрузки календаря -->
                        <div class="calendar-spinner" id="calendar_spinner">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border text-info m-5" style="width: 10rem; height: 10rem;" role="status"></div>
                            </div>
                        </div>
                        <!-- Календарь -->
                        <div id="calendar_content">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 m-5">
                <div class="card border-warning">
                    <div class="card-header">Заметки и задания</div>
                    <div class="card-body">
                        <div class="notes-and-tasks-spinner">
                            <!-- Значок загрузки -->
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border text-warning m-5" style="width: 10rem; height: 10rem;" role="status"></div>
                            </div>

                        </div>
                        <div class="notes-and-tasks-content" style="display: none">
                            <!-- Поле для создания нвоой заметки -->
                            <div class="note-creation-row">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group input-group-lg">
                                            <input type="text" class="form-control" id="note-title-input" aria-label="Text input with checkbox" placeholder="Заголовок новой заметки" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-warning" type="button" id="note-create-button">Добавить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="alert alert-danger fade show" style="display: none" role="alert" id="note-empty-title-alert">
                                            Введите заголовок заметки!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Список всплывающих уведомлений-->
<div class="position-fixed p-3" style="z-index: 5; right: 0; bottom: 0;">
    <!--Всплывающее уведомление-->
    <div id="notificationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header">
            <strong class="mr-auto" style="color: var(--cyan-color)">
                <i class="fas fa-bell mr-2"></i> "Название уведомления"
            </strong>
            <small>"Время"</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad at atque cumque delectus dolore ea enim nam porro, qui repellat.
        </div>
    </div>
</div>

<!--Модальное окно c деталями записи-->
<div class="modal fade" id="event_detail_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Заголовок -->
            <div class="modal-header" id="event_modal_header" style="display: none">
                <div class="modal-title">
                    <h3 class="record_field" style="color: var(--dark-cyan-color)" id="record_name"></h3>
                    <span class="text-muted record_field" id="service_type"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Значок загрузки -->
            <div id="modal_preloader" >
                <div class="d-flex justify-content-center">
                    <div class="spinner-border text-info m-5" role="status"></div>
                </div>
            </div>

            <!-- Тело -->
            <div id="event_modal_body" class="modal-body" style="display: none">
                <!--                <div class="alert alert-success mt-3" role="alert" style="font-size: 12px" id="alertSuccessRecordOnServiceConfirm" hidden>-->
                <!--                    Вы успешно записались к врачу!-->
                <!--                </div>-->
                <div>
                    <!-- Уникальные поля для процедуры -->
                    <div class="optional_info record_field" id="event_procedure" hidden>
                        <p class="text-muted record_field" id="event_recommendation_type">Рекомендация:
                        <!-- badge-success/badge-danger -->
                        <span class="badge badge-secondary" id="event_recommendation_type_text">не обязательно</span>
                        </p>
                        <p class="text-muted record_field">Специалисты:<br>
                            <div id="event_specialists"></div>
                        </p>
                        <p class="text-muted record_field" id="event_location">Расположение:
                        <span style="color: var(--cyan-color)" id="event_location_text"></span>
                        </p>
                    </div>
                    <!-- Уникальные поля для мероприятия -->
                    <div class="optional_info" id="event_event" hidden>
                        <p class="text-muted record_field" id="event_location">Место встречи:
                        <span style="color: var(--cyan-color)" id="event_location_text"></span>
                        </p>
                    </div>
                    <!-- Уникальные поля для обследования -->
                    <div class="optional_info" id="event_survey" hidden>
                        <p class="text-muted record_field">Специалисты:<br>
                            <div id="event_specialists"></div>
                        </p>
                        <p class="text-muted record_field" id="event_location">Расположение:
                        <span style="color: var(--cyan-color)" id="event_location_text"></span>
                        </p>
                    </div>
                    <!-- Уникальные поля для врача -->
                    <div class="optional_info" id="event_doctor" hidden>
                        <p class="text-muted record_field">Врач:
                        <span style="color: var(--cyan-color)" id="event_doctor_name"></span>
                        </p>
                        <p class="text-muted record_field">Специализация:
                        <span style="color: var(--cyan-color)" id="event_doctor_specialization"></span>
                        </p>
                    </div>
                    <p class="text-muted record_field" id="event_start_date">Начало:
                    <span style="color: var(--cyan-color)" id="event_start_date_value"></span>
                    </p>
                    <p class="text-muted record_field" id="event_end_date">Окончание:
                    <span style="color: var(--cyan-color)" id="event_end_date_value"></span>
                    </p>
                    <p class="text-muted record_field" id="event_creation_date">Дата и время создания:
                    <span style="color: var(--cyan-color)" id="event_creation_date_value"></span>
                    </p>
                    <p class="text-muted optional_info record_field" id="event_description" hidden>Описание:
                    <span style="color: var(--cyan-color)" id="event_description_text"></span>
                    </p>
                    <p class="text-muted record_field" id="event_cost">Стоимость услуги:
                    <span style="color: var(--cyan-color)" id="event_cost_value"></span>
                    </p>
                    <!--                    <div class="alert alert-secondary" style="font-size: 12px">-->
                    <!--                        Правило: <br>-->
                    <!--                        Если не сможете посетить услугу в выбранное время, пожалуйста, отмените прием-->
                    <!--                    </div>-->
                </div>
                <div class="alert alert-danger optional_info" id="event_error_message" style="font-size: 12px" hidden>
                    Что-то пошло не так. Обратитесь в службу поддержки
                </div>
            </div>

            <!-- Нижняя часть -->
            <div class="modal-footer justify-content-md-end optional_info" id="event_modal_footer" style="display: none">
                <button id="service_redirect_button" type="submit" class="btn btn-info text-white" style="background-color: var(--cyan-color)" form="queryRecordOnServiceConfirm">
                    <i class="fas fa-edit"></i> Перейти на страницу услуги/врача
                </button>
            </div>
        </div>
    </div>
</div>

<!--Футер (нижний блок)-->
<?php require $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</body>

<script>
    function create_row_from_template() {
        return $('<div class="row note-row mt-5"></div>');
    }

    function create_col_from_template(id) {
        return $(`
            <div class="note-col col-6" style="display: none" id="${id}">
                <div class="card">
                    <div class="card-header">
                        <div class="input-group note-title" data-toggle="tooltip" data-delay="100">
                            <input class="form-control title-editable" type="text" placeholder="Заголовок заметки">
                            <div class="input-group-append note-edit-apply" style="display: none">
                                <button class="btn btn-outline-success note-edit-apply-button" type="button" id="${id}">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </div>
                            <div class="input-group-append note-edit-cancel" style="display: none">
                                <button class="btn btn-outline-danger note-edit-cancel-button" type="button" id="${id}">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body note-tasks">
                        <div class="task-creation">
                            <hr/>
                            <div class="input-group">
                                <input type="text" class="form-control task-create-input" placeholder="Новое задание" id="${id}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success task-create-button" type="button" id="${id}">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="alert alert-danger fade show mt-3" style="display: none" role="alert" id="task-empty-alert">Введите описание задания</div>
                        </div>
                    </div>
                </div>
            </div>
        `);
    }

    function create_task_from_template(status, description, id) {
        return $(`
            <div class="input-group mb-2 task-content" style="display: none" id="${id}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input task-status" id="checkbox-${id}" ${status === 'Done' ? 'checked' : ''}>
                            <label class="custom-control-label" for="checkbox-${id}"></label>
                        </div>
                    </div>
                </div>

                <input type="text" class="form-control task-content-input" id="${id}">
                <div class="input-group-append task-edit-apply" style="display: none;">
                    <button class="btn btn-outline-success task-edit-apply-button" type="button" id="${id}">
                        <i class="bi bi-check-lg"></i>
                    </button>
                </div>
                <div class="input-group-append task-edit-cancel" style="display: none;">
                    <button class="btn btn-outline-danger task-edit-cancel-button" type="button" id="${id}">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
        `);
    }


    function change_note(note_id, title) {
        $.ajax({
            url: '/queries/organizer/changeNoteOrTask.php',
            method: 'POST',
            dataType: 'json',
            data: {
                note_id: note_id,
                note_title: title
            },
            // success: function(data) {
            //     // add_note(data['title'], data['id']);
            // },
            // error: function() {
            //     // alert('error while creating note');
            // }
        });
    }

    function delete_note(note_id) {
        $.ajax({
            url: '/queries/organizer/deleteNoteOrTask.php',
            method: 'POST',
            dataType: 'json',
            data: {
                note_id: note_id
            },
            success: function(data) {
                let note_to_remove = $('#' + note_id + '.note-col');
                let current_row = note_to_remove.parent();
                if (current_row.find('.note-col').length === 1) {
                    current_row.remove();
                } else {
                    note_to_remove.remove();
                }
            },
            // error: function() {
            //     // alert('error while creating note');
            // }
        });
    }



    function change_task(note_id, task_id, description, status) {
        $.ajax({
            url: '/queries/organizer/changeNoteOrTask.php',
            method: 'POST',
            dataType: 'json',
            data: {
                note_id: note_id,
                task_id: task_id,
                task_status: status,
                task_description: description
            },
            // success: function(data) {
            //     // add_task(data['status'], data['description'], data['id'], note_id);
            // },
            // error: function(xhr, text, third) {
            //     alert('error while changing note');
            //     console.log(xhr);
            //     console.log(text);
            //     console.log(third);
            // }
        });
    }

    function delete_task(note_id, task_id) {
        $.ajax({
            url: '/queries/organizer/deleteNoteOrTask.php',
            method: 'POST',
            dataType: 'json',
            data: {
                note_id: note_id,
                task_id: task_id
            },
            success: function(data) {
                $('#'+ task_id + '.task-content').remove();
            },
            // error: function() {
            //     alert('error while deleting note');
            // }
        });
    }

    function insert_col(row, note_id) {
        let new_col = create_col_from_template(note_id);
        row.append(new_col);
    }

    function add_note(title, note_id) {
        let note_rows = $('.note-row');
        let row_count = note_rows.length;
        let last_row, last_row_col_count;

        // если уже есть некоторые строки
        if (row_count !== 0) {
            last_row = note_rows.last();
            last_row_col_count = last_row.find('.note-col').length;

            // если строка заполнена, то
            if (last_row_col_count === 2) {
                // создаем новую строку и в неё добавляем новый столбец
                let new_row = create_row_from_template()
                new_row.insertAfter(last_row);
                insert_col(new_row, note_id)
            } else {
                // иначе просто добавляем новый стоблец в последнюю строку
                // нумерация начинается с 1-го
                insert_col(last_row, note_id)
            }
        } else {
            // иначе создаем первую строку
            let first_row = create_row_from_template();
            first_row.insertAfter($('.note-creation-row'));
            insert_col(first_row, note_id);
        }
        $('#' + note_id + '.note-col').fadeIn(500);
        let title_input = $('#' + note_id + '.note-col').find('.title-editable');
        title_input.val(title);

        var old_title = title_input.val();
        title_input.focusin(function() {
            $('#' + note_id + '.note-edit-apply-button').parent().fadeIn(200);
            $('#' + note_id + '.note-edit-cancel-button').parent().fadeIn(200);
        });

        title_input.focusout(function() {
            $('#' + note_id + '.note-edit-apply-button').parent().fadeOut(200);
            $('#' + note_id + '.note-edit-cancel-button').parent().fadeOut(200);
        });

        title_input.hover(function() {
            $(this).css('border-color', '#00AC94');
        }, function() {
            $(this).css('border-color', '#f7f7f7');
        });

        $('#' + note_id + '.note-edit-apply-button').on('click', function() {
            let note_title = title_input.val();
            if (note_title === '') {
                delete_note(note_id);
            } else {
                change_note(note_id, note_title);
            }
        });
        $('#' + note_id + '.note-edit-cancel-button').on('click', function() {
            // change_note(note_id, note_title);
            title_input.val(old_title);
        });
    }

    function create_note(title) {
        $.ajax({
            url: '/queries/organizer/addNoteOrTask.php',
            method: 'POST',
            dataType: 'json',
            data: {
                note_title: title
            },
            success: function(data) {
                add_note(data['title'], data['id']);
            },
            // error: function() {
            //     alert('error while creating note');
            // }
        });
    }

    function add_task(status, description, task_id, note_id) {
        let new_task = create_task_from_template(status, description, task_id);
        let node_col = $('#' + note_id + '.note-col');
        new_task.insertBefore(node_col.find('.task-creation'));
        $('#' + task_id + '.task-content').fadeIn(500);

        let task_content = node_col.find($('#' + task_id + '.task-content-input'));
        task_content.val(description);
        let task_checkbox = $('#checkbox-' + task_id + '.task-status');

        var old_description = task_content.val();
        var old_status = task_checkbox.is(':checked') ? 'Done' : 'Not done';

        // $('#' + task_id + '.task-edit-apply-button')

        // task_checkbox.on('click', function() {
        //     old_status = task_checkbox.is(':checked') ? 'Done' : 'Not done';
        // });

        task_content.focusin(function() {
            $('#' + task_id + '.task-edit-apply-button').parent().fadeIn(200);
            $('#' + task_id + '.task-edit-cancel-button').parent().fadeIn(200);;
            // $('#' + task_id + '.task-delete-button').parent().fadeOut(300);
        });

        task_content.focusout(function() {
            $('#' + task_id + '.task-edit-apply-button').parent().fadeOut(200);;
            $('#' + task_id + '.task-edit-cancel-button').parent().fadeOut(200);;
            // $('#' + task_id + '.task-delete-button').parent().fadeIn(300);
        });

        task_content.hover(function() {
            $(this).css('border-color', '#00AC94');
        }, function() {
            $(this).css('border-color', '#f7f7f7');
        });

        $('#' + task_id + '.task-edit-apply-button').on('click', function() {
            let task_description = task_content.val();
            let task_status = task_checkbox.is(':checked') ? 'Done' : 'Not done';
            if (task_description === '') {
                delete_task(note_id, task_id);
            } else {
                change_task(note_id, task_id, task_description, task_status);
            }
        });

        $('#' + task_id + '.task-edit-cancel-button').on('click', function() {
            // change_note(note_id, note_title);
            task_content.val(old_description);
            task_checkbox.attr('checked', old_status === 'Done');
        });
    }

    function create_task(note_id, description) {
        $.ajax({
            url: '/queries/organizer/addNoteOrTask.php',
            method: 'POST',
            dataType: 'json',
            data: {
                note_id: note_id,
                task_description: description
            },
            success: function(data) {
                add_task(data['status'], data['description'], data['id'], note_id);
            },
            // error: function() {
            //     alert('error while creating note');
            // }
        });
    }


    $(document).ready(function() {
        $.ajax({
            url: '/queries/organizer/getNotesAndTasks.php',
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                $.each(data, function(note_id, note_detail) {
                    add_note(note_detail['title'], note_id);
                    $.each(note_detail['tasks'], function(task_id, task_detail) {
                        add_task(task_detail['status'], task_detail['description'], task_id, note_id);
                    });

                    $('#' + note_id + '.task-create-button').on('click', function() {
                        let task_description = $('#' + note_id + '.task-create-input');
                        if (task_description.val() !== '') {
                            create_task(note_id, task_description.val());
                            task_description.val('');
                            $('#task-empty-alert').hide();
                        } else {
                            $('#task-empty-alert').show();
                            $('#task-empty-alert').delay(5000).fadeOut(1000);
                        }
                    });
                });

                $('.notes-and-tasks-spinner').fadeOut(500);
                $('.notes-and-tasks-content').delay(500).fadeIn(500);

                // $('.note-title').tooltip();
                // $('.task-content').tooltip();

                // ('.task-delete-button').on('click', function() {
                //    let task_id = $(this).attr('id');
                //    $('#' + task_id + '.task-content').remove();
                // );
            },
        });
    });

    $('#note-create-button').on('click', function() {
        // запрос с созданием
        let note_title = $('#note-title-input');
        if (note_title.val() !== '') {
            create_note(note_title.val());
            note_title.val('');
            $('#note-empty-title-alert').hide();
        } else {
            $('#note-empty-title-alert').show();
            $('#note-empty-title-alert').delay(5000).fadeOut(1000);
        }
    });

    $('#notificationToast').toast('show');

    $('#event_detail_modal').on('shown.bs.modal', function () {
        $("#event_modal_body").delay(500).fadeIn(500);
        $("#event_modal_footer").delay(500).fadeIn(500);
        $("#event_modal_header").delay(500).fadeIn(500);
        $("#modal_preloader").fadeOut(500);
    });

    // сброс показа загрузки после закрытия модального окна
    $('#event_detail_modal').on('hidden.bs.modal', function () {
        $("#modal_preloader").show();
        $("#event_modal_header").hide();
        $("#event_modal_body").hide();
        $("#event_modal_footer").hide();
    })

    function event_hide_optional() {
        $('.optional_info').attr('hidden', true);
    }

    function event_hide_all() {
        $('#event_modal_footer').attr('hidden', true);
        $('.record_field').attr('hidden', true);
    }

    function event_show_all() {
        $('#event_modal_footer').attr('hidden', false);
        $('.record_field').attr('hidden', false);
    }

    // преобразование строки даты в ISO формате в формат dd.mm w hh:mm
    function convert_iso_date_string(iso_date_string) {
        let locale_date_string = new Date(iso_date_string).toLocaleString('ru', {
            year: 'numeric',
            month: 'numeric',
            day: 'numeric',
            weekday: 'short',
            hour: 'numeric',
            minute: 'numeric',
        });
        let week, date, time;
        let datetime_parts = locale_date_string.split(', ');
        week = datetime_parts[0]
        date = datetime_parts[1];
        time = datetime_parts[2];
        return time + ' ' + week + ' ' + date;
    }

    function sleep(milliseconds) {
        const date = Date.now();
        let currentDate = null;
        do {
            currentDate = Date.now();
        } while (currentDate - date < milliseconds);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        // конфигурация календаря
        const calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'ru',
            // themeSystem:'bootstrap',
            firstDay: 1,
            navLinks: true,
            // navLinkDayClick: function(date, jsEvent) {
            //  console.log('day', date.toISOString());
            //  console.log('coords', jsEvent.pageX, jsEvent.pageY);
            // },
            contentHeight: 600,
            expandRows: true,
            // selectable: true,
            // editable: true,
            allDaySlot: false,
            // businessHours: {
            //     daysOfWeek: [1, 2, 3, 4, 5, 6],
            //     startTime: '08:00',
            //     endTime: '10:30',
            // },
            eventDisplay: 'block',
            eventMinHeight: 25,
            weekNumbers: true,
            displayEventTime: true,
            weekText: 'Н',
            weekNumberFormat: {
                week: 'short',
            },
            loading: function (isLoading) {
                let calendar = $('#calendar_content');
                let spinner = $('#calendar_spinner');

                if (isLoading) {
                    if (calendar.is(':visible')) {
                        // calendar.fadeOut(200);
                        calendar.css('visibility', 'hidden');
                        spinner.fadeIn(200);
                    }
                } else {
                    spinner.fadeOut(200);
                    calendar.css('visibility', 'visible');
                    // calendar.fadeIn(200);
                }
            },
            eventClick: function (info) {
                // некоторые или даже все поля могут быть скрыты
                event_show_all();
                // скрытие всех специфичных полей
                event_hide_optional();

                let event_modal = $('#event_detail_modal');
                let service_type = info.event.extendedProps['service_type'];
                let service_type_name;

                switch (service_type) {
                    case 'procedure':
                        service_type_name = 'Процедура';
                        $('#event_procedure').removeAttr('hidden');
                        $('#service_redirect_button').text('Перейти на страницу процедуры');
                        break;
                    case 'doctor':
                        service_type_name = 'Специалист';
                        $('#event_doctor').removeAttr('hidden');
                        $('#service_redirect_button').text('Перейти на страницу специалиста');
                        break;
                    case 'survey':
                        service_type_name = 'Обследование';
                        $('#event_survey').removeAttr('hidden');
                        $('#service_redirect_button').text('Перейти на страницу обследования');
                        break;
                    case 'event':
                        service_type_name = 'Мероприятие';
                        $('#event_event').removeAttr('hidden');
                        $('#service_redirect_button').text('Перейти на страницу мероприятия');
                        break;
                    default:
                        service_type_name = 'Неизвестно';
                }
                event_modal.find('#record_name').text(info.event.title);
                event_modal.find('#service_type').text('Тип услуги: ' + service_type_name);
                event_modal.find('#event_start_date_value').text(convert_iso_date_string(info.event.start.toString()));
                event_modal.find('#event_end_date_value').text(convert_iso_date_string(info.event.end.toString()));
                event_modal.find('#event_creation_date_value').text(convert_iso_date_string(info.event.extendedProps['date_of_creation']));
                if (info.event.extendedProps['cost'] !== '') {
                    // если у данного типа записей есть стоимость, то показываем
                    $('#event_cost_value').attr('hidden', false);
                    event_modal.find('#event_cost_value').text(info.event.extendedProps['cost'] + ' ₽');
                }
                event_modal.modal('show');

                // если запись - запись на услугу, то отправляем запрос для получения детальной
                // информации по этой услуге
                // если будут другие типы записй это всё можно обернуть в switch конструкцию, но
                // с изменениями в сущ. логике
                let post_data = {};
                if (info.event.extendedProps['service_id'] !== '' && service_type !== '') {
                    $('#event_modal_footer').attr('hidden', false);
                    post_data['service_type'] = service_type;
                    post_data['service_id'] = info.event.extendedProps['service_id'];
                    if (info.event.extendedProps['medpersona_id'] !== '' && service_type === 'doctor') {
                        post_data['doctor_id'] = info.event.extendedProps['medpersona_id'];
                    }
                }

                $.ajax({
                    url: '/queries/organizer/getServiceDetails.php',
                    method: 'POST',
                    data: post_data,
                    dataType: 'json',
                    success: function(data) {
                        // присваивание соответст. тегам полученных данных
                        // и показ данных
                        switch (service_type) {
                            case 'procedure':
                                if ('location' in data) {
                                    $('#event_procedure').find('#event_location_text').text(data['location']);
                                }
                                if ('doctors' in data) {
                                    let specialists = $('#event_procedure').find('#event_specialists');
                                    specialists.empty();
                                    $.each(data.doctors, function(doctor_id, value) {
                                        let doctor_name =
                                            value['surname'] + ' ' +
                                            value['name'] + ' ' +
                                            value['patronymic'];
                                        specialists.append(
                                            '<span style="color: var(--cyan-color); display: block; text-align: left;">' +
                                            doctor_name +
                                            '</span>'
                                        );
                                    });
                                }
                                break;
                            case 'doctor':
                                if ('specialization' in data) {
                                    let specialization = data['specialization'];
                                    if (specialization === '') {
                                        specialization = 'Нет специализации';
                                    }
                                    $('#event_doctor').find('#event_doctor_specialization').text(specialization);
                                }
                                if ('doctor' in data) {
                                    let doctor_name =
                                        data['doctor']['surname'] + ' ' +
                                        data['doctor']['name'] + ' ' +
                                        data['doctor']['patronymic'];
                                    $('#event_doctor').find('#event_doctor_name').text(doctor_name);
                                }
                                break;
                            case 'survey':
                                if ('location' in data) {
                                    $('#event_survey').find('#event_location_text').text(data['location']);
                                }
                                if ('doctors' in data) {
                                    let specialists = $('#event_survey').find('#event_specialists');
                                    specialists.empty();
                                    $.each(data.doctors, function(doctor_id, value) {
                                        let doctor_name =
                                            value['surname'] + ' ' +
                                            value['name'] + ' ' +
                                            value['patronymic'];
                                        specialists.append(
                                            '<span style="color: var(--cyan-color); display: block; text-align: left;">' +
                                            doctor_name +
                                            '</span>'
                                        );
                                    });
                                }
                                break;
                            case 'event':
                                if ('location' in data) {
                                    $('#event_event').find('#event_location_text').text(data['location']);
                                }
                                break;
                        }
                        // для услуг
                        if ('id' in data) {
                            let service_redirect_link = '/lk/services/record.php?type=' + service_type + '&id=' + data['id'];
                            $('#service_redirect_button').on('click', function() {
                                location.href = service_redirect_link;
                            });
                        }
                    },
                    error: function() {
                        // спрятать всё кроме event_error_message
                        event_hide_all();
                        event_modal.find('#record_name').text('Произошла ошибка');
                        event_modal.find('#record_name').attr('hidden', false);
                        $('#event_error_message').attr('hidden', false);
                    }
                });
            },

            footerToolbar: true,
            headerToolbar: {
                start: 'prevYear,nextYear',
                center: 'title',
                end: 'today prev,next dayGridMonth,timeGridWeek,timeGridDay,listWeek',
            },
            slotLabelFormat:
                {
                    hour: 'numeric',
                    minute: '2-digit',
                    omitZeroMinute: false,
                },
            views: {
                timeGridWeek: {
                    type: 'timeGrid',
                    duration: {days: 7},
                    buttonText: 'Неделя',
                }
            },
            buttonText: {
                today: 'Сегодня',
                month: 'Месяц',
                week: 'Неделя',
                day: 'День',
                list: 'Список',
            },
            eventSources: [
                // Записи на процедуры
                {
                    url: '/queries/organizer/getRecords.php',
                    method: 'POST',
                    extraParams: {
                        service_type: 'procedure',
                    },
                    color: '#f80018',
                    // textColor: '#FFFAFA'
                },
                // Записи на мероприятия
                {
                    url: '/queries/organizer/getRecords.php',
                    method: 'POST',
                    extraParams: {
                        service_type: 'event',
                    },
                    color: '#ffa400',
                    // textColor: '#FFFAFA'
                },
                // Записи на обследования
                {
                    url: '/queries/organizer/getRecords.php',
                    method: 'POST',
                    extraParams: {
                        service_type: 'survey',
                    },
                    color: '#3432b3',
                    // textColor: '#FFFAFA'
                },
                // Записи на специалистов
                {
                    url: '/queries/organizer/getRecords.php',
                    method: 'POST',
                    extraParams: {
                        service_type: 'doctor',
                    },
                    color: '#00AC94',
                    // textColor: '#FFFAFA'
                }
            ],
            eventDidMount: function (info) {
                $(info.el).tooltip({
                    title: info.event.title,
                    placement: "top",
                    trigger: "hover",
                    container: "body"
                });
            },
            noEventsContent: 'Событий нет',
            allDayText: 'На весь день',
        });
        calendar.render();
    });
</script>
</html>