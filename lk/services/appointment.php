<?
$getAppointment = $_GET['appointment'];
if($getAppointment != "doctors" &&
    $getAppointment != "procedures" &&
    $getAppointment != "examinations" &&
    $getAppointment != "events") {
    header("Location: /lk/services/control.php");
    exit;
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" charset="utf8" src="/js/datatables.js"></script>
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
                <li class="breadcrumb-item"><a href="#" style="color: var(--dark-cyan-color)">Профиль</a></li>
                <li class="breadcrumb-item"><a href="/lk/services/control.php" style="color: var(--dark-cyan-color)">Услуги</a></li>
                <li class="breadcrumb-item active" aria-current="page">Запись на услуги</li>
            </ol>
        </nav>
        <ul class="nav nav-pills flex-column flex-sm-row mb-2" role="tablist">
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <? if($_GET['appointment'] == 'doctors') echo "active";?>" data-toggle="tab" href="#tab-doctors" role="tab">
                    <i class="fas fa-user-md mr-2"></i>Врачи
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <? if($_GET['appointment'] == 'procedures') echo "active";?>" data-toggle="tab" href="#tab-procedures" role="tab">
                    <i class="fas fa-diagnoses mr-2"></i>Процедуры
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <? if($_GET['appointment'] == 'examinations') echo "active";?>" data-toggle="tab" href="#tab-examinations" role="tab">
                    <i class="fas fa-microscope mr-1"></i>Обследования
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <? if($_GET['appointment'] == 'events') echo "active";?>" data-toggle="tab" href="#tab-events" role="tab">
                    <i class="fas fa-walking mr-1"></i>Мероприятия
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show <? if($_GET['appointment'] == 'doctors') echo "active";?>" id="tab-doctors" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_doctors" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Врач</th>
                                <th>Специальность</th>
                                <th>Расположение</th>
                                <th>Разрешение</th>
                                <th>Цена, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Врач:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td class="text-muted" data-label="Спец.-ть:">Терапевт</td>
                                <td class="text-muted" data-label="Расп.-ие:">505 каб.</td>
                                <td class="text-muted" data-label="Раз.-ие:"><span class="badge badge-success">Дополнительно</span></td>
                                <td class="text-muted" data-label="Цена, р.:">500</td>
                                <td><button type="button" class="btn btn-sm btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)">Запись</button></td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Врач:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Николаев И. И.</td>
                                <td class="text-muted" data-label="Спец.-ть:">Офтальмолог</td>
                                <td class="text-muted" data-label="Расп.-ие:">302 каб.</td>
                                <td class="text-muted" data-label="Раз.-ие:"><span class="badge badge-danger">Обязательно</span></td>
                                <td class="text-muted" data-label="Цена, р.:">300</td>
                                <td><button type="button" class="btn btn-sm btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)">Запись</button></td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Врач</th>
                                <th>Специальность</th>
                                <th>Расположение</th>
                                <th>Разрешение</th>
                                <th>Цена, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show <? if($_GET['appointment'] == 'procedures') echo "active";?>" id="tab-procedures" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_procedures" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Специалист</th>
                                <th>Процедура</th>
                                <th>Расположение</th>
                                <th>Разрешение</th>
                                <th>Цена, руб.</th>
                                <th>Повторов</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Сп.-ист:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td class="text-muted" data-label="Спец.-ть:">Бассейн</td>
                                <td class="text-muted" data-label="Расп.-ие:">105 каб.</td>
                                <td class="text-muted" data-label="Раз.-ие:"><span class="badge badge-success">Дополнительно</span></td>
                                <td class="text-muted" data-label="Цена, р.:">550</td>
                                <td class="text-muted" data-label="Повторов:">–</td>
                                <td><a href="#" type="button" class="btn btn-sm btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)">Запись</a></td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Сп.-ист:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Николаев И. И.</td>
                                <td class="text-muted" data-label="Спец.-ть:">Мануальная терапия</td>
                                <td class="text-muted" data-label="Расп.-ие:">108 каб.</td>
                                <td class="text-muted" data-label="Раз.-ие:"><span class="badge badge-danger">Обязательно</span></td>
                                <td class="text-muted" data-label="Цена, р.:">750</td>
                                <td class="text-muted" data-label="Повторов:">10</td>
                                <td><a href="#" type="button" class="btn btn-sm btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)">Запись</a></td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Врач</th>
                                <th>Процедура</th>
                                <th>Расположение</th>
                                <th>Разрешение</th>
                                <th>Цена, руб.</th>
                                <th>Повторов</th>
                                <th>Специалист</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show <? if($_GET['appointment'] == 'examinations') echo "active";?>" id="tab-examinations" role="tabpanel">
                3
            </div>

            <div class="tab-pane fade show <? if($_GET['appointment'] == 'events') echo "active";?>" id="tab-events" role="tabpanel">
                4
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
$('#table_doctors, #table_procedures').DataTable({
    "language": {
        "zeroRecords": "<span class='text-muted'>Совпадения отсутствуют</span>",
        "search": "<span class='text-muted' style='margin-right: 0.5rem; font-size: 1.3rem'>Поиск:</span>",
        "info": "<span class='text-muted'>Показан диапазон от _START_ до _END_ элементов</span>",
        "infoEmpty": "<span class='text-muted'>Совпадения отсутствуют</span>",
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