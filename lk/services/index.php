<?php
// Если токен авторизованного пользователя не существует, то направляет на страницу ошибки 401 (нет авторизации)
if(!isset($_COOKIE['user_token']))
    header("Location: /error/401.php");
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";

// Выгрузка данных пользователя
$user = new User($_COOKIE['user_token']);

// Если HTTP-код после обращения к выгрузке данных пользователя по API 400 или 403, то ...
// очищаются Cookie и происходит направление на страницу ошибки 401
if($user->getStatusCode() === 400 || $user->getStatusCode() === 403) {
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.php");
}

// Если роль пользователя не "Пациент", то направляет на страницу ошибки 403
if(!$user->isUserRole("Patient"))
    header("Location: /error/403.php");

// Выгружает данные пользователя
$user_data = $user->getData();
$whose_user = 2;


$url = protocol."://".domain_name_api."/api/med/patient";
$config = [
    "method" => "GET",
    "token" => $_COOKIE['user_token']
];
$patient_data = utils_call_api($url, $config);
$patient_id = $patient_data->data['id'];

$token = $_COOKIE['user_token'];

$url = api_point('/organizer/records');
$records = utils_call_api($url, ['token' => $token]);
if ($records->status_code !== 200) {
    bad_request();
}

$filtered_records = [];
for ($i = 0; $i < count($records->data); $i++) {
    $record = $records->data[$i];
    if ($record['patient'] == $patient_id) {
        $filtered_records[$record['id']] = $record;
    }
}

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
//
//$service_type = $_POST['service_type'];
//$service_id = $_POST['service_id'];

function make_indexed_array(array $collection) : array {
    $indexed_collection = [];
    for ($i = 0; $i < count($collection); $i++) {
        $id = $collection[$i]['id'];
        unset($collection[$i]['id']);
        $indexed_collection[$id] = $collection[$i];
    }
    return $indexed_collection;
}

// Запись-Услуга
$url = api_point('/organizer/service_records');
$service_records = utils_call_api($url, ['token' => $token]);
if ($service_records->status_code !== 200) {
    bad_request();
}
$indexed_service_records = make_indexed_array($service_records->data);

for ($i = 0; $i < count($service_records->data); $i++) {
    $service_record = $service_records->data[$i];
    $record_id = $service_record['record'];
    if (array_key_exists($record_id, $filtered_records)) {
        $filtered_records[$record_id]['service_record'] = $indexed_service_records[$service_record['id']];

        $url = api_point('/api/med/service/'. $service_record['service'] . '/servicemedper');
        $service_medper = utils_call_api($url, ['token' => $token]);
        if ($service_medper->status_code !== 200) {
            continue;
        }
        foreach ($service_medper->data as $id => $data) {
            $filtered_records[$record_id]['doctors'][] = $data['medpersona'];
        }
        $filtered_records[$record_id]['service_type'] = $service_medper->data[0]['type'];
    }
}
?>
<!--
Страница просмотра записей на предстоящие услуги и
просмотра истории посещения услуг у пациента,
а также выбора записи на услугу
-->
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
    <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/js/datatables.js"></script>
    <script defer src="/js/all.js"></script>
    <title><?php echo web_name_header; ?></title>
</head>
<style>
</style>
<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>

<!--Основной контент страницы-->
<div class="page-content">
    <div class="container pt-3 pb-3">
<!--"Хлебные крошки" для навигации по родительским страницам-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/lk/" style="color: var(--dark-cyan-color)">Профиль</a></li>
                <li class="breadcrumb-item active" aria-current="page">Услуги</li>
            </ol>
        </nav>
<!--Содержимое таблиста-->
        <ul class="nav nav-pills flex-column flex-sm-row mb-2" role="tablist">
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold active" data-toggle="tab" href="#tab-services" role="tab">
                    <i class="fas fa-procedures mr-2"></i>Запись на услуги
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#tab-my-services" role="tab">
                    <i class="fas fa-notes-medical mr-2"></i>Мои записи на услуги
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#tab-history-services" role="tab">
                    <i class="fas fa-history mr-1"></i> История записей на услуги
                </a>
            </li>
        </ul>

<!--Контент таблиста-->
        <div class="tab-content">
<!--Содержимое таблиста выбора просмотра услуг-->
            <div class="tab-pane fade show active" id="tab-services" role="tabpanel">
                <div class="card mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="text-center mt-2">
                                <img src="/images/services.svg" alt="" height="170">
                                <h3 class="mt-4 text-danger"><b>Выберите услугу</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 ml-2 mr-2">
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?selected=doctors" class="text-white icon-link"><i class="fas fa-user-md"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Врачи</b></h5>
                                <p class="text-muted">Высококвалифицированные специалисты, предоставляющие услуги своей специальности</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?selected=procedures" class="text-white icon-link"><i class="fas fa-diagnoses"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Процедуры</b></h5>
                                <p class="text-muted">Методы лечения, направленные на восстановление и укрепление вашего здоровья</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?selected=examinations" class="text-white icon-link"><i class="fas fa-microscope"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Обследования</b></h5>
                                <p class="text-muted">Медицинские осмотры с целью выявления новых заболеваний и факторов риска их развития</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?selected=events" class="text-white icon-link"><i class="fas fa-walking"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Мероприятия</b></h5>
                                <p class="text-muted">Культурно массовые события, например, походы, экскурсии, эстафеты и так далее</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--Содержимое таблиста просмота предстоящих записей на услуги-->

            <div class="tab-pane fade" id="tab-my-services" role="tabpanel">
                <?php if(count($filtered_records)  <= 0) {?>
                <div class="card mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="text-center mt-2">
                                <img src="/images/no_data.svg" alt="" height="170">
                                <h3 class="mt-4 text-danger"><b>Нет записей на услуги</b></h3>
                                <p class="text-muted">Вы только заселились в санаторий, дождитесь, пока врач не запишет вас к себе на первый прием.</p>
                                <p class="text-muted">На данный момент у вас отсутствуют записи на медицинские услуги санатория. Запишитесь на новую услугу.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 ml-2 mr-2">
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?selected=doctors" class="text-white icon-link"><i class="fas fa-user-md"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Врачи</b></h5>
                                <p class="text-muted">Высококвалифицированные специалисты, предоставляющие услуги своей специальности</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?selected=procedures" class="text-white icon-link"><i class="fas fa-diagnoses"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Процедуры</b></h5>
                                <p class="text-muted">Методы лечения, направленные на восстановление и укрепление вашего здоровья</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?selected=examinations" class="text-white icon-link"><i class="fas fa-microscope"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Обследования</b></h5>
                                <p class="text-muted">Медицинские осмотры с целью выявления новых заболеваний и факторов риска их развития</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?selected=events" class="text-white icon-link"><i class="fas fa-walking"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Мероприятия</b></h5>
                                <p class="text-muted">Культурно массовые события, например, походы, экскурсии, эстафеты и так далее</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                <div class="card mt-3">
                    <div class="card-body">
                        <table id="table_appointment" class="table table-striped table-hover column-wrap">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Дата и время</th>
                                <th>Название услуги</th>
                                <th>Специалист</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($filtered_records as $filtered_record) {
                            ?>
                            <tr>
                                <td class="text-muted" data-label="Дат. и вр.:">
                                    <?php echo date("d.m.Y H:i", strtotime($filtered_record['date_start'].' -3 hours'));?>
                                </td>
                                <td class="text-muted" data-label="Наз.-е усл.:">
                                    <?php echo $filtered_record['name']; ?>
                                </td>
                                <td class="text-muted" data-label="Спец.-ст:">
                                    <ul class="list-unstyled">
                                    <?php
                                    $arrayDoctor = get_doctors_name($filtered_record['service_record']['service'], $token)['data']['doctors'];
                                    if (count($arrayDoctor) !== 0) {
                                    foreach ($arrayDoctor as $doctor) { ?>
                                        <li>
                                            <span class="badge badge-pill badge-secondary">
                                                <?php echo getItitialsFullName($doctor['surname'], $doctor['name'], $doctor['patronymic']); ?>
                                            <span>

                                        </li>

                                    <?php }
                                    }
                                    ?>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-secondary btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger btn-block" data-toggle="modal" data-target="#openModalRemoveAppointment">Отмена</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <?php } ?>

                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Дата и время</th>
                                <th>Название услуги</th>
                                <th>Специалист</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>

<!--Содержимое таблиста просмотра истории посещения услуг-->
            <div class="tab-pane fade" id="tab-history-services" role="tabpanel">
                <div class="card mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="text-center mt-2">
                                <img src="/images/no_data.svg" alt="" height="170">
                                <h3 class="mt-4 text-danger"><b>История записей пуста</b></h3>
                                <p class="text-muted">Вы только заселились в санаторий, дождитесь, пока врач не запишет вас к себе на первый прием.</p>
                                <p class="text-muted">На данный момент вы не посетили ни одну услугу.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 ml-2 mr-2">
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?selected=doctors" class="text-white icon-link"><i class="fas fa-user-md"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Врачи</b></h5>
                                <p class="text-muted">Высококвалифицированные специалисты, предоставляющие услуги своей специальности</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?selected=procedures" class="text-white icon-link"><i class="fas fa-diagnoses"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Процедуры</b></h5>
                                <p class="text-muted">Методы лечения, направленные на восстановление и укрепление вашего здоровья</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?selected=examinations" class="text-white icon-link"><i class="fas fa-microscope"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Обследования</b></h5>
                                <p class="text-muted">Медицинские осмотры с целью выявления новых заболеваний и факторов риска их развития</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?selected=events" class="text-white icon-link"><i class="fas fa-walking"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Мероприятия</b></h5>
                                <p class="text-muted">Культурно массовые события, например, походы, экскурсии, эстафеты и так далее</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <table id="table_appointment_history" class="table table-striped table-hover column-wrap">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Тип услуги</th>
                                <th>Название услуги</th>
                                <th>Специалист</th>
                                <th>Расположение</th>
                                <th>Дата</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Тип усл.:">
                                    <h5>
                                        <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">
                                            <i class="fas fa-user-md mr-2"></i>Врач
                                        </span>
                                    </h5>
                                </td>
                                <td class="text-muted" data-label="Наз.-е усл.:">
                                    Терапевт
                                </td>
                                <td class="text-muted" data-label="Спец.-ст:">
                                    <img src="/images/user.png" height="30" class="rounded-circle" alt="...">Николаев И. И.
                                </td>
                                <td class="text-muted" data-label="Распо-ие:">500 каб.</td>
                                <td class="text-muted" data-label="Дата:">10.12.21 13:10</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-secondary btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Тип усл.:">
                                    <h5>
                                        <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">
                                            <i class="fas fa-diagnoses mr-2"></i>Процедура
                                        </span>
                                    </h5>
                                </td>
                                <td class="text-muted" data-label="Наз.-е усл.:">
                                    Бассейн
                                </td>
                                <td class="text-muted" data-label="Спец.-ст:">
                                    <img src="/images/user.png" height="30" class="rounded-circle" alt="...">Иванов И. И.
                                </td>
                                <td class="text-muted" data-label="Распо-ие:">Зал 2</td>
                                <td class="text-muted" data-label="Дата:">11.12.21 12:10</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-secondary btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Тип усл.:">
                                    <h5>
                                        <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">
                                            <i class="fas fa-microscope mr-2"></i>Обследование
                                        </span>
                                    </h5>
                                </td>
                                <td class="text-muted" data-label="Наз.-е усл.:">
                                    ОАК
                                </td>
                                <td class="text-muted" data-label="Спец.-ст:">
                                    <img src="/images/user.png" height="30" class="rounded-circle" alt="...">Кузнецова И. И.
                                </td>
                                <td class="text-muted" data-label="Распо-ие:">101 каб.</td>
                                <td class="text-muted" data-label="Дата:">11.12.21 12:10</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-secondary btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Тип усл.:">
                                    <h5>
                                        <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">
                                            <i class="fas fa-walking mr-2"></i>Мероприятие
                                        </span>
                                    </h5>
                                </td>
                                <td class="text-muted" data-label="Наз.-е усл.:">
                                    Экскурсия по зоопарку
                                </td>
                                <td class="text-muted" data-label="Спец.-ст:">
                                    -
                                </td>
                                <td class="text-muted" data-label="Распо-ие:">Главный вход</td>
                                <td class="text-muted" data-label="Дата:">11.12.21 12:10</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-secondary btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Тип услуги</th>
                                <th>Название услуги</th>
                                <th>Специалист</th>
                                <th>Расположение</th>
                                <th>Дата</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно отмены записи-->
<div class="modal fade" tabindex="-1" id="openModalRemoveAppointment" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    Вы уверены, что хотите отменить запись к врачу/на процедуру/обследование/мероприятие?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Нет</button>
                <button type="button" class="btn btn-success">Да</button>
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

<!--Футер (нижний блок)-->
<?php require $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</body>
<script>
    $('#notificationToast').toast('show');

    // Конфигурация динамических таблиц
    $('#table_appointment, #table_appointment_history').DataTable({
        "language": {
            "zeroRecords": "<span class='text-muted'>Совпадения отсутствуют</span>",
            "search": "<span class='text-muted' style='margin-right: 0.5rem; font-size: 1.3rem'>Поиск:</span>",
            "info": "<span class='text-muted'>Показан диапазон от _START_ до _END_ элементов</span>",
            "infoEmpty": "<span class='text-muted'>Услуги отсутствуют</span>",
            "infoFiltered": "<span class='text-muted'>(отфильтровано общих элементов - _MAX_)</span>",
            "lengthMenu": '<span class="text-muted" style="margin-right: 0.5rem; font-size: 1rem">Отобразить элементов: <\span>' +
                '<select class="form-control-sm">'+
                '<option value="5">5</option>'+
                '<option value="10">20</option>'+
                '<option value="20">20</option>'+
                '<option value="30">30</option>'+
                '<option value="-1">Все</option>'+
                '</select>',
            "loadingRecords": "Загрузка...",
            "processing": "Выполнение...",
            "paginate": {
                "next": "Вперед",
                "previous": "Назад"
            }
        },
        autoWidth: false;
    });
</script>
</html>