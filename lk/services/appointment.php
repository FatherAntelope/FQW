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

// Если GET не содержит в переменной selected необходимого значения
// то выход на услуг
$getSelected = $_GET['selected'];
if($getSelected != "doctors" &&
    $getSelected != "procedures" &&
    $getSelected != "examinations" &&
    $getSelected != "events") {
    header("Location: /lk/services/");
    exit;
}
$url = protocol . '://' . domain_name_api . '/api/med/medics';
$config = [
    'token' => $_COOKIE['user_token'],
    'method' => 'GET'
];
$doctors = utils_call_api($url, $config);

$url = protocol . '://' . domain_name_api . '/api/med/procedure';
$config = [
    'token' => $_COOKIE['user_token'],
    'method' => 'GET'
];
$procedures = utils_call_api($url, $config);

$url = protocol . '://' . domain_name_api . '/api/med/survey';
$config = [
    'token' => $_COOKIE['user_token'],
    'method' => 'GET'
];
$examinations = utils_call_api($url, $config);

$url = protocol . '://' . domain_name_api . '/api/med/event';
$config = [
    'token' => $_COOKIE['user_token'],
    'method' => 'GET'
];
$events = utils_call_api($url, $config);
?>
<!--
Страница выбора услуги на запись у пациента
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
 .form-control-sm option:link {
     background-color: var(--cyan-color) !important;
 }
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
                <li class="breadcrumb-item"><a href="#" style="color: var(--dark-cyan-color)">Профиль</a></li>
                <li class="breadcrumb-item"><a href="/lk/services/" style="color: var(--dark-cyan-color)">Услуги</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php
                    if($getSelected == 'doctors') echo "Врачи";
                    if($getSelected == 'procedures') echo "Процедуры";
                    if($getSelected == 'examinations') echo "Обследования";
                    if($getSelected == 'events') echo "Мероприятия";
                    ?>
                </li>
            </ol>
        </nav>
<!--Содержимое таблиста-->
        <ul class="nav nav-pills flex-column flex-sm-row mb-2" role="tablist">
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
<!-- Имитирует активацию нажатия на гиперссылку, если selected=doctors-->
                <a class="nav-link tab-bg-active font-weight-bold <?php if($getSelected == 'doctors') echo "active";?>" onclick="window.history.pushState('', '', '/lk/services/appointment.php?selected=doctors');" data-toggle="tab" href="#tab-doctors" role="tab">
                    <i class="fas fa-user-md mr-2"></i>Врачи
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <?php if($getSelected == 'procedures') echo "active";?>" onclick="window.history.pushState('', '', '/lk/services/appointment.php?selected=procedures');" data-toggle="tab" href="#tab-procedures" role="tab">
                    <i class="fas fa-diagnoses mr-2"></i>Процедуры
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <?php if($getSelected == 'examinations') echo "active";?>" onclick="window.history.pushState('', '', '/lk/services/appointment.php?selected=examinations');" data-toggle="tab" href="#tab-examinations" role="tab">
                    <i class="fas fa-microscope mr-1"></i>Обследования
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <?php if($getSelected == 'events') echo "active";?>" onclick="window.history.pushState('', '', '/lk/services/appointment.php?selected=events');" data-toggle="tab" href="#tab-events" role="tab">
                    <i class="fas fa-walking mr-1"></i>Мероприятия
                </a>
            </li>
        </ul>

<!--Контент таблиста-->
        <div class="tab-content">
<!--
Имитирует активацию нажатия на гиперссылку, если selected=doctors.
Содержимое таблиста врачей
-->
            <div class="tab-pane fade show <?php if($getSelected == 'doctors') echo "active";?>" id="tab-doctors" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_doctors" class="table table-striped table-hover column-wrap">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Врач</th>
                                <th>Специальность</th>
                                <th>Расположение</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            /** Потом придумать, что делать с этим велосипедом, а пока работает **/
                            foreach ($doctors->data as $doctor) {
                                // Достает все услуги текущего врача
                                $url =  protocol . '://' . domain_name_api . '/api/med/medics/'.$doctor['id'].'/servicemedper';
                                $service_medpersons_speciality = utils_call_api($url, $config);

                                // Проверяет, является ли первая связанная услуга медперсоны типа "Специальность"
                                // Если нет, то он не врач, а значит пропускаем вывод
                                if ($service_medpersons_speciality->data[0]['type'] !== "Specialty")
                                    continue;

                                // Достает основные данные врача
                                $url = protocol . '://' . domain_name_api . '/api/med/users/'.$doctor['user'];
                                $doctor_user = utils_call_api($url, $config);
                            ?>
                            <tr>
                                <td class="text-muted" data-label="Врач:">
                                    <img src="<?php echo getUrlUserPhoto($doctor_user->data['user']['photo']); ?>" height="30" class="rounded-circle mr-1" style="height: 25px; width: 25px; object-fit: cover">
                                    <?php echo getItitialsFullName($doctor_user->data['user']['surname'], $doctor_user->data['user']['name'], $doctor_user->data['user']['patronymic']); ?>
                                </td>
                                <td class="text-muted" data-label="Спец.-ть:">
                                    <ul class="list-unstyled">
                                    <?php
                                    // Проходится по всем специальностям врача и отображает их
                                    foreach ($service_medpersons_speciality->data as  $medperson_service) {
                                        $url = protocol . '://' . domain_name_api . '/api/med/service/'. $medperson_service['service'];

                                        $config = [
                                            'token' => $_COOKIE['user_token'],
                                            'method' => 'GET'
                                        ];
                                        $service_main = utils_call_api($url, $config);
                                        ?>
                                        <li><span class="badge badge-pill badge-secondary"><?php echo $service_main->data['name']." - ".$service_main->data['cost']."₽";?></span></li>
                                    <?php } ?>
                                    </ul>
                                </td>
                                <td class="text-muted" data-label="Расп.-ие:">
                                    <?php echo $doctor['location']; ?>
                                </td>
                                <td><a href="/lk/services/record.php?type=doctor&id=<?php echo $doctor['id']; ?>" type="button" class="btn btn-sm btn-warning btn-block text-muted" style="background-color: var(--yellow-color)">Запись</a></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Врач</th>
                                <th>Специальность</th>
                                <th>Расположение</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

<!--Содержимое таблиста процедур-->
            <div class="tab-pane fade show <?php if($getSelected == 'procedures') echo "active";?>" id="tab-procedures" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_procedures" class="table table-striped table-hover column-wrap">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Специалисты</th>
                                <th>Расположение</th>
                                <th>Разрешение</th>
                                <th>Стоимость, руб.</th>
                                <th>Повторы</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($procedures->data as $procedure) {
                                $url = protocol . '://' . domain_name_api . '/api/med/service/'.$procedure['service'];
                                $config = [
                                    'token' => $_COOKIE['user_token'],
                                    'method' => 'GET'
                                ];
                                $service_procedure = utils_call_api($url, $config);

                                $url = protocol . '://' . domain_name_api . '/api/med/service/'.$service_procedure->data['id'].'/servicemedper';
                                $service_medpers_procedure = utils_call_api($url, $config);

                                if(count($service_medpers_procedure->data) == 0)
                                    continue;
                            ?>
                            <tr>
                                <td class="text-muted" data-label="Название:">
                                    <?php echo $service_procedure->data['name']; ?>
                                </td>
                                <td class="text-muted" data-label="Сп.-исты:">
                                    <ul class="list-unstyled">
                                        <?php foreach ($service_medpers_procedure->data as $service_medper_procedure) {
                                            $url = protocol . '://' . domain_name_api . '/api/med/medics/' . $service_medper_procedure['medpersona'];
                                            $procedure_medpersona = utils_call_api($url, $config);

                                            $url = protocol . '://' . domain_name_api . '/api/med/users/' . $procedure_medpersona->data['user'];
                                            $procedure_medpersona_user = utils_call_api($url, $config);

                                            ?>
                                                <li>
                                                    <span class="badge badge-pill badge-secondary">
                                                        <?php echo getItitialsFullName($procedure_medpersona_user->data['user']['surname'], $procedure_medpersona_user->data['user']['name'], $procedure_medpersona_user->data['user']['patronymic']);  ?>
                                                    </span>
                                                </li>

                                        <?php } ?>
                                    </ul>

                                </td>
                                <td class="text-muted" data-label="Расп.-ие:">
                                    <?php echo $procedure['placement']?>
                                </td>
                                <td class="text-muted" data-label="Раз.-ие:">
                                    <span class="badge badge-pill badge-success">Дополнительно</span> /
                                    <span class="badge badge-pill badge-danger">Обязательно</span>
                                </td>
                                <td class="text-muted" data-label="Стоимость, р.:">
                                    <?php echo $service_procedure->data['cost']; ?>
                                </td>
                                <td class="text-muted" data-label="Повторов:">–/N</td>
                                <td><a href="/lk/services/record.php?type=procedure&id=<?php echo $procedure['id']; ?>" type="button" class="btn btn-sm btn-warning btn-block text-muted" style="background-color: var(--yellow-color)">Запись</a></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Специалисты</th>
                                <th>Расположение</th>
                                <th>Разрешение</th>
                                <th>Стоимость, руб.</th>
                                <th>Повторов</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

<!--Содержимое таблиста обследования-->
            <div class="tab-pane fade show <?php if($getSelected == 'examinations') echo "active";?>" id="tab-examinations" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_examinations" class="table table-striped table-hover column-wrap">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Специалисты</th>
                                <th>Расположение</th>
                                <th>Стоимость, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($examinations->data as $examination) {
                                $url = protocol . '://' . domain_name_api . '/api/med/service/'.$examination['service'];
                                $config = [
                                    'token' => $_COOKIE['user_token'],
                                    'method' => 'GET'
                                ];
                                $service_examination = utils_call_api($url, $config);

                                $url = protocol . '://' . domain_name_api . '/api/med/service/'.$service_examination->data['id'].'/servicemedper';
                                $service_medpers_examination = utils_call_api($url, $config);

                                if(count($service_medpers_examination->data) == 0)
                                    continue;
                            ?>
                            <tr>
                                <td class="text-muted" data-label="Название:">
                                    <?php echo $service_examination->data['name']; ?>
                                </td>
                                <td class="text-muted" data-label="Сп.-исты:">
                                    <ul class="list-unstyled">
                                        <?php
                                        foreach ($service_medpers_examination->data as $service_medper_examination) {
                                            $url = protocol . '://' . domain_name_api . '/api/med/medics/' . $service_medper_procedure['medpersona'];
                                            $procedure_medpersona = utils_call_api($url, $config);

                                            $url = protocol . '://' . domain_name_api . '/api/med/users/' . $procedure_medpersona->data['user'];
                                            $procedure_medpersona_user = utils_call_api($url, $config);

                                            ?>
                                            <li>
                                                    <span class="badge badge-pill badge-secondary">
                                                        <?php echo getItitialsFullName($procedure_medpersona_user->data['user']['surname'], $procedure_medpersona_user->data['user']['name'], $procedure_medpersona_user->data['user']['patronymic']);  ?>
                                                    </span>
                                            </li>

                                        <?php } ?>
                                    </ul>
                                </td>
                                <td class="text-muted" data-label="Расп.-ие:">
                                    <?php echo $examination['placement']?>
                                </td>
                                <td class="text-muted" data-label="Стоимость, р.:">
                                    <?php echo $service_examination->data['cost']; ?>
                                </td>
                                <td><a href="/lk/services/record.php?type=examination&id=<?php echo $examination['id']; ?>" type="button" class="btn btn-sm btn-warning btn-block text-muted" style="background-color: var(--yellow-color)">Запись</a></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Обследование</th>
                                <th>Специалисты</th>
                                <th>Расположение</th>
                                <th>Стоимость, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

<!--Содержимое таблиста мероприятий-->
            <div class="tab-pane fade show <?php if($getSelected == 'events') echo "active";?>" id="tab-events" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_events" class="table table-striped table-hover column-wrap">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Даты проведения</th>
                                <th>Место встречи</th>
                                <th>Стоимость, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($events->data as $event) {
                            $url = protocol . '://' . domain_name_api . '/api/med/service/'.$event['service'];
                            $config = [
                                'token' => $_COOKIE['user_token'],
                                'method' => 'GET'
                            ];
                            $service_event = utils_call_api($url, $config);
                            ?>
                            <tr>
                                <td class="text-muted" data-label="Название:">
                                    <?php echo $service_event->data['name']; ?>
                                </td>
                                <td class="text-muted" data-label="Даты:">
                                    <?php echo ($event['end_data'] !== null) ? date("d.m.Y", strtotime($event['begin_data']))." - ".date("d.m.Y", strtotime($event['end_data'])): "Бессрочно"; ?>
                                </td>
                                <td class="text-muted" data-label="Мест. встречи:">
                                    <?php echo $event['placement']; ?>
                                </td>
                                <td class="text-muted" data-label="Стоимость, р.:">
                                    <?php echo $service_event->data['cost']; ?>
                                </td>
                                <td><a href="/lk/services/record.php?type=event&id=<?php echo $event['id']; ?>" type="button" class="btn btn-sm btn-warning btn-block text-muted" style="background-color: var(--yellow-color)">Запись</a></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Обследование</th>
                                <th>Даты проведения</th>
                                <th>Место встречи</th>
                                <th>Стоимость, руб.</th>
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
    $('#table_doctors, #table_procedures, #table_examinations, #table_events').DataTable({
        "language": {
            "zeroRecords": "<span class='text-muted'>Услуги отсутствуют</span>",
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
        autoWidth: false
    });
</script>
</html>