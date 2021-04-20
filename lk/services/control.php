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
<style>
</style>
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
                            <i class="fas fa-id-card mr-1"></i>
                            Профиль
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
                            <i class="fas fa-book-medical mr-1"></i>
                            Медицинская карта
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-heartbeat mr-1"></i>
                            Дневник самонаблюдения
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
                            <i class="fas fa-calendar-alt mr-1"></i>
                            Органайзер
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
                <li class="breadcrumb-item active" aria-current="page">Услуги</li>
            </ol>
        </nav>
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

        <div class="tab-content">
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
                                    <a href="/lk/services/appointment.php?appointment=doctors" class="text-white icon-link"><i class="fas fa-user-md"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Врачи</b></h5>
                                <p class="text-muted">Высококвалифицированные специалисты, предоставляющие услуги своей специальности</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?appointment=procedures" class="text-white icon-link"><i class="fas fa-diagnoses"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Процедуры</b></h5>
                                <p class="text-muted">Методы лечения, направленные на восстановление и укрепление вашего здоровья</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?appointment=examinations" class="text-white icon-link"><i class="fas fa-microscope"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Обследования</b></h5>
                                <p class="text-muted">Медицинские осмотры с целью выявления новых заболеваний и факторов риска их развития</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?appointment=events" class="text-white icon-link"><i class="fas fa-walking"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Мероприятия</b></h5>
                                <p class="text-muted">Культурно массовые события, например, походы, экскурсии, эстафеты и так далее</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-my-services" role="tabpanel">
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
                                    <a href="/lk/services/appointment.php?appointment=doctors" class="text-white icon-link"><i class="fas fa-user-md"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Врачи</b></h5>
                                <p class="text-muted">Высококвалифицированные специалисты, предоставляющие услуги своей специальности</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?appointment=procedures" class="text-white icon-link"><i class="fas fa-diagnoses"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Процедуры</b></h5>
                                <p class="text-muted">Методы лечения, направленные на восстановление и укрепление вашего здоровья</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?appointment=examinations" class="text-white icon-link"><i class="fas fa-microscope"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Обследования</b></h5>
                                <p class="text-muted">Медицинские осмотры с целью выявления новых заболеваний и факторов риска их развития</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?appointment=events" class="text-white icon-link"><i class="fas fa-walking"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Мероприятия</b></h5>
                                <p class="text-muted">Культурно массовые события, например, походы, экскурсии, эстафеты и так далее</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card mt-3">
                    <div class="card-body">
                        <table id="table_appointment" class="table table-striped table-hover">
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
                                        <span class="badge text-white" style="background-color: var(--dark-cyan-color)">
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
                                <td class="text-muted" data-label="Распо-ие:">10.12.21 13:10</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger btn-block">Отмена</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Тип усл.:">
                                    <h5>
                                        <span class="badge text-white" style="background-color: var(--dark-cyan-color)">
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
                                <td class="text-muted" data-label="Распо-ие:">11.12.21 12:10</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger btn-block">Отмена</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Тип усл.:">
                                    <h5>
                                        <span class="badge text-white" style="background-color: var(--dark-cyan-color)">
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
                                <td class="text-muted" data-label="Распо-ие:">11.12.21 12:10</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger btn-block">Отмена</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Тип усл.:">
                                    <h5>
                                        <span class="badge text-white" style="background-color: var(--dark-cyan-color)">
                                            <i class="fas fa-procedures mr-2"></i>Мероприятие
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
                                <td class="text-muted" data-label="Распо-ие:">11.12.21 12:10</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger btn-block">Отмена</button></li>
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
                                    <a href="/lk/services/appointment.php?appointment=doctors" class="text-white icon-link"><i class="fas fa-user-md"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Врачи</b></h5>
                                <p class="text-muted">Высококвалифицированные специалисты, предоставляющие услуги своей специальности</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?appointment=procedures" class="text-white icon-link"><i class="fas fa-diagnoses"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Процедуры</b></h5>
                                <p class="text-muted">Методы лечения, направленные на восстановление и укрепление вашего здоровья</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?appointment=examinations" class="text-white icon-link"><i class="fas fa-microscope"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Обследования</b></h5>
                                <p class="text-muted">Медицинские осмотры с целью выявления новых заболеваний и факторов риска их развития</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center mt-3 pl-1 pr-1">
                                <div class="maintenance-icon mb-2">
                                    <a href="/lk/services/appointment.php?appointment=events" class="text-white icon-link"><i class="fas fa-walking"></i></a>
                                </div>
                                <h5 class="text-uppercase" style="color: var(--dark-cyan-color)"><b>Мероприятия</b></h5>
                                <p class="text-muted">Культурно массовые события, например, походы, экскурсии, эстафеты и так далее</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <table id="table_appointment_history" class="table table-striped table-hover">
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
                                        <span class="badge text-white" style="background-color: var(--dark-cyan-color)">
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
                                <td class="text-muted" data-label="Распо-ие:">10.12.21 13:10</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Тип усл.:">
                                    <h5>
                                        <span class="badge text-white" style="background-color: var(--dark-cyan-color)">
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
                                <td class="text-muted" data-label="Распо-ие:">11.12.21 12:10</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Тип усл.:">
                                    <h5>
                                        <span class="badge text-white" style="background-color: var(--dark-cyan-color)">
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
                                <td class="text-muted" data-label="Распо-ие:">11.12.21 12:10</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Тип усл.:">
                                    <h5>
                                        <span class="badge text-white" style="background-color: var(--dark-cyan-color)">
                                            <i class="fas fa-procedures mr-2"></i>Мероприятие
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
                                <td class="text-muted" data-label="Распо-ие:">11.12.21 12:10</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn btn-sm text-white btn-block" style="background-color: var(--yellow-color)">Просмотр</button></li>
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

    });
$('#notificationToast').toast('show');
</script>
</html>