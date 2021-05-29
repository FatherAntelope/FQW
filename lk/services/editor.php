<?php
// Если токен авторизованного пользователя не существует, то направляет на страницу ошибки 401 (нет авторизации)
if(!isset($_COOKIE['user_token']))
    header("Location: /error/401.php");
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";

// Выгрузка данных пользователя
$user = new User($_COOKIE['user_token']);

// Если HTTP-код после обращения к выгрузке данных пользователя по API 400 или 403, то
// очищаются Cookie и происходит направление на страницу ошибки 401
if($user->getStatusCode() === 400 || $user->getStatusCode() === 403) {
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.php");
}
// Если роль пользователя не "Админ", то направляет на страницу ошибки 403
if(!$user->isUserRole("Admin"))
    header("Location: /error/403.php");

// Выгружает данные пользователя
$user_data = $user->getData();
$whose_user = 1;

// Если GET не содержит в переменной selected необходимого значения
// то выход на страницу профиля
$getSelected = $_GET['selected'];
if($getSelected != "specializations" &&
    $getSelected != "procedures" &&
    $getSelected != "examinations" &&
    $getSelected != "events") {
    header("Location: /lk/");
    exit;
}
?>
<!--
Страница просмотра и создания услуг у администратора
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
                <li class="breadcrumb-item active" aria-current="page">Управление услугами</li>
            </ol>
        </nav>
<!--Содержимое таблиста-->
        <ul class="nav nav-pills flex-column flex-sm-row mb-2" role="tablist">
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
<!-- Имитирует активацию нажатия на гиперссылку, если selected=specializations-->
                <a class="nav-link tab-bg-active font-weight-bold <? if($getSelected == 'specializations') echo "active";?>" onclick="window.history.pushState('', '', '/lk/services/editor.php?selected=specializations');" data-toggle="tab" href="#tab-specializations" role="tab">
                    <i class="fas fa-user-md mr-2"></i>Специальности
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <? if($getSelected == 'procedures') echo "active";?>" onclick="window.history.pushState('', '', '/lk/services/editor.php?selected=procedures');" data-toggle="tab" href="#tab-procedures" role="tab">
                    <i class="fas fa-diagnoses mr-2"></i>Процедуры
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <? if($getSelected == 'examinations') echo "active";?>" onclick="window.history.pushState('', '', '/lk/services/editor.php?selected=examinations');" data-toggle="tab" href="#tab-examinations" role="tab">
                    <i class="fas fa-microscope mr-1"></i>Обследования
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <? if($getSelected == 'events') echo "active";?>" onclick="window.history.pushState('', '', '/lk/services/editor.php?selected=events');" data-toggle="tab" href="#tab-events" role="tab">
                    <i class="fas fa-walking mr-1"></i>Мероприятия
                </a>
            </li>
        </ul>

<!--Контент таблиста-->
        <div class="tab-content">
            <!--
            Имитирует активацию нажатия на гиперссылку, если selected=specializations.
            Содержимое таблиста специализации
            -->
            <div class="tab-pane fade show <? if($getSelected == 'specializations') echo "active";?>" id="tab-specializations" role="tabpanel">
                <div class="card d-flex align-items-center">
                    <div class="card-body" style="max-width: 800px">
                        <button type="submit" class="btn btn-sm btn-success float-right text-white mb-2" data-toggle="modal" data-target="#openModalCreateSpecialization">
                            <i class="fas fa-plus-circle mr-2"></i>Создать специальность
                        </button>
<!--Таблица с динамическим поиском по ее полям-->
                        <table id="table_doctors" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Специалисты</th>
                                <th>Стоимость, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
<!--При сужении таблицы в ячейке слева появляется содержимое data-label-->
                                <td class="text-muted" data-label="Название:">Терапевт</td>
                                <td class="text-muted" data-label="Спец.-ты:">Иванов И. И., Кузнецов К. К.</td>
                                <td class="text-muted" data-label="Сто.-ть:">300</td>
                                <td>
                                    <button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button>
                                    <button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveService">Удаление</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Название:">Сурдолог</td>
                                <td class="text-muted" data-label="Спец.-ты:">Иванов И. И.</td>
                                <td class="text-muted" data-label="Стоимость:">400</td>
                                <td>
                                    <button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button>
                                    <button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveService">Удаление</button>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Специалисты</th>
                                <th>Стоимость, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

<!--Содержимое таблиста процедур-->
            <div class="tab-pane fade show <? if($getSelected == 'procedures') echo "active";?>" id="tab-procedures" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-sm btn-success float-right text-white mb-2" data-toggle="modal" data-target="#openModalCreateProcedure">
                            <i class="fas fa-plus-circle mr-2"></i>Создать процедуру
                        </button>
                        <table id="table_procedures" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Специалисты</th>
                                <th>Противопоказания</th>
                                <th>Назначения</th>
                                <th>Стоимость, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Название:">Карбокситерапия</td>
                                <td class="text-muted" data-label="Спец.-ты:">
                                    Иванов И. И, Кузнецов К. К.
                                </td>
                                <td class="text-muted" data-label="Прот.-ия:">
                                    <ul class="list-unstyled">
                                        <li><span class="badge badge-pill badge-danger">Эпилепсия</span></li>
                                        <li><span class="badge badge-pill badge-danger">Прием антикоагулянтов</span></li>
                                        <li><span class="badge badge-pill badge-danger">Стойкая гипертония</span></li>
                                    </ul>
                                </td>
                                <td class="text-muted" data-label="Назн.-ия:">
                                    <ul class="list-unstyled">
                                        <li><span class="badge badge-pill badge-success">Дряблая кожа</span></li>
                                        <li><span class="badge badge-pill badge-success">Круги под глазами</span></li>
                                        <li><span class="badge badge-pill badge-success">Целлюлит</span></li>
                                        <li><span class="badge badge-pill badge-success">Рубцы и шрамы</span></li>
                                    </ul>
                                </td>
                                <td class="text-muted" data-label="Стоимость:">500</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--cyan-color)">Просмотр</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary btn-block" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger btn-block" data-toggle="modal" data-target="#openModalRemoveService">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Специалисты</th>
                                <th>Противопоказания</th>
                                <th>Назначения</th>
                                <th>Стоимость, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

<!--Содержимое таблиста обследования-->
            <div class="tab-pane fade show <? if($getSelected == 'examinations') echo "active";?>" id="tab-examinations" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-sm btn-success float-right text-white mb-2" data-toggle="modal" data-target="#openModalCreateExamination">
                            <i class="fas fa-plus-circle mr-2"></i>Создать обследование
                        </button>
                        <table id="table_examinations" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Специалисты</th>
                                <th>Назначения</th>
                                <th>Стоимость, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Название:">ОАК</td>
                                <td class="text-muted" data-label="Спец.-ты:">
                                    Иванов И. И, Кузнецов К. К.
                                </td>
                                <td class="text-muted" data-label="Назн.-ия:">
                                    <ul class="list-unstyled">
                                        <li><span class="badge badge-pill badge-success">...</span></li>
                                        <li><span class="badge badge-pill badge-success">...</span></li>
                                    </ul>
                                </td>
                                <td class="text-muted" data-label="Стоимость:">500</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--cyan-color)">Просмотр</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary btn-block" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger btn-block" data-toggle="modal" data-target="#openModalRemoveService">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Специалисты</th>
                                <th>Назначения</th>
                                <th>Стоимость, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

<!--Содержимое таблиста мероприятий-->
            <div class="tab-pane fade show <? if($getSelected == 'events') echo "active";?>" id="tab-events" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-sm btn-success float-right text-white mb-2" data-toggle="modal" data-target="#openModalCreateEvent">
                            <i class="fas fa-plus-circle mr-2"></i>Создать мероприятие
                        </button>
                        <table id="table_events" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Специалисты</th>
                                <th>Даты проведения</th>
                                <th>Стоимость, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Название:">Экскурсия по зоопарку</td>
                                <td class="text-muted" data-label="Спец.-ты:">
                                    Иванов И. И, Кузнецов К. К.
                                </td>
                                <td class="text-muted" data-label="Даты:">
                                    10.10.2020 - бессрочно
                                </td>
                                <td class="text-muted" data-label="Стоимость:">500</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--cyan-color)">Просмотр</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary btn-block" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger btn-block" data-toggle="modal" data-target="#openModalRemoveService">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Специалисты</th>
                                <th>Даты проведения</th>
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

<!--Модальное окно создания специальности-->
<div class="modal fade" tabindex="-1" id="openModalCreateSpecialization" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Создание врачебной специальности</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Внимательно создавайте специальности. Проверяйте заполненные поля перед созданием специальности
                </div>
                <form id="queryAddServiceSpecialization">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-7">
                                <label style="color: var(--yellow-color)">Название специальности <strong style="color: var(--red--color)">*</strong></label>
                                <input type="text" name="service_name" class="form-control" maxlength="30" required>
                                <small class="text-muted form-text">Кириллица</small>
                            </div>
                            <div class="col-lg-5">
                                <label style="color: var(--yellow-color)">Стоимость услуги (руб.) <strong style="color: var(--red--color)">*</strong></label>
                                <input type="number" min="0" max="100000" name="service_cost" class="form-control" placeholder="Введите стоимость" required>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="alert alert-success" role="alert" id="alertSuccessAddServiceSpecialization" hidden>
                    Специальность успешно создана, теперь она появится в таблице
                </div>
                <div class="alert alert-danger alert-dismissible fade show animate slideIn" role="alert" id="alertErrorAddServiceSpecialization" style="font-size: 12px" hidden>
                    Специальность с указанным названием уже существует!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-success" form="queryAddServiceSpecialization">Создать</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно создания процедуры-->
<div class="modal fade" tabindex="-1" id="openModalCreateProcedure" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Создание процедуры</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Внимательно создавайте процедуры. Проверяйте заполненные поля перед созданием процедуры
                </div>
                <form id="queryAddServiceProcedure">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5">
                                <label style="color: var(--yellow-color)">Название процедуры <strong style="color: var(--red--color)">*</strong></label>
                                <input type="text" name="service_name" maxlength="30" class="form-control" required>

                            </div>
                            <div class="col-lg-3">
                                <label style="color: var(--yellow-color)">Стоимость услуги (руб.) <strong style="color: var(--red--color)">*</strong></label>
                                <input type="number" min="0" max="100000" name="service_cost" class="form-control" placeholder="Введите стоимость" required>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Фото <strong style="color: var(--red--color)">*</strong></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="procedure_photo" accept="image/*">
                                        <label class="custom-file-label" for="customFile" data-browse="Открыть">Выберите фото</label>
                                        <small class="text-muted form-text">До 2 Мб</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Описание процедуры <strong style="color: var(--red--color)">*</strong></label>
                                    <textarea class="form-control" minlength="20" maxlength="5000" placeholder="Назначение процедуры, ее описание и т.п." name="procedure_description" required></textarea>
                                    <small class="text-muted form-text">От 20 до 5000 символов</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6" id="list_contraindications_procedure">
                                <label style="color: var(--yellow-color)">Противопоказания</label>
                                <table class="table table-sm table-borderless information_json">
                                    <tr class="information_json_plus">
                                        <td class="pl-0">
                                                <span class="btn btn-sm btn-success rounded-circle plus-contraindications">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                        </td>
                                        <td class="pl-0"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-6" id="list_destinations_procedure">
                                <label style="color: var(--yellow-color)">Назначения</label>
                                <table class="table table-sm table-borderless information_json">
                                    <tr class="information_json_plus">
                                        <td class="pl-0">
                                                <span class="btn btn-sm btn-success rounded-circle plus-destinations_procedure">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                        </td>
                                        <td class="pl-0"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="alert alert-success" role="alert" id="alertSuccessAddServiceProcedure" hidden>
                    Процедура успешно создана, теперь она появится в таблице
                </div>
                <div class="alert alert-danger alert-dismissible fade show animate slideIn" role="alert" style="font-size: 12px" id="alertErrorAddServiceProcedure" hidden>
                    Процедура с указанным названием уже существует!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-success" form="queryAddServiceProcedure">Создать</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно создания обследования-->
<div class="modal fade" tabindex="-1" id="openModalCreateExamination" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Создание медицинского обследования</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Внимательно создавайте обследования. Проверяйте заполненные поля перед созданием обследования
                </div>
                <form id="queryAddServiceExamination">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5">
                                <label style="color: var(--yellow-color)">Название обследования <strong style="color: var(--red--color)">*</strong></label>
                                <input type="text" name="service_name" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label style="color: var(--yellow-color)">Стоимость услуги (руб.) <strong style="color: var(--red--color)">*</strong></label>
                                <input type="number" min="0" name="service_cost" class="form-control" placeholder="Введите стоимость" required>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Фото <strong style="color: var(--red--color)">*</strong></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="examination_photo" accept="image/*">
                                        <label class="custom-file-label" for="customFile" data-browse="Открыть">Выберите фото</label>
                                        <small class="text-muted form-text">До 2 Мб</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-lg-3">
                            <div class="col">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Описание обследования <strong style="color: var(--red--color)">*</strong></label>
                                    <textarea class="form-control" name="examination_description" minlength="20" maxlength="5000" placeholder="Назначение обследование, ее описание и т.п." required></textarea>
                                    <small class="text-muted form-text">От 20 до 5000 символов</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6" id="list_destinations_examination"> <!------ЕСЛИ БУДЕТ ОШИБКА ПРИ СОЗДАНИИ ПРОЦЕДУРЫ, ТО СМЕНИТЬ ID---->
                                <label style="color: var(--yellow-color)">Назначения</label>
                                <table class="table table-sm table-borderless information_json">
                                    <tr class="information_json_plus">
                                        <td class="pl-0">
                                                <span class="btn btn-sm btn-success rounded-circle plus-destinations_examination">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                        </td>
                                        <td class="pl-0"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="alert alert-success" role="alert" id="alertSuccessAddServiceExamination" hidden>
                    Обследование успешно создано, теперь оно появится в таблице
                </div>
                <div class="alert alert-danger alert-dismissible fade show animate slideIn" id="alertErrorAddServiceExamination" role="alert" style="font-size: 12px" hidden>
                    Обследование с указанным названием уже существует!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-success" form="queryAddServiceExamination">Создать</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно создания мероприятия-->
<div class="modal fade" tabindex="-1" id="openModalCreateEvent" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Создание мероприятия</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Внимательно создавайте мероприятия. Проверяйте заполненные поля перед созданием мероприятия
                </div>
                <form id="queryAddServiceEvent">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5">
                                <label style="color: var(--yellow-color)">Название мероприятия<strong style="color: var(--red--color)">*</strong></label>
                                <input type="text" name="service_name" class="form-control required">
                            </div>
                            <div class="col-lg-3">
                                <label style="color: var(--yellow-color)">Стоимость услуги (руб.) <strong style="color: var(--red--color)">*</strong></label>
                                <input type="number" min="0" name="service_cost" class="form-control" placeholder="Введите стоимость" required>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Фото <strong style="color: var(--red--color)">*</strong></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="examination_photo" accept="image/*">
                                        <label class="custom-file-label" for="customFile" data-browse="Открыть">Выберите фото</label>
                                        <small class="text-muted form-text">До 2 Мб</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-lg-3">
                            <div class="col">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Описание мероприятия <strong style="color: var(--red--color)">*</strong></label>
                                    <textarea class="form-control" name="event_description" minlength="20" maxlength="5000" placeholder="Назначение мероприятия, ее описание и т.п." required></textarea>
                                    <small class="text-muted form-text">От 20 до 5000 символов</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <label style="color: var(--yellow-color)">Дата начала мероприятия<strong style="color: var(--red--color)">*</strong></label>
                                <input type="date" name="event_date_start" class="form-control" required>
                            </div>
                            <div class="col-lg-5">
                                <label style="color: var(--yellow-color)">Дата окончания мероприятия</label>
                                <input type="date" name="event_date_end" class="form-control">
                                <small class="form-text text-muted">
                                    Оставьте поле пустым, если мероприятие непрерывно
                                </small>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="alert alert-success" role="alert" id="alertSuccessAddServiceEvent" hidden>
                    Мероприятие успешно создано, теперь оно появится в таблице
                </div>
                <div class="alert alert-danger alert-dismissible fade show animate slideIn" role="alert" id="alertErrorAddServiceEvent" style="font-size: 12px" hidden>
                    Мероприятие с указанным названием уже существует!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-success" form="queryAddServiceEvent">Создать</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное удаления услуги-->
<div class="modal fade" tabindex="-1" id="openModalRemoveService" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    Вы уверены, что хотите удалить специальность/процедуру/обследование/мероприятие?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Нет</button>
                <form id="queryDeleteService">
                    <input type="hidden" name="service_id" value="1">
                    <button type="submit" class="btn btn-success">Да</button>
                </form>
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

    //Передает путь в placeholder поля к полю загрузки изображения
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    /**
     * Прослушивает страницу и срабатывает при вызове события
     * Click при нажатии на иконку плюса в противопоказаниях процедуры.
     * Добавляет поле для ввода противопоказания и кнопку с иконкой удаления данного поля
     */
    $(document).on('click', '.plus-contraindications', function(){
        $(this).closest('.information_json_plus').before(
            '<tr>' +
            '<td class="pl-0"><input type="text" class="form-control" name="procedure_contraindications[]" maxlength="30" placeholder="Противопоказание" required></td>' +
            '<td class="pl-0"><span class="btn btn-sm btn-danger rounded-circle minus mt-1"><i class="fas fa-minus"></i></span></td>' +
            '</tr>'
        );
    });
    /**
     * Прослушивает страницу и срабатывает при вызове события
     * Click при нажатии на иконку плюса в назначениях процедуры.
     * Добавляет поле для ввода противопоказания и кнопку с иконкой удаления данного поля
     */
    $(document).on('click', '.plus-destinations_procedure', function(){
        $(this).closest('.information_json_plus').before(
            '<tr>' +
            '<td class="pl-0"><input type="text" class="form-control" name="procedure_destinations[]" maxlength="30" placeholder="Назначение" required></td>' +
            '<td class="pl-0"><span class="btn btn-sm btn-danger rounded-circle minus mt-1"><i class="fas fa-minus"></i></span></td>' +
            '</tr>'
        );
    });
    /**
     * Прослушивает страницу и срабатывает при вызове события
     * Click при нажатии на иконку плюса в назначениях обследования.
     * Добавляет поле для ввода противопоказания и кнопку с иконкой удаления данного поля
     */
    $(document).on('click', '.plus-destinations_examination', function(){
        $(this).closest('.information_json_plus').before(
            '<tr>' +
            '<td class="pl-0"><input type="text" class="form-control" name="examination_destinations[]" maxlength="30" placeholder="Назначение" required></td>' +
            '<td class="pl-0"><span class="btn btn-sm btn-danger rounded-circle minus mt-1"><i class="fas fa-minus"></i></span></td>' +
            '</tr>'
        );
    });

    // Удаляет, созданные по скриптам выше по нажатию кнопки удаления
    $(document).on('click', '.minus', function(){
        $(this).closest('tr').remove();
    });

    // Конфигурация динамических таблиц
    $('#table_doctors, #table_procedures, #table_examinations, #table_events').DataTable({
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
<script>
    /**
     * Ожидает отправки формы #queryDeleteService.
     * Отправляет AJAX (асинхронный) запрос для удаления услуги.
     * success: закрывает модальное окно, на котором располагается форма
     */
    $("#queryDeleteService").submit(function () {
        $.ajax({
            url: "/queries/admin/deleteService.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#openModalRemoveService").modal('hide');
            }
        });
        return false;
    });

    /**
     * Ожидает отправки формы #queryAddServiceSpecialization.
     * Отправляет AJAX (асинхронный) запрос для добавления специальности.
     * success: скрывает всплывающее сообщение ошибки создания специализации, а также скрывает содержимое формы,
     * добавляет сообщение об успешном создании специальности и обновляет страницу через 2 секунды
     *
     * error: отображает всплывающее сообщение ошибки создания специализации
     */
    $("#queryAddServiceSpecialization").submit(function () {
        $.ajax({
            url: "/queries/admin/addService.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#alertErrorAddServiceSpecialization").attr("hidden", "hidden");
                $("#queryAddServiceSpecialization").attr("hidden", "hidden");
                $("#queryAddServiceSpecialization").prev().attr("hidden", "hidden");
                $("#queryAddServiceSpecialization").parent().next().attr("hidden", "hidden");
                $("#alertSuccessAddServiceSpecialization").removeAttr("hidden");
                setTimeout(function(){ location.reload(); }, 2000);
            },
            error: function () {
                $("#alertErrorAddServiceSpecialization").removeAttr("hidden");
            }
        });
        return false;
    });

    /**
     * Ожидает отправки формы #queryAddServiceProcedure.
     * Отправляет AJAX (асинхронный) запрос для добавления процедуры.
     * success: скрывает всплывающее сообщение ошибки создания процедуры, а также скрывает содержимое формы,
     * добавляет сообщение об успешном создании процедуры и обновляет страницу через 2 секунды
     *
     * error: отображает всплывающее сообщение ошибки создания процедуры
     */
    $("#queryAddServiceProcedure").submit(function () {
        $.ajax({
            url: "/queries/admin/addService.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#alertErrorAddServiceProcedure").attr("hidden", "hidden");
                $("#queryAddServiceProcedure").attr("hidden", "hidden");
                $("#queryAddServiceProcedure").prev().attr("hidden", "hidden");
                $("#queryAddServiceProcedure").parent().next().attr("hidden", "hidden");
                $("#alertSuccessAddServiceProcedure").removeAttr("hidden");
                setTimeout(function(){ location.reload(); }, 2000);

            },
            error: function () {
                $("#alertErrorAddServiceProcedure").removeAttr("hidden");
            }
        });
        return false;
    });

    /**
     * Ожидает отправки формы #queryAddServiceExamination.
     * Отправляет AJAX (асинхронный) запрос для добавления обследования.
     * success: скрывает всплывающее сообщение ошибки создания обследования, а также скрывает содержимое формы,
     * добавляет сообщение об успешном создании процедуры и обновляет страницу через 2 секунды
     *
     * error: отображает всплывающее сообщение ошибки создания обследования
     */
    $("#queryAddServiceExamination").submit(function () {
        $.ajax({
            url: "/queries/admin/addService.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#alertErrorAddServiceExamination").attr("hidden", "hidden");
                $("#queryAddServiceExamination").attr("hidden", "hidden");
                $("#queryAddServiceExamination").prev().attr("hidden", "hidden");
                $("#queryAddServiceExamination").parent().next().attr("hidden", "hidden");
                $("#alertSuccessAddServiceExamination").removeAttr("hidden");
                setTimeout(function(){ location.reload(); }, 2000);

            },
            error: function () {
                $("#alertErrorAddServiceExamination").removeAttr("hidden");
            }
        });
        return false;
    });

    /**
     * Ожидает отправки формы #queryAddServiceEvent.
     * Отправляет AJAX (асинхронный) запрос для добавления мероприятия.
     * success: скрывает всплывающее сообщение ошибки создания мероприятия, а также скрывает содержимое формы,
     * добавляет сообщение об успешном создании процедуры и обновляет страницу через 2 секунды
     *
     * error: отображает всплывающее сообщение ошибки создания мероприятия
     */
    $("#queryAddServiceEvent").submit(function () {
        $.ajax({
            url: "/queries/admin/addService.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#alertErrorAddServiceEvent").attr("hidden", "hidden");
                $("#queryAddServiceEvent").attr("hidden", "hidden");
                $("#queryAddServiceEvent").prev().attr("hidden", "hidden");
                $("#queryAddServiceEvent").parent().next().attr("hidden", "hidden");
                $("#alertSuccessAddServiceEvent").removeAttr("hidden");
                setTimeout(function(){ location.reload(); }, 2000);

            },
            error: function () {
                $("#alertErrorAddServiceEvent").removeAttr("hidden");
            }
        });
        return false;
    });
</script>
</html>
