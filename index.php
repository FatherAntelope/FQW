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
    <title>Document</title>
</head>

<style>
    @media (max-width: 992px) {
        .navbar-toggler {
            display: block !important;
        }
    }

    .span-search {
        position: absolute;
        left: 0.6rem;
        font-size: 20px;
        line-height: 34px;
        color: var(--yellow-color)
    }

    .topnav {
        z-index: 998 !important;
        background: #fff;
    }

    .topnav .topnav-menu {
        margin: 0;
        padding: 0;
    }

    .link-navbar {
        color: var(--dark-cyan-color);
    }

    .dropdown-item:hover {
        color: var(--yellow-color) !important;
        background-color: #fff !important;
    }

    .link-navbar:hover {
        color: var(--yellow-color);
    }
</style>

<body>
<!--Блок навигации-->
<nav class="navbar shadow-sm fixed-top navbar-expand-sm navbar-light" style="background: var(--cyan-color); padding: 0">
    <div class="container">
<!--Кнопка навигации в мобильном формате экрана-->
        <button class="navbar-toggler ml-1" data-toggle="collapse" data-target="#offcanvas" style="background: var(--yellow-color)">
            <i class="fas fa-bars" style="color: #fff"></i>
        </button>

<!--Кнопка/иконка бренда (мини) в мобильном формате экрана-->
        <a class="navbar-brand" id="logo-small" href="#">
            <img src="/images/logo-mini.png" alt="" height="40">
        </a>
<!--То, что находится в широкоформатном расширении и скрывается в мобильном формате (видимость)-->
        <a class="navbar-brand" id="logo-big" href="#">
            <img src="/images/logo.png" alt="" height="40">
        </a>

        <ul class="nav">
            <li style="margin: 0.6rem 1rem" id="list-search-big">
                    <form class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="bi bi-search span-search"></span>
                            <div class="input-group-append">
                                <button class="btn btn-warning text-white"
                                        type="submit" style="background: var(--yellow-color)">
                                    Поиск
                                </button>
                            </div>
                        </div>
                    </form>
            </li>
            <li class="dropdown" id="list-search-small">
                <a class="nav-link arrow-none notify-icon" href="#" id="dropdown-search" data-toggle="dropdown">
                    <i class="bi bi-search"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn"
                      aria-labelledby="dropdown-notify" style="min-width: 20rem">
                    <form class="form-inline pl-2">
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="bi bi-search span-search"></span>
                            <div class="input-group-append">
                                <button class="btn btn-warning text-white"
                                        type="submit" style="background: var(--yellow-color)">
                                    Поиск
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <li>
                <a class="nav-link arrow-none notify-icon" href="#">
                    <i class="bi bi-newspaper"></i>
                </a>
            </li>
            <li class="dropdown">
                <a class="nav-link arrow-none notify-icon" href="#" id="dropdown-notify" data-toggle="dropdown" >
                    <i class="bi bi-bell-fill"></i>
                    <span class="notify-icon-dot">
                        <i class="bi bi-circle-fill" style="color: var(--red--color)"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn"
                     style="min-width: 30rem; padding-bottom: 0;" aria-labelledby="dropdown-notify">
                    <div class="dropdown-header">
                        <h6 style="position: relative">
                            <span class="float-right">
                                <a href="#" class="text-danger" style="text-decoration: none">
                                    <small>Очистить</small>
                                </a>
                            </span>
                            Уведомления
                        </h6>
                    </div>
                    <hr style="margin: 0">
                    <div class="notifications-scrollbar" >
                        <div style="padding-bottom: 8px">
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
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a class="nav-link arrow-none nav-user" href="#" id="dropdown-menu-user" data-toggle="dropdown">
                    <span class="account-user-avatar">
                        <img src="/images/vladlen.jpg" alt="user-image" class="rounded-circle" height="40">
                    </span>
                    <span>
                        <span class="account-user-name">"Имя Фамилия"</span>
                        <span class="account-role">"Роль"</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="dropdown-menu-user">
                    <a class="dropdown-item" href="#" style="color: var(--dark-cyan-color)">
                        <i class="fas fa-user-circle mr-2" ></i>
                        Личный кабинет
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

<nav class="navbar shadow-sm fixed-top navbar-expand-sm navbar-light" style="background: var(--cyan-color); padding: 0; margin-top: 70px; visibility: hidden">
    <div class="container">
        <!--Кнопка/иконка бренда (мини) в мобильном формате экрана-->
        <a class="navbar-brand" id="logo-small" href="#">
            <img src="/images/logo-mini.png" alt="" height="40">
        </a>
        <!--То, что находится в широкоформатном расширении и скрывается в мобильном формате (видимость)-->
        <a class="navbar-brand" id="logo-big" href="#">
            <img src="/images/logo.png" alt="" height="40">
        </a>

        <ul class="nav">
            <li style="margin: 0.6rem 1rem" id="list-search-big">
                <form class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="bi bi-search" style="position: absolute; left: 0.6rem; font-size: 20px; line-height: 34px; color: var(--yellow-color)"></span>
                        <div class="input-group-append">
                            <button class="btn btn-warning text-white" type="submit" style="background: var(--yellow-color)">Поиск</button>
                        </div>
                    </div>
                </form>
            </li>
            <li class="dropdown" id="list-search-small">
                <a class="nav-link arrow-none notify-icon" href="#" id="dropdown-search" data-toggle="dropdown">
                    <i class="bi bi-search"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn"
                     aria-labelledby="dropdown-notify" style="min-width: 20rem">
                    <form class="form-inline" style="margin: 0.5rem 1rem 0.5rem 1rem">
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="bi bi-search" style="position: absolute; left: 0.6rem; font-size: 20px; line-height: 34px; color: var(--yellow-color)"></span>
                            <div class="input-group-append">
                                <button class="btn btn-warning text-white" type="submit" style="background: var(--yellow-color)">Поиск</button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <li>
                <a class="nav-link arrow-none notify-icon" href="#">
                    <i class="bi bi-newspaper"></i>
                </a>
            </li>
            <li>
                <a href="/login.php" class="btn btn-warning text-white" style="background: var(--yellow-color); margin: 0.6rem 1rem">Авторизация</a>
            </li>
        </ul>
    </div>
</nav>

<div class="topnav shadow-sm fixed-top" style="top: 3.7rem">
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
                        <a href="#" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            Мои задачи
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>


<div style="min-height: 100vh; margin-top: 100px">

</div>

<div class="position-fixed p-3" style="z-index: 5; right: 0; bottom: 0;">
    <div id="notificationToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
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


<footer style="background-color: var(--cyan-color)">
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row align-items-center">
                    <div class="col-lg-9">
                        <h3 class="mb-2" style="color: var(--yellow-color)">
                            Быстрый запуск
                        </h3>
                        <p class="lead mb-0 text-white opacity-8">
                            Отслеживать и управлять личными данными стало как никогда просто
                        </p>
                    </div>
                    <div class="col-lg-3 text-lg-right mt-4 mt-lg-0">
                        <a href="/login.php" class="btn btn-warning btn-icon my-2" style="background-color: var(--yellow-color)">
                            <span class="text-white">Приступить</span>
                        </a>
                    </div>
                </div>

                <hr style="border-top: 3px solid var(--yellow-color);">

                <div class="row">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <a href="/">
                            <img src="/images/logo.png" height="40">
                        </a>
                        <p class="mt-2 text-white opacity-8 pr-lg-4">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad architecto aspernatur consequuntur dicta dolor et excepturi fugiat harum impedit iusto laboriosam minus, modi non numquam repellendus sed tempore temporibus voluptate.
                        </p>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 ml-lg-auto mb-5 mb-lg-0">
                        <h6 class="heading mb-3" style="font-weight: 700 ;color: var(--yellow-color)">Аккаунт</h6>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="#">Личный кабинет</a>
                            </li>
                            <li>
                                <a href="#">Настройки</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                        <h6 class="heading mb-3" style="font-weight: 700 ;color: var(--yellow-color)">О нас</h6>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="#">Цены</a>
                            </li>
                            <li>
                                <a href="#">Контакты</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                        <h6 class="heading mb-3" style="font-weight: 700 ;color: var(--yellow-color)">Помощь</h6>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="#">Часто задаваемые вопросы</a>
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
    $("#toast").toast("show");
</script>
</html>