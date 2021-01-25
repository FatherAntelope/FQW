<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/frameworks/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<style>

    :root{
        --dark-cyan-color: #007060;
        --cyan-color: #00AC94;
        --yellow-color: #ffa400;
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
        .nav-user .account-user-name{
            font-size: 0
        }

        .nav-user .account-role {
            font-size: 0
        }

        .nav-user .account-user-avatar {
            position: relative;
            bottom: 0;
        }

        .nav-user {
            background-color: transparent !important;
        }

    }

    .nav-user {
        padding: calc(20px / 2) 20px calc(20px / 2) 57px!important;
        text-align: left!important;
        position: relative;
        background-color: var(--dark-cyan-color);
        min-height: 40px;
    }

    .nav-user .account-user-avatar {
        position: absolute;
        left: 15px;
    }

    .nav-user .account-user-name {
        display: block;
        color: var(--yellow-color);
        font-weight: 600;
    }

    .nav-user .account-role {
        display: block;
        font-weight: 100;
        margin-top: -3px;
        color: #fff;
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
        background-color: var(--yellow-color);
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

        <ul class="navbar-nav">
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none nav-user" href="#" id="dropdown-menu-user" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="/images/vladlen.jpg" alt="user-image" class="rounded-circle" width="40" height="40">
                    </span>
                    <span>
                        <span class="account-user-name">"Имя Фамилия"</span>
                        <span class="account-role">"Роль"</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn" style="position: absolute" aria-labelledby="dropdown-menu-user">
                    <a class="dropdown-item" href="#"><i class="bi bi-person-lines-fill mr-2" style="color: var(--dark-cyan-color)"></i><span>Личный кабинет</span></a>
                    <a class="dropdown-item" href="#"><i class="bi bi-gear-fill mr-2" style="color: var(--dark-cyan-color)"></i>Настройки</a>
                    <a class="dropdown-item" href="#"><i class="bi bi-door-open-fill mr-2" style="color: var(--dark-cyan-color)"></i>Выйти</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

</body>
</html>