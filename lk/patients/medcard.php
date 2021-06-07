<?php
// Если токен авторизованного пользователя не существует, то направляет на страницу ошибки 401 (нет авторизации)
if(!isset($_COOKIE['user_token']))
    header("Location: /error/401.php");
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";

if(!isset($_GET['patient']) || $_GET['patient'] == null)
    header("Location: /lk/patients/");

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

// Достает все данные пациента
$url = protocol . '://' . domain_name_api . '/api/med/patients/' . $_GET['patient'];
$config = [
    'token' => $_COOKIE['user_token'],
    'method' => 'GET'
];
$patient = utils_call_api($url, $config);
if ($patient->status_code == 404) {
    header("Location: /lk/patients/");
    exit();
}

// Достает все данные пациента
$url = protocol.'://'.domain_name_api.'/api/med/users/'.$patient->data['user'];
$patient_user = utils_call_api($url, $config);

// Достает данные медицинской карты пользователя
$url = protocol."://".domain_name_api."/api/med/users/patients/".$_GET['id']."/medcard";
$config = [
    "method" => "GET",
    "token" => $_COOKIE['user_token']
];
$patient_medcard = utils_call_api($url, $config);
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
    <script src="//cdn.jsdelivr.net/npm/chart.js"></script>
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
                <li class="breadcrumb-item"><a href="/lk/patients/" style="color: var(--dark-cyan-color)">Пациенты</a></li>
                <li class="breadcrumb-item"><a href="/lk/patients/profile.php?id=<?php echo $patient->data['id']?>" style="color: var(--dark-cyan-color)"><?php echo getItitialsFullName($patient_user->data['user']['surname'], $patient_user->data['user']['name'], $patient_user->data['user']['patronymic']); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Медкарта</li>
            </ol>
        </nav>
        <ul class="nav nav-pills flex-column flex-sm-row mb-2" role="tablist">
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold active" data-toggle="tab" href="#tab_epicrisis" role="tab">
                    <i class="fas fa-notes-medical mr-1"></i>Эпикризы
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#tab_examinations" role="tab">
                    <i class="fas fa-microscope mr-1"></i> Обследования
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#tab_disease" role="tab">
                    <i class="fas fa-disease mr-1"></i> Диагнозы
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#tab_pills" role="tab">
                    <i class="fas fa-pills mr-1"></i> Лекарства
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#tab_recommendations" role="tab">
                    <i class="fas fa-clipboard mr-1"></i> Рекомендации
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab_epicrisis" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <a href="/lk/patients/add_epicrisis.php?patient=<?php echo $patient->data['id']?>" class="btn btn-sm btn-success float-right text-white mb-2">
                            <i class="fas fa-plus-circle mr-2"></i>Добавить эпикриз
                        </a>
                        <table id="table_epicrisis" class="table table-striped table-hover column-wrap">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Дата</th>
                                <th>ID</th>
                                <th>Анамнез</th>
                                <th>Врач</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Дата:">01.01.2020</td>
                                <td class="text-muted" data-label="ID:">12345</td>
                                <td class="text-muted" data-label="Анамнез:" style="max-width: 15rem">
                                    <p>
                                        <?php
                                        $string = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam commodi corporis debitis dolor eaque esse eveniet expedita laudantium molestias non optio quia, recusandae tempore tenetur veniam voluptates voluptatum. Accusamus adipisci cum nam quae sunt? Autem fugit necessitatibus totam! Accusamus ad earum modi nisi numquam qui repellat suscipit tempora velit!";
                                        echo mb_strimwidth($string, 0, 100, '...');
                                        ?>
                                    </p>
                                </td>
                                <td class="text-muted" data-label="Врач:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm text-white" data-toggle="modal" data-target="#openModalInfoEpicrisis" style="background-color: var(--cyan-color)">Просмотр</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveNote">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Дата:">01.01.2020</td>
                                <td class="text-muted" data-label="ID:">12345</td>
                                <td class="text-muted" data-label="Анамнез:" style="max-width: 15rem">
                                    <p>
                                        <?php
                                        $string = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam commodi corporis debitis dolor eaque esse eveniet expedita laudantium molestias non optio quia, recusandae tempore tenetur veniam voluptates voluptatum. Accusamus adipisci cum nam quae sunt? Autem fugit necessitatibus totam! Accusamus ad earum modi nisi numquam qui repellat suscipit tempora velit!";
                                        echo mb_strimwidth($string, 0, 100, '...');
                                        ?>
                                    </p>
                                </td>
                                <td class="text-muted" data-label="Врач:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm text-white" data-toggle="modal" data-target="#openModalInfoEpicrisis" style="background-color: var(--cyan-color)">Просмотр</button></li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Дата</th>
                                <th>ID</th>
                                <th>Анамнез</th>
                                <th>Врач</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="tab_examinations" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="btn btn-sm btn-success float-right text-white mb-2">
                            <i class="fas fa-plus-circle mr-2"></i>Добавить обследование
                        </a>
                        <table id="table_examinations" class="table table-striped table-hover column-wrap">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Дата</th>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Специалист</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Дата:">01.01.2020</td>
                                <td class="text-muted" data-label="ID:">12345</td>
                                <td class="text-muted" data-label="Название:">
                                    Общий анализ крови
                                </td>
                                <td class="text-muted" data-label="Врач:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm text-white" data-toggle="modal" data-target="#openModalInfoExamination" style="background-color: var(--cyan-color)">Просмотр</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveNote">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Дата:">01.01.2020</td>
                                <td class="text-muted" data-label="ID:">12345</td>
                                <td class="text-muted" data-label="Название:" style="max-width: 15rem">
                                    Магнитно-резонансная терапия
                                </td>
                                <td class="text-muted" data-label="Врач:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm text-white" data-toggle="modal" data-target="#openModalInfoExamination" style="background-color: var(--cyan-color)">Просмотр</button></li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Дата</th>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Специалист</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="tab_disease" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_disease" class="table table-striped table-hover column-wrap">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Тип</th>
                                <th>МКБ</th>
                                <th>Описание</th>
                                <th>Врач</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Тип:">Основной</td>
                                <td class="text-muted" data-label="МКБ:">021.3</td>
                                <td class="text-muted" data-label="Описание:" style="max-width: 20rem">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis laborum, officiis perspiciatis reiciendis voluptas voluptatum.
                                </td>
                                <td class="text-muted" data-label="Врач:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveNote">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Тип:">Сопутствующий</td>
                                <td class="text-muted" data-label="МКБ:">027</td>
                                <td class="text-muted" data-label="Описание:" style="max-width: 20rem">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur error quis sed velit voluptate? Laudantium.
                                </td>
                                <td class="text-muted" data-label="Врач:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td>

                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Тип</th>
                                <th>МКБ</th>
                                <th>Описание</th>
                                <th>Врач</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="tab_pills" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_pills" class="table table-striped table-hover column-wrap">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Доза</th>
                                <th>Правило приема</th>
                                <th>Повторы</th>
                                <th>Период, д.</th>
                                <th>Врач</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Название:">Диклофенак</td>
                                <td class="text-muted" data-label="Доза:">1/2 таблетки</td>
                                <td class="text-muted" data-label="ПП:">Во время еды</td>
                                <td class="text-muted" data-label="Повторы:">3 раза в день</td>
                                <td class="text-muted" data-label="Период, д.:">10</td>
                                <td class="text-muted" data-label="Врач:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveNote">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Название:">Диклофенак</td>
                                <td class="text-muted" data-label="Доза:">1/2 таблетки</td>
                                <td class="text-muted" data-label="ПП:">Во время еды</td>
                                <td class="text-muted" data-label="Повторы:">3 раза в день</td>
                                <td class="text-muted" data-label="Срок, д.:">10</td>
                                <td class="text-muted" data-label="Врач:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Доза</th>
                                <th>Правило приема</th>
                                <th>Повторы</th>
                                <th>Срок, д.</th>
                                <th>Врач</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="tab_recommendations" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_recommendations" class="table table-striped table-hover column-wrap">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Рекомендация</th>
                                <th>Название</th>
                                <th>Тип</th>
                                <th>Период</th>
                                <th>Врач</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Рек.-ия:">Процедура</td>
                                <td class="text-muted" data-label="Наз.-ие:">Бассейн</td>
                                <td class="text-muted" data-label="Тип:">
                                    <span class="badge badge-pill text-white" style="background-color: var(--cyan-color)">Дополнительно</span>
                                </td>
                                <td class="text-muted" data-label="Период:">По желанию</td>
                                <td class="text-muted" data-label="Порек.-л:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveNote">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Рек.-ия:">Самоконтроль</td>
                                <td class="text-muted" data-label="Наз.-ие:">Пройти 3000 шагов</td>
                                <td class="text-muted" data-label="Тип:">
                                    <span class="badge badge-pill badge-danger text-white">Обязательно</span>
                                </td>
                                <td class="text-muted" data-label="Период:">Ежедневно</td>
                                <td class="text-muted" data-label="Порек.-л:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Рекомендация</th>
                                <th>Название</th>
                                <th>Тип</th>
                                <th>Период</th>
                                <th>Врач</th>
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

<!--Модальное окно подробной информации об эпикризе-->
<div class="modal fade" tabindex="-1" id="openModalInfoEpicrisis">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Выписной эпикриз №1234 от 01.01.2010</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-muted">Врач: <a href="" class="text-decoration-none text-danger">Иванов И. И.</a></h5>
                <h5 class="text-muted">Специальность:
                    <span class="badge badge-pill badge-secondary">Терапевт</span>
                    <span class="badge badge-pill badge-secondary">Хирург</span>
                </h5>
                <h5 class="mb-0 text-muted text-uppercase bg-light p-2">
                    <i class="fas fa-disease mr-1"></i>
                    Диагнозы
                </h5>
                <table class="table table-striped table-hover table-sm column-wrap">
                    <thead class="text-white" style="background-color: var(--cyan-color);">
                    <tr>
                        <th>Тип</th>
                        <th>МКБ</th>
                        <th>Описание</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-muted" data-label="Тип:">Основной</td>
                        <td class="text-muted" data-label="МКБ:">021</td>
                        <td class="text-muted" data-label="Описание:">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, repellat!</td>
                    </tr>
                    <tr>
                        <td class="text-muted" data-label="Тип:">Сопутствующий</td>
                        <td class="text-muted" data-label="МКБ:">023.1</td>
                        <td class="text-muted" data-label="Описание:">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, repellat!</td>
                    </tr>
                    </tbody>
                </table>
                <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Состояние
                </h5>
                <p class="text-muted">Жалобы: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, placeat.</p>
                <p class="text-muted">Анамнез: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, placeat.</p>


                <h5 class="mb-0 text-muted text-uppercase bg-light p-2">
                    <i class="fas fa-pills mr-1"></i>
                    Лекарства
                </h5>
                <table class="table table-striped table-hover table-sm column-wrap">
                    <thead class="text-white" style="background-color: var(--cyan-color);">
                    <tr>
                        <th>Название</th>
                        <th>Доза</th>
                        <th>Правило приема</th>
                        <th>Повторы</th>
                        <th>Срок, д.</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-muted" data-label="Название:">Диклофенак</td>
                        <td class="text-muted" data-label="Доза:">1/2 таблетки</td>
                        <td class="text-muted" data-label="ПП:">Во время еды</td>
                        <td class="text-muted" data-label="Повторы:">3 раза в день</td>
                        <td class="text-muted" data-label="Срок, д.:">10</td>
                    </tr>
                    </tbody>
                </table>

                <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                    <i class="fas fa-clipboard mr-1"></i>
                    Рекомендации
                </h5>

                <ul class="text-muted">
                    <li>Ограничение физических нагрузок</li>
                    <li>Ежедневная прогулка по 3000 шагов</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam assumenda consequatur cum dignissimos dolore doloremque dolores eligendi error expedita explicabo facere fuga fugiat in incidunt ipsum iusto labore laudantium magni maxime minima necessitatibus nihil nisi non nostrum odio odit officiis quaerat quas qui reprehenderit saepe, sapiente sunt suscipit veniam voluptas voluptatem voluptates. Aut dolor enim numquam quas rem. Accusamus aperiam commodi dicta eius ex fugiat laboriosam nulla, obcaecati rerum tempore unde velit veritatis voluptatibus? Amet aut consequuntur, cupiditate deleniti distinctio doloribus earum ex harum ipsam iste iusto laboriosam omnis quaerat, quibusdam, sapiente sint unde. Aspernatur assumenda cupiditate deserunt laborum nobis quo, sit tempora ullam voluptas voluptatibus. Accusamus alias aliquam eius eligendi, eum ex fugit inventore iste maxime minima natus necessitatibus nemo omnis perferendis porro quibusdam quisquam quo quos rem, sequi sint, suscipit veniam voluptatum? Accusamus accusantium adipisci aliquid atque consequatur cumque deleniti dolores enim eos impedit, nesciunt pariatur, quaerat quasi quia repellendus sunt tempora vel! Aperiam debitis delectus deserunt dolore minus modi neque nostrum praesentium quidem quod repudiandae, sint ullam? Culpa dolorem eligendi eveniet, id ipsum iste iusto maxime obcaecati qui rerum, unde velit voluptate. Id incidunt labore quisquam similique. Ad aliquam aspernatur at blanditiis consectetur cum deserunt, dolorem ea esse est eveniet, ex impedit iste laudantium magnam minus nam, nisi non nostrum nulla numquam obcaecati qui recusandae repudiandae saepe unde vel? At aut cupiditate excepturi ipsa nesciunt officiis praesentium, quia totam veniam? Asperiores deleniti est nesciunt nihil odio tempora? A accusantium animi aspernatur consequuntur cum dicta dolorum eos et, facilis illo in odit perferendis quidem repellendus tempora vel, voluptatem? Aspernatur blanditiis cumque eaque est fuga perspiciatis voluptas! Culpa est explicabo, laborum maxime odit quasi soluta ullam ut. Ab doloremque eveniet ipsa, itaque magnam magni pariatur quas quis quisquam tenetur. Consectetur dolorem eaque eveniet fugiat minus mollitia odit pariatur recusandae! Aperiam aspernatur autem beatae commodi consectetur delectus dicta distinctio dolor esse et eum fugiat fugit itaque iusto laboriosam maxime necessitatibus provident quibusdam quod, recusandae repellat rerum totam vel veniam voluptatum! Cupiditate est itaque laboriosam perspiciatis tempora veniam voluptates. Animi quam sit sunt tempore! Ea quas quos sapiente vero! Aut dicta eum harum, minima nam perferendis perspiciatis ratione repellendus! Ad aliquam assumenda beatae debitis deserunt ex hic illo labore laboriosam molestiae molestias neque nesciunt nobis nostrum odit officia, quae quaerat quisquam reiciendis repellat repudiandae sapiente sed similique sit unde? At blanditiis deserunt eveniet possimus veritatis! Animi aspernatur autem consequuntur, delectus eaque eius et facilis fugiat hic itaque libero modi nesciunt, perferendis provident quisquam ratione sint sit ullam velit veniam. Eos ipsam quo velit. Aut commodi corporis culpa dignissimos dolore, dolorem, enim, excepturi impedit magnam necessitatibus optio repudiandae sunt veniam. Accusamus consectetur eum inventore minus perspiciatis sit soluta ullam ut! Aliquid animi consequuntur deleniti excepturi ipsam minus perferendis, saepe suscipit voluptas. Amet architecto assumenda doloribus dolorum explicabo ipsum nam non perspiciatis quis quo rerum sequi tempora, voluptatem. Adipisci alias amet, aperiam aspernatur aut beatae culpa deserunt dolorum excepturi exercitationem fugiat hic inventore ipsam itaque maiores necessitatibus nemo neque odio odit omnis quasi quia quidem recusandae rem rerum sed sequi temporibus veniam voluptas voluptatem. Cupiditate dolor incidunt iusto maxime quas. Aspernatur fuga fugiat illo, laboriosam laudantium minus molestiae quaerat quis voluptate voluptatibus. Accusamus accusantium animi aspernatur consectetur consequatur deleniti dicta doloremque ducimus eum eveniet expedita id illo magni, maiores minima necessitatibus neque nostrum officia officiis perferendis porro quas qui quod ratione reiciendis rem repellat sequi similique sit totam ullam velit veritatis vitae. A accusantium ad aliquam cum delectus ducimus eius eligendi excepturi ipsam nihil, nostrum quasi qui quia suscipit voluptatum? A, aut autem debitis, delectus distinctio enim excepturi itaque nobis officia quae quas similique temporibus vero! Dolore fugiat maiores optio quae quam suscipit veritatis? Aspernatur corporis enim est in iusto minus odit ullam velit. Dicta et hic optio voluptatibus. Consequuntur dolor id laudantium molestiae, nemo nisi pariatur provident quae repellat similique, tempora vel veniam? Aliquid architecto asperiores, aspernatur culpa dolor ex in ipsam labore magni, odit officiis pariatur placeat, quo temporibus velit veniam voluptatem? Amet architecto eaque impedit nisi vero? Aspernatur eaque nam numquam reiciendis. At, blanditiis consectetur, cupiditate dignissimos distinctio dolore earum et ipsam laudantium modi molestias natus nihil nostrum numquam obcaecati qui similique sit, sunt unde vitae? Earum est in maiores molestias porro, quo suscipit vitae? Accusamus accusantium ad adipisci aliquid asperiores cum delectus dolore, enim error esse est ex excepturi illo inventore ipsam itaque iusto modi molestias nihil, numquam perspiciatis placeat quae quia recusandae sapiente sint, suscipit vero voluptate voluptates voluptatum. Blanditiis consequatur eius fugiat iste laboriosam nobis obcaecati omnis quaerat qui ut! Accusantium ad animi autem dolores dolorum error id impedit in incidunt ipsa magnam minima nam nemo nihil nisi nulla odio perferendis porro quas quia quis, quisquam ratione tempora tempore ullam unde vel voluptatum? Cumque delectus dolor doloremque qui repellat repudiandae sit suscipit. A ab accusamus aliquid aspernatur blanditiis, commodi, corporis delectus facere illo iusto libero minima modi mollitia perspiciatis provident quo sint vitae, voluptate! Ab aperiam, aspernatur autem culpa deleniti doloremque exercitationem, fuga molestias mollitia nam officiis praesentium recusandae, sint sit suscipit voluptate voluptatem? Adipisci aspernatur atque aut consequatur corporis debitis deleniti deserunt dignissimos dolor dolore doloremque dolores doloribus eligendi est eveniet facilis incidunt labore maxime modi molestiae nemo nesciunt non ratione sapiente, sed sequi similique sit temporibus tenetur veniam. Ab adipisci aliquam doloremque dolores labore quasi, qui quis repellat repudiandae soluta. Accusamus aliquam amet consequatur delectus dignissimos distinctio dolor dolores earum eius esse est expedita hic impedit iusto laborum libero maxime, nemo, nulla perspiciatis porro quae quod sequi sit. Aut beatae cum cupiditate debitis dolore, doloremque eum excepturi iste nihil provident quidem, ratione reiciendis rerum sed sit ut vel vero! A ad expedita impedit iste omnis perferendis ratione sequi vel voluptas, voluptatum. Aliquid animi delectus doloribus, enim error esse eum ipsa ipsam magnam maiores nisi placeat quae quod repellat repellendus sapiente sed temporibus tenetur vel, velit? Accusamus accusantium, aliquam amet consequatur dicta ea eum itaque quam quidem quod ratione sapiente tempora tempore totam voluptates! Accusamus ad, aliquam consectetur corporis eius expedita illum ipsum molestiae repudiandae saepe.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно подробной информации об анализе-->
<div class="modal fade" tabindex="-1" id="openModalInfoExamination">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Результаты обследования №1234 от 10.01.2010</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-muted">Принимал специалист: <a href="" class="text-decoration-none text-danger">Иванов И. И.</a></h5>
                <h5 class="text-muted">Название: Общий анализ крови</h5>
                <h5 class="text-muted">Результаты:</h5>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно удаления записи-->
<div class="modal fade" tabindex="-1" id="openModalRemoveNote" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" >
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    Вы уверены, что хотите удалить данную запись?
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
    $('#table_epicrisis, #table_examinations, #table_disease, #table_recommendations, #table_pills').DataTable({
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
        autoWidth: false
    });
</script>
</html>