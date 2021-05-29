<?php
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
/**
 * Проверка на существование авторизации пользователя
 * Если токен при авторизации был выдан, то загружается содержимое интерфейса для определенного пользователя
 * Иначе выдается код 0 - пользователь не авторизован
 */
if(isset($_COOKIE['user_token'])) {
    require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";
    //Объект пользователя для экспорта необходимой информации из БД
    $user = new User($_COOKIE['user_token']);
    // Если HTTP-код после обращения к выгрузке данных пользователя по API 400 или 403, то ...
    if($user->getUserStatusCode() === 400 || $user->getUserStatusCode() === 403) {
        //Очищаются Cookie и происходит перенаправление на страницу авторизации
        setcookie('user_token', '', 0, "/");
        header("Location: /auth.php");
    }
    //получение основных данных пользователя и код его роли
    $user_data = $user->getUserData();
    $whose_user = getUserRoleCode($user_data['role']);
} else {
    $whose_user = 0;
}
?>
<!--
Главная промо-страница, описывающая возможности web-приложения
-->
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/images/logo-mini.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="js/all.js"></script>
    <title><?php echo web_name_header; ?></title>
</head>
<style>
    * {
        scroll-behavior: smooth;
    }
</style>
<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>

<!--Основной контент страницы-->
<div class="page-content" <?php if ($whose_user === 0) echo 'style="margin-top: 3.5rem !important;"';?>>
    <div style="
            background-image: url(/images/main-image.jpg);
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
            min-height: <?php if ($whose_user === 0) echo '93vh'; else echo "92vh";?>;
            filter: brightness(40%)"
         class="text-center">
    </div>
<!--Первая секция с изображением и заголовочным названием приложения-->
    <div style="position: absolute; top: 10rem; text-align: center">
        <h1 style=" font-size: 5.5rem; color: var(--yellow-color); " class="font-weight-bold">Сатурн</h1>
        <h3 style="z-index: 100; color: white">Персонифицированная комплексная медицинская информационная система сопровождения процесса реабилитации пациентов в лечебно-профилактических санаториях или профилакториях</h3>
        <a href="#info" class="btn btn-info btn-lg mt-3" style="background-color: var(--cyan-color)">Подробнее</a>
    </div>
<!--Вторая секция с описанием возможностей пациента-->
    <div style="min-height: 100vh" class="d-flex flex-column justify-content-center" id="info">
        <h1 class="text-center" style="color: var(--dark-cyan-color)" >Возможности пациентов</h1>
        <div class="container pt-3 pb-3 d-flex justify-content-center align-items-center">
<!--Строка объектов с описанием модуля-->
            <div class="row mt-2 ml-2 mr-2">
<!--Объект описания модуля-->
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/medcard-c.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--dark-cyan-color)"><b>Медкарта</b></h5>
                        <p class="text-muted">Просматривайте записи медицинских специалистов</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/organizer-c.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--dark-cyan-color)"><b>Органайзер</b></h5>
                        <p class="text-muted">Отслеживайте график предстоящих событий и контролируйте задачи</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/notify-c.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--dark-cyan-color)"><b>Уведомления</b></h5>
                        <p class="text-muted">Получайте уведомления и напоминания о событиях</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/diary-c.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--dark-cyan-color)"><b>Дневник самонаблюдения</b></h5>
                        <p class="text-muted">Контролируйте свое здоровье и занимайтесь спортом</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/services-c.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--dark-cyan-color)"><b>Услуги</b></h5>
                        <p class="text-muted">Записывайтесь на доступные услуги дистанционно, просматривайте историю посещений</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/support-c.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--dark-cyan-color)"><b>Поддержка</b></h5>
                        <p class="text-muted">Задавайте вопросы технической поддержке по возникшим проблемам</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/eat-c.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--dark-cyan-color)"><b>Питание</b></h5>
                        <p class="text-muted">Просматривайте меню санатория за текущий день и свои диеты</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/chat-c.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--dark-cyan-color)"><b>Сопровождение</b></h5>
                        <p class="text-muted">Общайтесь с медицинскими специалистами и получайте рекомендации дома</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Третья секция с описанием возможностей медперсонала-->
    <div style="min-height: 100vh; background-color: #e5e5e5" class="d-flex flex-column justify-content-center">
        <h1 class="text-center" style="color: var(--yellow-color)" >Возможности медицинского персонала</h1>
        <div class="container pt-3 pb-3 d-flex justify-content-center align-items-center">
            <div class="row mt-2 ml-2 mr-2">
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/medcard-y.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--yellow-color)"><b>Медкарта</b></h5>
                        <p class="text-muted">Добавляйте рекомендации и записи процесса лечения и обследования пациентов</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/organizer-y.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--yellow-color)"><b>Органайзер</b></h5>
                        <p class="text-muted">Просматривайте график встреч и управляйте задачами</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/notify-y.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--yellow-color)"><b>Уведомления</b></h5>
                        <p class="text-muted">Получайте уведомления и напоминания о событиях</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/control-y.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--yellow-color)"><b>Контроль</b></h5>
                        <p class="text-muted">Контролируйте выполнение поставленных рекомендаций, здоровье и самочувствие пациентов</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/services-y.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--yellow-color)"><b>Услуги</b></h5>
                        <p class="text-muted">Приглашайте пациента к себе на прием и записывайте на прочие услуги</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/support-y.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--yellow-color)"><b>Поддержка</b></h5>
                        <p class="text-muted">Задавайте вопросы технической поддержке по возникшим проблемам</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/pills-y.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--yellow-color)"><b>Рецепты</b></h5>
                        <p class="text-muted">Выписывайте рецепты по лекарствам пациентам</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="text-center mt-3 pl-1 pr-1">
                        <img src="/images/promo/chat-y.svg" alt="" class="mb-1" height="100">
                        <h5 class="text-uppercase mb-0" style="color: var(--yellow-color)"><b>Сопровождение</b></h5>
                        <p class="text-muted">Общайтесь с пациентами и отвечайте на их вопросы о здоровье</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Четвертая секция с контактными данными для связи-->
    <div style="min-height: 100vh" class="d-flex justify-content-center align-items-center flex-column" id="info">
        <div class="container">
<!--Заголовочная информация секции-->
            <div class="text-center">
                <h1 style="color: var(--dark-cyan-color);">Контакты</h1>
                <p class="text-muted mt-2">Напишите нам, если у вас остались вопросы. Для этого необходимо
                    <br> заполнить форму ниже или связаться по контактным данным</p>
            </div>
            <div class="row">
<!--Первая колонка контактных данных-->
                <div class="col-md-4">
                    <p class="text-muted mt-4"><span class="font-weight-bold">Телефон поддержки:</span><br> <span class="d-block mt-1"><?php echo contact_number; ?></span></p>
                    <p class="text-muted mt-4"><span class="font-weight-bold">Электронная почта:</span><br> <span class="d-block mt-1"><?php echo email_info; ?></span></p>
                    <p class="text-muted mt-4"><span class="font-weight-bold">Адрес:</span><br> <span class="d-block mt-1"><?php echo contact_address; ?></span></p>
                </div>
<!--Вторая колонка с формой для отправки вопросов-->
                <div class="col-md-8">
                    <form>
                        <div class="row mt-4">
<!--Поле с вводом имени пользователя-->
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label class="form-label text-muted font-weight-bold">Ваше имя</label>
                                    <input class="form-control" type="text" required placeholder="Имя...">
                                </div>
                            </div>
<!--Поле с вводом почты пользователя-->
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label class="form-label text-muted font-weight-bold">Электронная почта</label>
                                    <input class="form-control" type="email" required placeholder="Почта...">
                                </div>
                            </div>
                        </div>
<!--Поле с вводом темы сообщения-->
                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label class="form-label text-muted font-weight-bold">Тема сообщения</label>
                                    <input class="form-control" type="text" placeholder="Введите тему...">
                                </div>
                            </div>
                        </div>
<!--Поле с вводом основного сообщения с вопросами и т. п.-->
                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label for="comments" class="form-label text-muted font-weight-bold">Сообщение</label>
                                    <textarea id="comments" rows="4" class="form-control" required placeholder="Задайте интересующий вас вопрос..."></textarea>
                                </div>
                            </div>
                        </div>
<!--Кнопка для отправки данных формы-->
                        <div class="row mt-2">
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-info float-right text-white" style="background-color: var(--dark-cyan-color)">Отправить <i class="fas fa-envelope"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Список всплывающих уведомлений-->
<div class="position-fixed p-3" style="z-index: 5; right: 0; bottom: 0;">
    <!--Всплывающее уведомление с задержкой в 5 сек-->
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
    //Вызов отображения уведомления с указанным ID
    $('#notificationToast').toast('show');
</script>
</html>