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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/js/datatables.js"></script>
    <script defer src="/js/all.js"></script>
    <title>СанКонтроль</title>
</head>
<body>
<!--Меню для авторизованного пользователя-->
<nav class="navbar fixed-top navbar-expand-sm navbar-light p-0" style="background: var(--cyan-color);">
    <div class="container">
        <!--Бургер-кнопка для развертывания панели навигации в мобильном формате-->
        <button class="navbar-toggler ml-3" data-toggle="collapse" data-target="#offcanvas" style="background: var(--yellow-color)">
            <i class="fas fa-bars" style="color: #fff"></i>
        </button>

        <!--Иконка бренда (мини) в мобильном формате-->
        <a class="navbar-brand" id="logo-small" href="#">
            <img src="/images/logo-mini.png" alt="" height="40">
        </a>

        <!--Иконка бренда (мини) в широком формате-->
        <a class="navbar-brand" id="logo-big" href="#">
            <img src="/images/logo.png" alt="" height="40">
        </a>

        <!--Содержимое меню-->
        <ul class="nav">
            <!--Раздел новостей-->
            <li>
                <a class="nav-link arrow-none notify-icon" href="#">
                    <i class="bi bi-newspaper"></i>
                </a>
            </li>
            <!--Раздел уведомлений-->
            <li class="dropdown">
                <!--Кнопка для развертывания выпадающего меню с уведомлениями-->
                <a class="nav-link arrow-none notify-icon" href="#" id="dropdown-notify" data-toggle="dropdown">
                    <i class="bi bi-bell-fill"></i>
                    <span class="notify-icon-dot">
                        <i class="bi bi-circle-fill" style="color: var(--red--color)"></i>
                    </span>
                </a>
                <!--Выпадающее меню с уведомлениями-->
                <div class="dropdown-menu dropdown-menu-right animate slideIn m-0"
                     style="min-width: 30rem;" aria-labelledby="dropdown-notify">
                    <div class="dropdown-header">
                        <h6 style="position: relative">
                            <span class="float-right">
                                <a href="#" class="text-danger text-decoration-none">
                                    <small>Очистить</small>
                                </a>
                            </span>
                            <span>Уведомления</span>
                        </h6>
                    </div>
                    <hr class="m-0">
                    <div class="notifications-scrollbar">
                        <!--Список уведомлений-->
                        <div class="notifications">
                            <div class="notification">
                                <div class="notification-icon">
                                    <i class="bi bi-credit-card-2-back-fill" style="color: #fff; background-color: var(--dark-cyan-color)"></i>
                                </div>
                                <div class="content">
                                    <a class="header stretched-link" href="#">"Тип уведомления"</a>
                                    <div class="text">"Описание уведомления"</div>
                                    <div class="actions">
                                        <p>"10.10.2000"</p>
                                    </div>
                                </div>
                            </div>
                            <div class="notification">
                                <div class="notification-icon">
                                    <i class="bi bi-credit-card-2-back-fill" style="color: #fff; background-color: var(--dark-cyan-color)"></i>
                                </div>
                                <div class="content">
                                    <a class="header stretched-link" href="#">"Тип уведомления"</a>
                                    <div class="text">"Описание уведомления"</div>
                                    <div class="actions">
                                        <p>"10.10.2000"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <!--Раздел пользовательской панели-->
            <li class="dropdown">
                <!--Кнопка развертывания выпадающего меню со списком управления пользовательской панелью-->
                <a class="nav-link arrow-none nav-user" href="#" id="dropdown-menu-user" data-toggle="dropdown">
                    <span class="account-user-avatar">
                        <img src="/images/user.png" alt="user-image" class="rounded-circle" height="40">
                    </span>
                    <span>
                        <span class="account-user-name">"Имя Фамилия"</span>
                        <span class="account-role">"Роль"</span>
                    </span>
                </a>
                <!--Выпадающее меню со списком управления пользовательской панелью-->
                <div class="dropdown-menu dropdown-menu-right animate slideIn" style="margin: 0" aria-labelledby="dropdown-menu-user">
                    <a class="dropdown-item" href="#" style="color: var(--dark-cyan-color)">
                        <i class="fas fa-id-card mr-2"></i>
                        Профиль
                    </a>
                    <a class="dropdown-item" href="#" style="color: var(--dark-cyan-color)">
                        <i class="fas fa-cog mr-2"></i>
                        Настройки
                    </a>
                    <a class="dropdown-item" href="#" style="color: var(--dark-cyan-color)">
                        <i class="fas fa-door-open mr-2"></i>
                        Выйти
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!--Панель навигации по модулям пользователя-->
<div class="topnav shadow-lg fixed-top" style="top: 3.7rem">
    <div class="container">
        <nav class="navbar navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse justify-content-center" id="offcanvas">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-chart-bar mr-1"></i>
                            Статистика
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-navbar disabled" aria-haspopup="true">
                            <i class="fas fa-comments mr-1"></i>
                            Чат
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-newspaper mr-1"></i>
                            Новости
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-utensils mr-1"></i>
                            Питание
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-procedures mr-1"></i>
                            Услуги
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-users mr-1"></i>
                            Пользователи
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-navbar disabled" aria-haspopup="true">
                            <i class="fas fa-comment-medical mr-1"></i>
                            Анкетирование
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-question-circle mr-1"></i>
                            FAQ's
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>


<div class="page-content">
    <div class="container pt-3 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" style="color: var(--dark-cyan-color)">Профиль</a></li>
                <li class="breadcrumb-item active" aria-current="page">Управление услугами</li>
            </ol>
        </nav>
        <ul class="nav nav-pills flex-column flex-sm-row mb-2" role="tablist">
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold active" data-toggle="tab" href="#tab-specializations" role="tab">
                    <i class="fas fa-user-md mr-2"></i>Специальности
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#tab-procedures" role="tab">
                    <i class="fas fa-diagnoses mr-2"></i>Процедуры
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#tab-examinations" role="tab">
                    <i class="fas fa-microscope mr-1"></i>Обследования
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#tab-events" role="tab">
                    <i class="fas fa-walking mr-1"></i>Мероприятия
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-specializations" role="tabpanel">
                <div class="card d-flex align-items-center">
                    <div class="card-body" style="max-width: 600px">
                        <button type="submit" class="btn btn-sm btn-success float-right text-white mb-2" data-toggle="modal" data-target="#openModalCreateSpecialization">
                            <i class="fas fa-plus-circle mr-2"></i>Создать специальность
                        </button>
                        <table id="table_doctors" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Название:">Терапевт</td>
                                <td>
                                    <button type="button" class="btn mt-1 btn-sm btn-warning text-white" style="background-color: var(--yellow-color)">Редактирование</button>
                                    <button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveServices">Удаление</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Название:">Сурдолог</td>
                                <td>
                                    <button type="button" class="btn mt-1 btn-sm btn-warning text-white" style="background-color: var(--yellow-color)">Редактирование</button>
                                    <button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveServices">Удаление</button>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show" id="tab-procedures" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-sm btn-success float-right text-white mb-2" data-toggle="modal" data-target="#openModalCreateProcedure">
                            <i class="fas fa-plus-circle mr-2"></i>Создать процедуру
                        </button>
                        <table id="table_procedures" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Противопоказания</th>
                                <th>Назначения</th>
                                <th>Цена, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Название:">Карбокситерапия</td>
                                <td class="text-muted" data-label="Описание:">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, saepe...
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
                                <td class="text-muted" data-label="Цена, р.:">500</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--cyan-color)">Просмотр</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-white btn-block" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger btn-block" data-toggle="modal" data-target="#openModalRemoveServices">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Противопоказания</th>
                                <th>Назначения</th>
                                <th>Цена, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show" id="tab-examinations" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-sm btn-success float-right text-white mb-2" data-toggle="modal" data-target="#openModalCreateExamination">
                            <i class="fas fa-plus-circle mr-2"></i>Создать обследование
                        </button>
                        <table id="table_examinations" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Назначения</th>
                                <th>Цена, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Название:">ОАК</td>
                                <td class="text-muted" data-label="Описание:">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, saepe...
                                </td>
                                <td class="text-muted" data-label="Назн.-ия:">
                                    <ul class="list-unstyled">
                                        <li><span class="badge badge-pill badge-success">...</span></li>
                                        <li><span class="badge badge-pill badge-success">...</span></li>
                                    </ul>
                                </td>
                                <td class="text-muted" data-label="Цена, р.:">500</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--cyan-color)">Просмотр</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-white btn-block" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger btn-block" data-toggle="modal" data-target="#openModalRemoveServices">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Название</th>
                                <th>Противопоказания</th>
                                <th>Назначения</th>
                                <th>Цена, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show" id="tab-events" role="tabpanel">
                4
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
                    Внимательно создавайте специальности. Проверяйте заполненные поля перед созданием специальности.
                </div>
                <form>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="color: var(--yellow-color)">Название специальности <strong style="color: var(--red--color)">*</strong></label>
                                <input type="text" name="specialization_name" class="form-control" placeholder="На русском" required>
                            </div>
                            <div class="col-md-4">
                                <label style="color: var(--yellow-color)">Цена услуги (руб.) <strong style="color: var(--red--color)">*</strong></label>
                                <input type="number" min="0" name="specialization_cost" class="form-control" placeholder="Введите цену" required>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="alert alert-danger alert-dismissible fade show animate slideIn" role="alert" style="font-size: 12px">
                    Специальность с указанным названием уже существует!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-success">Создать</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно создания процедуры-->
<div class="modal fade" tabindex="-1" id="openModalCreateProcedure" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Создание процедуры</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Внимательно создавайте процедуры. Проверяйте заполненные поля перед созданием процедуры.
                </div>
                <form>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <label style="color: var(--yellow-color)">Название процедуры <strong style="color: var(--red--color)">*</strong></label>
                                <input type="text" name="procedure_name" class="form-control" placeholder="На русском" required>
                            </div>
                            <div class="col-md-3">
                                <label style="color: var(--yellow-color)">Цена услуги (руб.) <strong style="color: var(--red--color)">*</strong></label>
                                <input type="number" min="0" name="procedure_cost" class="form-control" placeholder="Введите цену" required>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Фото <strong style="color: var(--red--color)">*</strong></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" accept="image/*">
                                        <label class="custom-file-label" for="customFile" data-browse="Открыть">Выберите фото</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Описание процедуры <strong style="color: var(--red--color)">*</strong></label>
                                    <textarea class="form-control" placeholder="Назначение процедуры, ее описание и т.п."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6" id="list_contraindications">
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
                            <div class="col-lg-6" id="list_destinations">
                                <label style="color: var(--yellow-color)">Назначения</label>
                                <table class="table table-sm table-borderless information_json">
                                    <tr class="information_json_plus">
                                        <td class="pl-0">
                                                <span class="btn btn-sm btn-success rounded-circle plus-destinations">
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
                <div class="alert alert-danger alert-dismissible fade show animate slideIn" role="alert" style="font-size: 12px">
                    Процедура с указанным названием уже существует!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-success">Создать</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно создания обследования-->
<div class="modal fade" tabindex="-1" id="openModalCreateExamination" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Создание медицинского обследования</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Внимательно создавайте обследования. Проверяйте заполненные поля перед созданием обследования.
                </div>
                <form>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label style="color: var(--yellow-color)">Название обследования <strong style="color: var(--red--color)">*</strong></label>
                                <input type="text" name="examination_name" class="form-control" placeholder="На русском" required>
                            </div>
                            <div class="col-md-4">
                                <label style="color: var(--yellow-color)">Цена услуги (руб.) <strong style="color: var(--red--color)">*</strong></label>
                                <input type="number" min="0" name="examination_cost" class="form-control" placeholder="Введите цену" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Описание обследования <strong style="color: var(--red--color)">*</strong></label>
                                    <textarea class="form-control" placeholder="Назначение обследование, ее описание и т.п."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6" id="list_destinations"> <!------ЕСЛИ БУДЕТ ОШИБКА ПРИ СОЗДАНИИ ПРОЦЕДУРЫ, ТО СМЕНИТЬ ID---->
                                <label style="color: var(--yellow-color)">Назначения</label>
                                <table class="table table-sm table-borderless information_json">
                                    <tr class="information_json_plus">
                                        <td class="pl-0">
                                                <span class="btn btn-sm btn-success rounded-circle plus-destinations">
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
                <div class="alert alert-danger alert-dismissible fade show animate slideIn" role="alert" style="font-size: 12px">
                    Процедура с указанным названием уже существует!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-success">Создать</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно отмены записи-->
<div class="modal fade" tabindex="-1" id="openModalRemoveServices" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    Вы уверены, что хотите удалить специальность/процедуру/обследование/мероприятие?
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
<footer style="background-color: var(--cyan-color)">
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <a href="/">
                            <img src="/images/logo.png" height="40">
                        </a>
                        <p class="mt-2 text-white opacity-8 pr-lg-4">
                            Медицинская информационная система для повышения эффективности процесса рекреации в санатории, мобильности и оперативности информационной поддержки
                        </p>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="tel:+7 (999) 999-99-99" aria-haspopup="true">
                                    <h4> <i class="fas fa-phone mr-1"></i> +7 (999) 999-99-99</h4>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:mail@mail.ru" aria-haspopup="true">
                                    <i class="fas fa-envelope-open-text mr-1"></i>
                                    mail@mail.ru
                                </a>
                            </li>
                            <li>
                                <a href="https://yandex.ru/maps/org/raduga/1249162221/?display-text=%D0%A1%D0%B0%D0%BD%D0%B0%D1%82%D0%BE%D1%80%D0%B8%D0%B9%20%D0%A0%D0%B0%D0%B4%D1%83%D0%B3%D0%B0&ll=56.012919%2C54.703989&mode=search&sll=55.943574%2C54.768878&sspn=0.134043%2C0.045012&text=%D0%A1%D0%B0%D0%BD%D0%B0%D1%82%D0%BE%D1%80%D0%B8%D0%B9%20%D0%A0%D0%B0%D0%B4%D1%83%D0%B3%D0%B0&z=16.43" aria-haspopup="true">
                                    <i class="fas fa-map-marked-alt mr-1"></i>
                                    Уфа, Санаторий Радуга, ул. Авроры, 14/1
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 ml-lg-auto mb-5 mb-lg-0">
                        <h6 class="heading mb-3" style="font-weight: 700 ;color: var(--yellow-color)">Аккаунт</h6>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="#">Статистика</a>
                            </li>
                            <li>
                                <a href="#">Чат</a>
                            </li>
                            <li>
                                <a href="#">Новости</a>
                            </li>
                            <li>
                                <a href="#">Питание</a>
                            </li>
                            <li>
                                <a href="#">Услуги</a>
                            </li>
                            <li>
                                <a href="#">Пользователи</a>
                            </li>
                            <li>
                                <a href="#">Анкетирование</a>
                            </li>
                            <li>
                                <a href="#">FAQ's</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                        <h6 class="heading mb-3" style="font-weight: 700 ;color: var(--yellow-color)">Санаторий</h6>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="#">Новости</a>
                            </li>
                            <li>
                                <a href="#">Галерея</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                        <h6 class="heading mb-3" style="font-weight: 700 ;color: var(--yellow-color)">Помощь</h6>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="#">FAQ</a>
                            </li>
                            <li>
                                <a href="#">Поддержка</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <hr style="border-top: 3px solid var(--yellow-color);">

                <div class="row justify-content-center align-items-center">
                    <div class="text-white">
                        <p>©2021 HeartBlaze. Все права защищены</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
<script>
    $('#notificationToast').toast('show');

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });


    $(document).on('click', '.plus-contraindications', function(){
        $(this).closest('.information_json_plus').before(
            '<tr>' +
            '<td class="pl-0"><input type="text" class="form-control" name=contraindications_json_val[]" placeholder="Противопоказание" required></td>' +
            '<td class="pl-0"><span class="btn btn-sm btn-danger rounded-circle minus mt-1"><i class="fas fa-minus"></i></span></td>' +
            '</tr>'
        );
    });

    $(document).on('click', '.plus-destinations', function(){
        $(this).closest('.information_json_plus').before(
            '<tr>' +
            '<td class="pl-0"><input type="text" class="form-control" name=destinations_json_val[]" placeholder="Назначение" required></td>' +
            '<td class="pl-0"><span class="btn btn-sm btn-danger rounded-circle minus mt-1"><i class="fas fa-minus"></i></span></td>' +
            '</tr>'
        );
    });


    $(document).on('click', '.minus', function(){
        $(this).closest('tr').remove();
    });

    $('#table_doctors, #table_procedures, #table_examinations').DataTable({
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
