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
// Если роль пользователя не "Доктор", то направляет на страницу ошибки 403
if(!$user->isUserRole("Doctor"))
    header("Location: /error/403.php");

// Выгружает данные пользователя
$user_data = $user->getData();
$whose_user = 3;

$url = protocol."://".domain_name_api."/api/med/medpersona";
$config = [
    "method" => "GET",
    "token" => $_COOKIE['user_token']
];
$doctor = utils_call_api($url, $config);

$url = protocol.'://'.domain_name_api.'/api/med/patients';
$patients_all = utils_call_api($url, $config);


if($doctor->data['position'] == "Doctor") {
    $url = protocol."://".domain_name_api."/api/med/medicpatient?medpersona=".$doctor->data['id'];
    $bind_patients_doctor = utils_call_api($url, $config);
}


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
    <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/js/datatables.js"></script>
    <script defer src="/js/all.js"></script>
    <title><?php echo web_name_header; ?></title>
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
                <li class="breadcrumb-item active" aria-current="page">Пациенты</li>
            </ol>
        </nav>
        <ul class="nav nav-pills flex-column flex-sm-row mb-2" role="tablist">
            <?php if($doctor->data['position'] == "Doctor") {?>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <?php echo ($doctor->data['position'] == "Doctor") ? "active" : ""?>" data-toggle="tab" href="#tab_my_patients" role="tab">
                    <i class="fas fa-user-injured mr-1"></i>Мои пациенты
                </a>
            </li>
            <?php } ?>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <?php echo ($doctor->data['position'] == "Specialist") ? "active" : ""?>" data-toggle="tab" href="#tab_all_patients" role="tab">
                    <i class="fas fa-user-injured mr-1"></i> Все пациенты
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <?php if($doctor->data['position'] == "Doctor") {?>
            <div class="tab-pane fade <?php echo ($doctor->data['position'] == "Doctor") ? "show active" : ""?>" id="tab_my_patients" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_patients" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Пациент</th>
                                <th>ID карты</th>
                                <th>Категория</th>
                                <th>Группа</th>
                                <th>Дневник</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($bind_patients_doctor->data as $bind_patient) {

                                $url = protocol.'://'.domain_name_api.'/api/med/patients/'.$bind_patient['patient'];
                                $patient = utils_call_api($url, $config);

                                $url = protocol.'://'.domain_name_api.'/api/med/users/'.$patient->data['user'];
                                $patient_user = utils_call_api($url, $config);

                                $url = protocol."://".domain_name_api."/api/med/users/patients/".$bind_patient['patient']."/medcard";
                                $patient_medcard = utils_call_api($url, $config);
                            ?>
                            <tr>
                                <td class="text-muted" data-label="Пац.-т:">
                                    <img src="<?php echo getUrlUserPhoto($patient_user->data['user']['photo']); ?>" height="30" class="rounded-circle mr-1" style="height: 25px; width: 25px; object-fit: cover">
                                    <?php echo getItitialsFullName($patient_user->data['user']['surname'], $patient_user->data['user']['name'], $patient_user->data['user']['patronymic']); ?>
                                </td>
                                <td class="text-muted" data-label="ID карты:"><?php echo $patient_medcard->data['id']; ?></td>
                                <td class="text-muted" data-label="Категория:">
                                    <?php if($patient->data['type'] == "Treating") { ?>
                                        <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">
                                            <?php echo getPatientCategoryRu($patient->data['type']); ?>
                                        </span>
                                    <?php }
                                    if ($patient->data['type'] == "Vacationer") { ?>
                                        <span class="badge badge-pill text-muted" style="background-color: var(--yellow-color)">
                                            <?php echo getPatientCategoryRu($patient->data['type']); ?>
                                        </span>
                                    <?php } ?>
                                </td>
                                <td class="text-muted" data-label="Группа:">
                                    <?php if(count($patient->data['group'])> 0) {?>
                                        <ul class="list-unstyled">
                                            <?php foreach ($patient->data['group'] as $group) { ?>
                                                <li><span class="badge badge-pill text-white bg-secondary"><?php echo $group; ?></span></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } else { echo "Отсутствует"; } ?>
                                </td>
                                <td class="text-muted" data-label="Дневник:">
                                    <span class="badge badge-pill bg-success text-white">Проверен</span> /
                                    <span class="badge badge-pill bg-danger text-white">Не проверен</span>
                                </td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)">Профиль</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-secondary text-white">Медкарта</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Дневник</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Пациент</th>
                                <th>ID карты</th>
                                <th>Категория</th>
                                <th>Группа</th>
                                <th>Дневник</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="tab-pane fade <?php echo ($doctor->data['position'] == "Specialist") ? "show active" : ""?>" id="tab_all_patients" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_doctors" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Пациент</th>
                                <th>ID карты</th>
                                <th>Категория</th>
                                <th>Группа</th>
                                <th>Участковый</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($patients_all->data as $patient) {
                                // Выводит только активных пациентов
                                if($patient['type'] == "Discharged")
                                    continue;
                            $url = protocol.'://'.domain_name_api.'/api/med/users/'.$patient['user'];
                            $patient_user = utils_call_api($url, $config);

                            $url = protocol."://".domain_name_api."/api/med/users/patients/".$patient['id']."/medcard";
                            $patient_medcard = utils_call_api($url, $config);
                            ?>
                            <tr>
                                <td class="text-muted" data-label="Пац.-т:">
                                    <img src="<?php echo getUrlUserPhoto($patient_user->data['user']['photo']); ?>" height="30" class="rounded-circle mr-1" style="height: 25px; width: 25px; object-fit: cover">
                                    <?php echo getItitialsFullName($patient_user->data['user']['surname'], $patient_user->data['user']['name'], $patient_user->data['user']['patronymic']); ?>
                                </td>
                                <td class="text-muted" data-label="ID карты:"><?php echo $patient_medcard->data['id']; ?></td>
                                <td class="text-muted" data-label="Категория:">
                                    <?php if($patient['type'] == "Treating") { ?>
                                    <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">
                                            <?php echo getPatientCategoryRu($patient['type']); ?>
                                        </span>
                                    <?php }
                                    if ($patient['type'] == "Vacationer") { ?>
                                    <span class="badge badge-pill text-muted" style="background-color: var(--yellow-color)">
                                            <?php echo getPatientCategoryRu($patient['type']); ?>
                                        </span>
                                    <?php } ?>
                                </td>
                                <td class="text-muted" data-label="Группа:">
                                    <?php if(count($patient['group'])> 0) {?>
                                    <ul class="list-unstyled">
                                        <?php foreach ($patient['group'] as $group) { ?>
                                            <li><span class="badge badge-pill text-white bg-secondary"><?php echo $group; ?></span></li>
                                        <?php } ?>
                                    </ul>
                                    <?php } else { echo "Отсутствует"; } ?>
                                </td>
                                <td class="text-muted" data-label="Участковый:">
                                    <?php
                                    $url = protocol."://".domain_name_api."/api/med/medicpatient?patient=".$patient['id'];
                                    $medicpatient = utils_call_api($url, $config);
                                    if (count($medicpatient->data) > 0) {
                                        $url = protocol."://".domain_name_api."/api/med/medics/".$medicpatient->data[0]['medpersona'];
                                        $medicpatient_doctor = utils_call_api($url, $config);

                                        $url = protocol."://".domain_name_api."/api/med/users/".$medicpatient_doctor->data['user'];
                                        $medicpatient_doctor_user = utils_call_api($url, $config);
                                        ?>
                                        <a href="#" class="text-decoration-none text-info">
                                            <?php
                                            echo getItitialsFullName(
                                                $medicpatient_doctor_user->data['user']['surname'],
                                                $medicpatient_doctor_user->data['user']['name'],
                                                $medicpatient_doctor_user->data['user']['patronymic'],
                                            );
                                            ?>
                                        </a>
                                    <?php } else { echo "Отсутствует"; } ?>
                                </td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><a href="/lk/patients/profile.php?id=<?php echo $patient['id']?>" class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)">Профиль</a></li>
                                        <li><a href="/lk/patients/medcard.php?patient=<?php echo $patient['id']?>" class="btn mt-1 btn-sm btn-secondary text-white">Медкарта</a></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Дневник</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Пациент</th>
                                <th>ID карты</th>
                                <th>Категория</th>
                                <th>Группа</th>
                                <th>Участковый</th>
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

    $('#table_patients, #table_doctors, #table_administrators').DataTable({
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

    });
</script>
</html>
