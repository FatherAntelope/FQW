<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/frameworks/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>
    <title>HeartBlaze</title>
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
                <li class="breadcrumb-item"><a href="#" style="color: var(--dark-cyan-color)">Услуги</a></li>
                <li class="breadcrumb-item active" aria-current="page">Управление услугами</li>
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
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="my_services_all" name="my_services" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="my_services_all">Все записи</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="my_services_doctors" name="my_services" class="custom-control-input">
                                    <label class="custom-control-label" for="my_services_doctors">Врачи</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="my_services_procedures" name="my_services" value="woman" class="custom-control-input">
                                    <label class="custom-control-label" for="my_services_procedures">Процедуры</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="my_services_examinations" name="my_services" class="custom-control-input">
                                    <label class="custom-control-label" for="my_services_examinations">Обследования</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="my_services_events" name="my_services" class="custom-control-input">
                                    <label class="custom-control-label" for="my_services_events">Мероприятия</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="row no-gutters">
                        <div class="col-md-2 d-flex align-items-center flex-column justify-content-center" style="background-color: var(--dark-cyan-color)">
                            <h1 class="card-text text-white mt-2">
                                <i class="fas fa-user-md"></i>
                            </h1>
                            <h5 class="card-text text-white mb-0">
                                Врач
                            </h5>
                            <button class="btn btn-sm btn-danger mt-3 mb-2">
                                <i class="fas fa-trash"></i> Отменить
                            </button>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold" style="color: var(--dark-cyan-color)">"Специальность"</h5>
                                <p class="card-text"> <i class="fas fa-user-md mr-1"></i> "Фамилия И.О" </p>
                                <p class="card-text"> <i class="fas fa-map-marker-alt mr-1"></i> "Расположение" </p>
                                <p class="card-text"> <i class="fas fa-calendar-day mr-2"></i>"Дата|Время" </p>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="row no-gutters">
                        <div class="col-md-2 d-flex align-items-center flex-column justify-content-center" style="background-color: var(--dark-cyan-color)">
                            <h1 class="card-text text-white mt-2">
                                <i class="fas fa-diagnoses"></i>
                            </h1>
                            <h5 class="card-text text-white mb-0">
                                Процедура
                            </h5>
                            <button href="#" class="btn btn-sm btn-danger mt-3 mb-2">
                                <i class="fas fa-trash"></i> Отменить
                            </button>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold" style="color: var(--dark-cyan-color)">"Название"</h5>
                                <p class="card-text"> <i class="fas fa-user-md mr-1"></i> "Фамилия И.О" </p>
                                <p class="card-text"> <i class="fas fa-map-marker-alt mr-1"></i> "Расположение" </p>
                                <p class="card-text"> <i class="fas fa-calendar-day mr-2"></i>"Дата|Время" </p>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="row no-gutters">
                        <div class="col-md-2 d-flex align-items-center flex-column justify-content-center" style="background-color: var(--dark-cyan-color)">
                            <h1 class="card-text text-white mt-2">
                                <i class="fas fa-microscope"></i>
                            </h1>
                            <h5 class="card-text text-white mb-0">
                                Обследование
                            </h5>
                            <button href="#" class="btn btn-sm btn-danger mt-3 mb-2">
                                <i class="fas fa-trash"></i> Отменить
                            </button>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold" style="color: var(--dark-cyan-color)">"Название"</h5>
                                <p class="card-text"> <i class="fas fa-user-md mr-1"></i> "Фамилия И.О" </p>
                                <p class="card-text"> <i class="fas fa-map-marker-alt mr-1"></i> "Расположение" </p>
                                <p class="card-text"> <i class="fas fa-calendar-day mr-2"></i>"Дата|Время" </p>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="row no-gutters">
                        <div class="col-md-2 d-flex align-items-center flex-column justify-content-center" style="background-color: var(--dark-cyan-color)">
                            <h1 class="card-text text-white mt-2">
                                <i class="fas fa-walking"></i>
                            </h1>
                            <h5 class="card-text text-white mb-0">
                                Мероприятие
                            </h5>
                            <button href="#" class="btn btn-sm btn-danger mt-3 mb-2">
                                <i class="fas fa-trash"></i> Отменить
                            </button>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold" style="color: var(--dark-cyan-color)">"Название"</h5>
                                <p class="card-text"> <i class="fas fa-map-marker-alt mr-1"></i> "Расположение" </p>
                                <p class="card-text"> <i class="fas fa-calendar-day mr-2"></i>"Дата|Время" </p>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
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
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="history_services_all" name="history_services" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="history_services_all">Все записи</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="history_services_doctors" name="history_services" class="custom-control-input">
                                    <label class="custom-control-label" for="history_services_doctors">Врачи</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="history_services_procedures" name="history_services" value="woman" class="custom-control-input">
                                    <label class="custom-control-label" for="history_services_procedures">Процедуры</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="history_services_examinations" name="history_services" class="custom-control-input">
                                    <label class="custom-control-label" for="history_services_examinations">Обследования</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="history_services_events" name="history_services" class="custom-control-input">
                                    <label class="custom-control-label" for="history_services_events">Мероприятия</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="row no-gutters">
                        <div class="col-md-2 d-flex align-items-center flex-column justify-content-center" style="background-color: var(--dark-cyan-color)">
                            <h1 class="card-text text-white mt-2">
                                <i class="fas fa-user-md"></i>
                            </h1>
                            <h5 class="card-text text-white mb-0">
                                Врач
                            </h5>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold" style="color: var(--dark-cyan-color)">"Специальность"</h5>
                                <p class="card-text"> <i class="fas fa-user-md mr-1"></i> "Фамилия И.О" </p>
                                <p class="card-text"> <i class="fas fa-map-marker-alt mr-1"></i> "Расположение" </p>
                                <p class="card-text"> <i class="fas fa-calendar-day mr-2"></i>"Дата|Время" </p>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="row no-gutters">
                        <div class="col-md-2 d-flex align-items-center flex-column justify-content-center" style="background-color: var(--dark-cyan-color)">
                            <h1 class="card-text text-white mt-2">
                                <i class="fas fa-diagnoses"></i>
                            </h1>
                            <h5 class="card-text text-white mb-0">
                                Процедура
                            </h5>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold" style="color: var(--dark-cyan-color)">"Название"</h5>
                                <p class="card-text"> <i class="fas fa-user-md mr-1"></i> "Фамилия И.О" </p>
                                <p class="card-text"> <i class="fas fa-map-marker-alt mr-1"></i> "Расположение" </p>
                                <p class="card-text"> <i class="fas fa-calendar-day mr-2"></i>"Дата|Время" </p>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="row no-gutters">
                        <div class="col-md-2 d-flex align-items-center flex-column justify-content-center" style="background-color: var(--dark-cyan-color)">
                            <h1 class="card-text text-white mt-2">
                                <i class="fas fa-microscope"></i>
                            </h1>
                            <h5 class="card-text text-white mb-0">
                                Обследование
                            </h5>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold" style="color: var(--dark-cyan-color)">"Название"</h5>
                                <p class="card-text"> <i class="fas fa-user-md mr-1"></i> "Фамилия И.О" </p>
                                <p class="card-text"> <i class="fas fa-map-marker-alt mr-1"></i> "Расположение" </p>
                                <p class="card-text"> <i class="fas fa-calendar-day mr-2"></i>"Дата|Время" </p>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="row no-gutters">
                        <div class="col-md-2 d-flex align-items-center flex-column justify-content-center" style="background-color: var(--dark-cyan-color)">
                            <h1 class="card-text text-white mt-2">
                                <i class="fas fa-walking"></i>
                            </h1>
                            <h5 class="card-text text-white mb-0">
                                Мероприятие
                            </h5>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold" style="color: var(--dark-cyan-color)">"Название"</h5>
                                <p class="card-text"> <i class="fas fa-map-marker-alt mr-1"></i> "Расположение" </p>
                                <p class="card-text"> <i class="fas fa-calendar-day mr-2"></i>"Дата|Время" </p>
                                <a href="#" class="stretched-link"></a>
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
                            Система для повышения эффективности процесса рекреации в санатории, а также повышения мобильности и оперативности информационной поддержки
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
                                <a href="#">Профиль</a>
                            </li>
                            <li>
                                <a href="#">Чат</a>
                            </li>
                            <li>
                                <a href="#">Медицинская карта</a>
                            </li>
                            <li>
                                <a href="#">Дневник самонаблюдения</a>
                            </li>
                            <li>
                                <a href="#">Услуги</a>
                            </li>
                            <li>
                                <a href="#">Органайзер</a>
                            </li>
                            <li>
                                <a href="#">Настройки</a>
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
</script>
</html>