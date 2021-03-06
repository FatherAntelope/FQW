<!--
Шапка web-приложения
-->
<link rel="preconnect" href="//fonts.gstatic.com">
<link href="//fonts.googleapis.com/css2?family=PT+Serif:wght@400;700&family=Source+Serif+Pro:wght@600&display=swap" rel="stylesheet">
<?php if($whose_user === 0) { ?>
<!--Меню для неавторизованного пользователя-->
<nav class="navbar shadow-lg fixed-top navbar-expand-sm navbar-light" style="background: var(--cyan-color); padding: 0;">
        <div class="container">
<!--Иконка бренда (мини) в мобильном формате-->
            <a class="navbar-brand ml-3" id="logo-small" href="#">
                <img src="/images/logo-mini.png" alt="" height="40">
            </a>
<!--Иконка бренда (мини) в широком формате-->
            <a class="navbar-brand" id="logo-big" href="/">
                <div class="d-flex">
                    <img src="/images/logo-mini.png" alt="" height="40">
                    <div class="ml-2 d-flex justify-content-center flex-column">
                        <h5 class="text-uppercase mb-0 pb-0" style="font-family: 'PT Serif', serif; font-family: 'Source Serif Pro', serif; color: var(--yellow-color)"><? echo web_name_header; ?></h5>
                        <span class="text-white" style="font-size: 12px; font-family: 'PT Serif', serif; font-family: 'Source Serif Pro', serif;"><? echo web_name_span; ?></span>
                    </div>
                </div>
            </a>
<!--Содержимое меню-->
            <ul class="nav">
<!--Иконка-гиперссылка новостей-->
                <li>
                    <a class="nav-link arrow-none notify-icon" href="/news.php">
                        <i class="bi bi-newspaper"></i>
                    </a>
                </li>
<!--Иконка-гиперссылка на страницу авторизации-->
                <li>
                    <a href="/auth.php" class="btn btn-warning text-secondary mr-md-0" style="background: var(--yellow-color); margin: 0.6rem 1rem">Авторизация</a>
                </li>
            </ul>
        </div>
    </nav>
<?php } ?>

<!--Если пользователь вошел и получил роль администратора, пациента или медперсонала-->
<?php if($whose_user === 1 || $whose_user === 2 || $whose_user === 3) { ?>
<!--Меню для авторизованного пользователя-->
<nav class="navbar fixed-top navbar-expand-sm navbar-light p-0" style="background: var(--cyan-color);">
    <div class="container">
<!--Бургер-кнопка для развертывания панели навигации в мобильном формате-->
        <button class="navbar-toggler ml-3" data-toggle="collapse" data-target="#offcanvas" style="background: var(--yellow-color)">
            <i class="fas fa-bars" style="color: #fff"></i>
        </button>

<!--Иконка бренда (мини) в мобильном формате-->
        <a class="navbar-brand" id="logo-small" href="/">
            <img src="/images/logo-mini.png" alt="" height="40">
        </a>

<!--Иконка бренда (мини) в широком формате-->
        <a class="navbar-brand" id="logo-big" href="/">
            <div class="d-flex">
                <img src="/images/logo-mini.png" alt="" height="40">
                <div class="ml-2 d-flex justify-content-center flex-column">
                    <h5 class="text-uppercase mb-0 pb-0" style="font-family: 'PT Serif', serif; font-family: 'Source Serif Pro', serif; color: var(--yellow-color)"><?php echo web_name_header; ?></h5>
                    <span class="text-white" style="font-size: 12px; font-family: 'PT Serif', serif; font-family: 'Source Serif Pro', serif;"><?php echo web_name_span; ?></span>
                </div>
            </div>
        </a>

<!--Содержимое меню-->
        <ul class="nav">
<!--Иконка-гиперссылка новостей-->
            <li>
                <a class="nav-link arrow-none notify-icon" href="/news.php">
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
<!--Гиперссылка на очистку показываемых уведомлений-->
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
<!--Уведомление-->
                            <div class="notification">
                                <div class="notification-icon">
                                    <i class="bi bi-credit-card-2-back-fill" style="color: #fff; background-color: var(--dark-cyan-color)"></i>
                                </div>
<!--Содержимое уведомления-->
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
<!--Раздел пользовательской панели под меню для авторизованного пользователя-->
            <li class="dropdown">
<!--Кнопка вызова выпадающего списка с навигацией по главным модулям пользователя-->
                <a class="nav-link arrow-none nav-user" href="#" id="dropdown-menu-user" data-toggle="dropdown">
<!--Фотография пользователя-->
                    <span class="account-user-avatar">
                        <img src="<?php echo getUrlUserPhoto($user_data['photo']); ?>" alt="user-image" class="rounded-circle" style="object-fit: cover;">
                    </span>
<!--ФИ и роль пользователя-->
                    <span>
                        <span class="account-user-name">
                            <?php echo $user_data['surname']." ".$user_data['name'];?>
                        </span>
                        <span class="account-role">
                            <?php
                            if($whose_user === 1)
                                echo 'Администратор';
                            elseif ($whose_user === 2)
                                echo 'Пациент';
                            elseif ($whose_user === 3)
                                echo 'Медперсонал';
                            ?>
                        </span>
                    </span>
                </a>
<!--Вызванный выпадающий список с навигацией по главным модулям пользователя-->
                <div class="dropdown-menu dropdown-menu-right animate slideIn" style="margin: 0" aria-labelledby="dropdown-menu-user">
                    <a class="dropdown-item" href="/lk/" style="color: var(--dark-cyan-color)">
                        <i class="fas fa-id-card mr-2"></i>
                        Профиль
                    </a>
                    <a class="dropdown-item" href="/lk/settings/" style="color: var(--dark-cyan-color)">
                        <i class="fas fa-user-cog mr-2"></i>
                        Настройки
                    </a>
                    <a class="dropdown-item" href="/queries/exitUser.php" style="color: var(--dark-cyan-color)">
                        <i class="fas fa-door-open mr-2"></i>
                        Выйти
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<?php } ?>

<?php if($whose_user === 1) { ?>
<!--Панель навигации по модулям администратора-->
<div class="topnav shadow-lg fixed-top" style="top: 3.5rem">
    <div class="container">
        <nav class="navbar navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse justify-content-center" id="offcanvas">
<!--Список модулей-->
                <ul class="navbar-nav">
<!--Гиперссылка с переходом к модулю пользователя (администратора)-->
                    <li class="nav-item">
                        <a href="/lk/" class="nav-link link-navbar" aria-haspopup="true">
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
                            <i class="fas fa-newspaper mr-1"></i>
                            Новости
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/lk/nutrition/editor.php" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-utensils mr-1"></i>
                            Питание
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/lk/services/editor.php?selected=specializations" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-procedures mr-1"></i>
                            Услуги
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/lk/users/" class="nav-link link-navbar" aria-haspopup="true">
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

<?php } elseif ($whose_user === 2) { ?>
<!--Панель навигации по модулям пациента-->
<div class="topnav shadow-lg fixed-top" style="top: 3.5rem">
    <div class="container">
        <nav class="navbar navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse justify-content-center" id="offcanvas">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/lk/" class="nav-link link-navbar" aria-haspopup="true">
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
                        <a href="/lk/medcard/" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-book-medical mr-1"></i>
                            Медицинская карта
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/lk/diary/" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-heartbeat mr-1"></i>
                            Дневник самонаблюдения
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/lk/services/" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-procedures mr-1"></i>
                            Услуги
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/lk/organizer/" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            Органайзер
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/lk/nutrition/" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-utensils mr-1"></i>
                            Питание
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<?php } elseif ($whose_user === 3) { ?>
<!--Панель навигации по модулям медперсонала-->
<div class="topnav shadow-lg fixed-top" style="top: 3.5rem">
    <div class="container">
        <nav class="navbar navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse justify-content-center" id="offcanvas">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/lk/" class="nav-link link-navbar" aria-haspopup="true">
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
                        <a href="/lk/patients/" class="nav-link link-navbar" aria-haspopup="true">
                            <i class="fas fa-user-injured mr-1"></i>
                            Пациенты
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
<?php } ?>