<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/frameworks/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<style>

    :root{
        --dark-cyan-color: #007060;
        --cyan-color: #00AC94;
        --yellow-color: #ffa400;
        --red--color: #f80018;
    }

    @media (max-width: 992px) {
        #logo-big {
            display: none;
        }
    }
    @media (min-width: 992px) {
        #logo-small{
            display: none;
        }
    }
    @media (max-width: 767px) {
        .nav-user {
            padding: 1.85rem 1.55rem 1.85rem 1.55rem !important;
        }

        .nav-user:hover {
            background-color: var(--dark-cyan-color) !important;
        }

        .nav-user .account-user-name{
            font-size: 0
        }

        .nav-user .account-role {
            font-size: 0
        }

        .nav-user .account-user-avatar {
            position: absolute;
            left: 0.35rem !important;
            bottom: 0.5rem;
        }

        .nav-user {
            background-color: transparent !important;
        }
    }

    @media (max-width: 574px) {
        .dropdown-menu {
            top: 3.5rem;
            width: 100vw;
            min-width: 0 !important;
        }
        .dropdown-offset-right-110 {
            right: -110%;
        }
    }

    .nav-user {
        padding: 0.75rem 0.7rem 0.40rem 3.6rem;
        background-color: var(--cyan-color);
    }

    .nav-user:hover {
        background-color: var(--dark-cyan-color);
    }

    .nav-user .account-user-avatar {
        position: absolute;
        left: 0.6rem;
    }

    .nav-user .account-user-name {
        display: block;
        color: var(--yellow-color);
        font-weight: 600;
        margin-top: -0.15rem;
    }

    .nav-user .account-role {
        display: block;
        font-weight: 100;
        color: #fff;
        margin-top: -0.3rem;
    }

    .arrow-none:after {
        display: none;
    }

    .animate {
        animation-duration: 0.3s;
        -webkit-animation-duration: 0.3s;
        animation-fill-mode: both;
        -webkit-animation-fill-mode: both;
    }

    .slideIn {
        -webkit-animation-name: slideIn;
        animation-name: slideIn;
    }

    .notification-list {
        margin-left: 0;
    }

    @keyframes slideIn {
        0% {
            transform: translateY(1rem);
            opacity: 0;
        }
        100% {
            transform:translateY(0rem);
            opacity: 1;
        }
        0% {
            transform: translateY(1rem);
            opacity: 0;
        }
    }

    @-webkit-keyframes slideIn {
        0% {
            -webkit-opacity: 0;
        }
        100% {
            -webkit-transform: translateY(0);
            -webkit-opacity: 1;
        }
        0% {
            -webkit-transform: translateY(1rem);
            -webkit-opacity: 0;
        }
    }
    .dropdown-item:active {
        background-color: var(--cyan-color);
    }

    .dropdown-item i {
        color: var(--dark-cyan-color)
    }

    .notify-icon {
        padding: 7px 10px 13px 10px
    }

    .notify-icon i {
        font-size: 1.65rem;
        color: var(--yellow-color)
    }

    .notify-icon:hover {
        background-color: var(--dark-cyan-color)
    }

    .notify-icon .notify-icon-dot {
        margin-left: -0.6rem;
        margin-top: 0.3rem;
        position: absolute;
        font-size: 0.6rem
    }

    .notify-icon .notify-icon-dot i {
        font-size: 0.6rem;
    }

    .notifications-scrollbar{
        overflow-y: auto;
        max-height: 20rem;
    }

    .notifications-scrollbar::-webkit-scrollbar {
        width: 10px;
        background-color: #f9f9fd;
    }

    .notifications-scrollbar::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.2);
        background-color: #f9f9fd;
    }

    .notifications-scrollbar::-webkit-scrollbar-thumb {
        background-color: var(--dark-cyan-color)
    }

    .notifications {
        font-size: 1rem;
        margin: 0.1em 1rem;
    }

    .notifications .notification {
        position: relative;
        background: 0 0;
        margin: .5em 0 0;
        padding: .5em 0 0;
        border: none;
        border-top: none;
        line-height: 1.2;
    }

    .notifications .notification .notification-icon {
        display: block;
        width: 2.5em;
        height: 2.5em;
        float: left;
        margin: .2em 0 0;
    }

    .notifications .notification .notification-icon i, .notification .notification i.notification-icon {
        display: block;
        margin: 0 auto;
        font-size: 1.7rem;
        padding-left: 0.4rem;
        left: 20px;
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .notifications .notification>.notification-icon~.content {
        margin-left: 3.5em;
    }

    .notifications .notification>.content {
        display: block;
    }

    .notifications .notification a.header {
        cursor: pointer;
        font-size: 1em;
        color: var(--dark-cyan-color);
        font-weight: 700;
        text-decoration: none;
    }

    .notifications .notification a.header:hover {
        color: var(--yellow-color);
    }

    .notifications .notification .text {
        margin: .25em 0 .5em;
        font-size: 1em;
        word-wrap: break-word;
        line-height: 1.3;
    }

    .notifications .notification .actions {
        font-size: .875em;
    }

    .notifications .notification .actions p {
        display: inline-block;
        margin: 0 .75em 0 0;
        color: rgba(0,0,0,.4);
    }

    .list-unstyled.link-none>li>a {
        text-decoration: none;
        color: #fff;
        font-weight: 100;
    }

    .list-unstyled.link-none>li>a:hover{
        color: #b8b8b8;
    }

</style>


<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background: var(--cyan-color); padding: 0">
    <div class="container">
        <button class="navbar-toggler" data-toggle="collapse" style="background: var(--yellow-color)" data-target="#navbar">
            <i class="bi bi-list" style="color: #fff"></i>
        </button>

        <a class="navbar-brand" id="logo-small" href="#">
            <img src="/images/logo-mini.png" alt="" width="46" height="40" >
        </a>

        <div class="collapse navbar-collapse" id="navbar">
            <a class="navbar-brand" id="logo-big" href="#">
                <img src="/images/logo.png" alt="" width="152" height="40" >
            </a>
            <form class="form-inline">
                <input class="form-control mr-sm-2" placeholder="Поиск...">
                <button class="btn btn-warning my-2 my-sm-0" style="background: var(--yellow-color)" type="submit">
                    <i class="bi bi-search" style="color: #fff"></i>
                </button>
            </form>
        </div>

        <ul class="nav">
            <li class="dropdown notification-list">
                <a class="nav-link arrow-none notify-icon" href="#" id="dropdown-notify" data-toggle="dropdown" >
                    <i class="bi bi-bell-fill"></i>
                    <span class="notify-icon-dot">
                        <i class="bi bi-circle-fill" style="color: var(--red--color)"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn dropdown-offset-right-110"
                     style="min-width: 500px; padding-bottom: 0;" aria-labelledby="dropdown-notify">
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
                                        <a class="header">"Тип уведомления"</a>
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
                                        <a class="header">"Тип уведомления"</a>
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
                                        <a class="header">"Тип уведомления"</a>
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
                                        <a class="header">"Тип уведомления"</a>
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
            <li class="dropdown notification-list">
                <a class="nav-link arrow-none nav-user" href="#" id="dropdown-menu-user" data-toggle="dropdown">
                    <span class="account-user-avatar">
                        <img src="/images/vladlen.jpg" alt="user-image" class="rounded-circle" width="40" height="40">
                    </span>
                    <span>
                        <span class="account-user-name">"Имя Фамилия"</span>
                        <span class="account-role">"Роль"</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="dropdown-menu-user">
                    <a class="dropdown-item" href="#"><i class="bi bi-person-lines-fill mr-2"></i><span>Личный кабинет</span></a>
                    <a class="dropdown-item" href="#"><i class="bi bi-gear-fill mr-2"></i>Настройки</a>
                    <a class="dropdown-item" href="#"><i class="bi bi-door-open-fill mr-2"></i>Выйти</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div style="min-height: 100vh">

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
                            Отслеживать и управлять своими данными стало как никогда просто
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
</html>