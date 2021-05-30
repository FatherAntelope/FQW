<?php
// Если токен авторизованного пользователя не существует, то направляет на страницу ошибки 401 (нет авторизации)
if(!isset($_COOKIE['user_token']))
    header("Location: /error/401.php");
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";
// Выгрузка данных пользователя
$user = new User($_COOKIE['user_token']);
// Если HTTP-код после обращения к выгрузке данных пользователя по API 400 или 403, то ...
if($user->getStatusCode() === 400 || $user->getStatusCode() === 403) {
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.php");
}
// Если роль пользователя не "Patient", то направляет на страницу ошибки 403 (нет доступа)
if(!$user->isUserRole("Patient"))
    header("Location: /error/403.php");

// Получение данных пользователя
$user_data = $user->getData();
$whose_user = 2;
?>
<!--
Страница просмотра меню питания и диеты от лица пациента
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
    <link rel="stylesheet" href="/css/lightslider.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/lightslider.js"></script>
    <script defer src="/js/all.js"></script>
    <title><? echo web_name_header; ?></title>
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
                <li class="breadcrumb-item active" aria-current="page">Питание</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-7">
                <p class="text-muted">
                    Питание по пять раз в день по основному меню или по принципу шведского стола
                    В столовых действует единое утвержденное меню. Вносятся дополнения по желанию отдыхающих и по рекомендациям врача-диетолога.
                    <br>
                    Профессиональными поварами под тщательным контролем технологов и диетологов и только из экологически чистых продуктов готовится широкий ассортимент блюд. На столе всегда есть свежие зелень и овощи из собственной теплицы и знаменитый башкирский мед из своей пасеки.
                    <br>
                    Кроме того, предлагается большой ассортимент холодных закусок, фруктов, кулинарных и кондитерских изделий, горячих и холодных напитков. Учитывая профиль санатория, предусмотрено индивидуальное питание при различных заболеваниях желудочно-кишечного тракта, аллергических состояниях, нарушениях обмена веществ.
                </p>
            </div>
            <div class="col-lg-5">
                <img src="/images/sanatorium-dining.jpg" class="img-fluid  rounded" alt="..." style="object-fit: cover">
            </div>
        </div>
        <h4 class="text-muted mt-4"> Основное меню питания на 17.05.2021</h4>
<!--Список основного меню на слайдере-->
        <ul id="sliderItems" class="cs-hidden mt-3">
            <li class="item-a">
                <div class="card">
                    <div class="card-header text-center font-weight-bold" style="color: var(--dark-cyan-color)">
                        Завтрак
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-muted">Запеканка творожная</li>
                        <li class="list-group-item text-muted">Каша рисовая</li>
                        <li class="list-group-item text-muted">Хлеб с маслом</li>
                        <li class="list-group-item text-muted">Йогурт</li>
                        <li class="list-group-item text-muted">Черный чай</li>
                    </ul>
                    <div class="card-footer">
                        <p class="card-text"><small class="text-muted">Время работы: 8:00 - 9:00</small></p>
                    </div>
                </div>
            </li>
            <li class="item-a">
                <div class="card">
                    <div class="card-header text-center font-weight-bold" style="color: var(--dark-cyan-color)">
                        Обед
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-muted">Рассольник Полтавский</li>
                        <li class="list-group-item text-muted">Котлета по Киевски</li>
                        <li class="list-group-item text-muted">Салат "Летний"</li>
                        <li class="list-group-item text-muted">Булочка ржаная</li>
                        <li class="list-group-item text-muted">Компот</li>
                    </ul>
                    <div class="card-footer">
                        <p class="card-text"><small class="text-muted">Время работы: 13:30 - 14:30</small></p>
                    </div>
                </div>
            </li>
            <li class="item-a">
                <div class="card">
                    <div class="card-header text-center font-weight-bold" style="color: var(--dark-cyan-color)">
                        Полдник
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-muted">Сметанник</li>
                        <li class="list-group-item text-muted">Сок яблочный</li>
                    </ul>
                    <div class="card-footer">
                        <p class="card-text"><small class="text-muted">Время работы: 13:30 - 14:30</small></p>
                    </div>
                </div>
            </li>
            <li class="item-a">
                <div class="card">
                    <div class="card-header text-center font-weight-bold" style="color: var(--dark-cyan-color)">
                        Ужин
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-muted">Бифштекс</li>
                        <li class="list-group-item text-muted">Картофельное пюре</li>
                        <li class="list-group-item text-muted">Хлеб белый</li>
                        <li class="list-group-item text-muted">Чай</li>
                    </ul>
                    <div class="card-footer">
                        <p class="card-text"><small class="text-muted">Время работы: 13:30 - 14:30</small></p>
                    </div>
                </div>
            </li>
        </ul>
        <h4 class="text-muted mt-4"> Индивидуальное меню питания </h4>
<!--Таблица с диетой-->
        <table class="table table-hover table-striped table-bordered text-center">
            <thead class="thead-light">
            <tr>
                <th colspan="2" style="color: var(--dark-cyan-color)">Диета №1</th>
            </tr>
            <tr>
                <th class="text-danger">Нельзя</th>
                <th class="text-success">Можно</th>
            </tr>
            </thead>
            <tbody class="text-muted">
            <tr>
                <td data-label="Нельзя:">Ржаное, мучное</td>
                <td data-label="Можно:">Хлеб из цельнозерновых злаков</td data-label="Можно:">
            </tr>
            <tr>
                <td data-label="Нельзя:">Пшеничные макаронные изделия</td>
                <td data-label="Можно:">Вермишель</td>
            </tr>
            <tr>
                <td data-label="Нельзя:">Любое жирное мясо</td>
                <td data-label="Можно:">Нежирное мясо: молодая баранина, говядина, телятина</a></td>
            </tr>
            <tr>
                <td data-label="Нельзя:">Жирная рыба, соленая и консервированная</td>
                <td data-label="Можно:">Нежирное филе рыбы без кожи</td>
            </tr>
            <tr>
                <td data-label="Нельзя:">Копчености, колбасные изделия с жировой прослойкой</td>
                <td data-label="Можно:">Колбаса молочная, докторская, вареная, натуральные сардельки</td>
            </tr>
            <tr>
                <td data-label="Нельзя:">Молочные продукты с высокой жирностью, кислые</td>
                <td data-label="Можно:">Обезжиренные кисломолочные продукты</td>
            </tr>
            <tr>
                <td data-label="Нельзя:">Острые и соленые сыры, домашнюю брынзу</td>
                <td data-label="Можно:">Твердый сыр с нейтральным вкусом</td>
            </tr>
            <tr>
                <td data-label="Нельзя:">Жареные яйца</td>
                <td data-label="Можно:">Отварные яйца, омлеты</td>
            </tr>
            <tr>
                <td data-label="Нельзя:">Яичневая крупа, перловка, кукуруза</td>
                <td data-label="Можно:">Рис, манная крупа, гречка</td>
            </tr>
            <tr>
                <td data-label="Нельзя:">Капуста, редька и другие овощи, провоцирующие брожение</td>
                <td data-label="Можно:">Картофель, морковь, тыква, пасленовые в небольшом количестве</td>
            </tr>
            <tr>
                <td data-label="Нельзя:">Щавель, шпинат</a></td>
                <td data-label="Можно:">Петрушка, укроп</td>
            </tr>
            <tr>
                <td data-label="Нельзя:">Свежая малина, бананы, сухофрукты</td>
                <td data-label="Можно:">Вареные и печеные фрукты и ягоды, персики, виноград</td>
            </tr>
            <tr>
                <td data-label="Нельзя:">Мороженое, шоколад</td>
                <td data-label="Можно:">Мед, пастила, некислое варенье</td>
            </tr>
            <tr>
                <td data-label="Нельзя:">Соль, острые специи, вкусовые добавки</td>
                <td data-label="Можно:">Сахар, корица, ванилин</td>
            </tr><tr>
                <td data-label="Нельзя:">Любые газированные напитки, кофе</td>
                <td data-label="Можно:">Некрепкий чай, кофе с молоком, отвар шиповника, компоты, кисели домашние</td>
            </tr>
            </tbody>
        </table>
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
    //Настройка конфигурации слайдера
    $('#sliderItems').lightSlider({
        loop: false,
        onSliderLoad: function() {
            $('#sliderItems').removeClass('cS-hidden');
        }
    });
</script>
</html>