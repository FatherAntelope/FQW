<?php
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
if(!isset($_COOKIE['user_token']))
    header("Location: /error/401.php");
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";
$user = new User($_COOKIE['user_token']);
if($user->getStatusCode() === 400) {
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.php");
}
if(!$user->isUserRole("Admin"))
    header("Location: /error/403.php");

$user_data = $user->getData();
$whose_user = 1;

$getSelected = $_GET['selected'];
if($getSelected != "patient" &&
    $getSelected != "doctor" &&
    $getSelected != "administrator") {
    header("Location: /lk/users/");
    exit;
}

$url = protocol."://".domain_name_api."/api/med/speciality";
$config = [
    "method" => "GET",
    "token" => $_COOKIE['user_token']
];
$specialities = utils_call_api($url, $config);

$url = protocol."://".domain_name_api."/api/med/procedure";
$config = [
    "method" => "GET",
    "token" => $_COOKIE['user_token']
];
$procedures = utils_call_api($url, $config);

$url = protocol."://".domain_name_api."/api/med/survey";
$config = [
    "method" => "GET",
    "token" => $_COOKIE['user_token']
];
$examinations = utils_call_api($url, $config);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/images/logo-mini.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/chosen.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>
    <script src="/js/chosen.js"></script>
    <title>Регистрация пользователя</title>
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
                <li class="breadcrumb-item"><a href="/lk/users/" style="color: var(--dark-cyan-color)">Пользователи</a></li>
                <li class="breadcrumb-item active" aria-current="page">Регистрация нового пользователя</li>
            </ol>
        </nav>
        <ul class="nav nav-pills flex-column flex-sm-row mb-2" role="tablist" id="tablist">
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <?php if($getSelected == 'patient') echo "active";?>" onclick="window.history.pushState('', '', '/lk/users/add.php?selected=patient');"  data-toggle="tab" href="#patient" role="tab">
                    <i class="fas fa-user-injured mr-2"></i>Пациент
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <?php if($getSelected == 'doctor') echo "active";?>" onclick="window.history.pushState('', '', '/lk/users/add.php?selected=doctor');" data-toggle="tab" href="#doctor" role="tab">
                    <i class="fas fa-user-md mr-1"></i> Медицинский персонал
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <?php if($getSelected == 'administrator') echo "active";?>" onclick="window.history.pushState('', '', '/lk/users/add.php?selected=administrator');" data-toggle="tab" href="#admin" role="tab">
                    <i class="fas fa-user-cog mr-1"></i> Администрация
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show <?php if($getSelected == 'patient') echo "active";?>" id="patient" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center animate slideIn" hidden>
                            <div class="col-md-12">
                                <div class="text-center mt-2">
                                    <img src="/images/mail_sent.svg" alt="" height="170">
                                    <h3 class="mt-4" style="color: var(--dark-cyan-color)"><b>Пациент зарегистрирован</b></h3>
                                    <p class="text-muted">Теперь он может пользоваться всеми функциями профиля! Не забудьте сообщить, что на указанную почту при регистрации ему отправлен пароль для входа в профиль</p>
                                    <button type="button" class="btn mt-2 text-white" style="background-color: var(--dark-cyan-color)" onclick="location.reload();">
                                        <i class="fas fa-reply mr-2"></i>Зарегистрировать еще
                                    </button>
                                </div>
                            </div>
                        </div>
                        <form id="queryRegistrationPatient" enctype="multipart/form-data">
                            <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                                <i class="fas fa-user mr-1"></i>
                                Персональные данные
                            </h5>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Фамилия <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="text" class="form-control" name="user_surname" minlength="2" maxlength="30" onkeyup="checkInputRu(this)" required>
                                    <small class="form-text text-muted">Кириллица</small>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Имя <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="text" class="form-control" name="user_name" minlength="2" maxlength="30" onkeyup="checkInputRu(this)" required>
                                    <small class="form-text text-muted">Кириллица</small>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Отчество</label>
                                        <input type="text" class="form-control" name="user_patronymic" maxlength="30" onkeyup="checkInputRu(this)">
                                    <small class="form-text text-muted">Кириллица</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <label style="color: var(--yellow-color)">Пол <strong style="color: var(--red--color)">*</strong></label><br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="radio_box_man" name="patient_gender" value="Male" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="radio_box_man">М</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="radio_box_woman" name="patient_gender" value="Female" class="custom-control-input">
                                        <label class="custom-control-label" for="radio_box_woman">Ж</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label style="color: var(--yellow-color)">Категория пациента <strong style="color: var(--red--color)">*</strong></label><br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="radio_box_healing" name="patient_category" value="Treating" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="radio_box_healing">Лечащийся</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="radio_box_resting" name="patient_category" value="Vacationer" class="custom-control-input">
                                        <label class="custom-control-label" for="radio_box_resting">Отдыхающий</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Дата рождения <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="date" class="form-control" name="patient_date_birth" min="1940-01-01" max="<?php echo date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y') - 14))?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Фото</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" accept="image/png,image/jpeg" id="customFile" name="user_photo">
                                            <label class="custom-file-label" for="customFile" data-browse="Открыть">Выберите фото</label>
                                        </div>
                                        <small class="form-text text-muted">До 2мб</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="color: var(--yellow-color)">Паспортные данные <strong style="color: var(--red--color)">*</strong></label>
                                <div class="form-row">
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control" placeholder="99 99 999999" name="patient_passport_id" required>
                                        <small class="text-muted form-text">Серия и номер</small>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control" placeholder="999-999" name="patient_passport_code" required>
                                        <small class="text-muted form-text">Код подразделения</small>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="date" class="form-control" placeholder="Дата выдачи" name="patient_passport_date_issue" required>
                                        <small class="text-muted form-text">Дата выдачи</small>
                                    </div>
                                    <div class="col-lg">
                                        <input type="text" class="form-control" name="patient_passport_who_issue" minlength="5" maxlength="100" required>
                                        <small class="text-muted form-text">Кем выдан</small>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                                <i class="fas fa-address-book mr-1"></i>
                                Контактные данные
                            </h5>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Почта <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="email" class="form-control" placeholder="example@mail.ru" maxlength="50" name="user_email" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Номер телефона <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="tel" class="form-control" placeholder="+7 (999) 999-99-99" minlength="18" name="user_phone" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col alert alert-danger alert-dismissible fade show animate slideIn mr-3 ml-3" id="alertErrorRegistrationPatient" role="alert" style="font-size: 12px" hidden>
                                    Аккаунт с указанным адресом электронной почты уже существует. Измените или проверьте введенный адрес электронной почты!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Регион <strong style="color: var(--red--color)">*</strong></label>
                                        <select id="chosen_required_region" name="patient_region" class="form-control form-control-chosen-required" data-placeholder="Выберите регион" required>
                                            <option></option>
                                            <option value="Алтайский край">Алтайский край</option>
                                            <option value="Амурская область">Амурская область</option>
                                            <option value="Архангельская область">Архангельская область</option>
                                            <option value="Астраханская область">Астраханская область</option>
                                            <option value="Белгородская область">Белгородская область</option>
                                            <option value="Брянская область">Брянская область</option>
                                            <option value="Владимирская область">Владимирская область</option>
                                            <option value="Волгоградская область">Волгоградская область</option>
                                            <option value="Вологодская область">Вологодская область</option>
                                            <option value="Воронежская область">Воронежская область</option>
                                            <option value="Москва">г. Москва</option>
                                            <option value="Еврейская автономная область">Еврейская автономная область</option>
                                            <option value="Забайкальский край">Забайкальский край</option>
                                            <option value="Ивановская область"> Ивановская область</option>
                                            <option value="Иные территории">Иные территории, включая город и космодром Байконур</option>
                                            <option value="Иркутская область"> Иркутская область</option>
                                            <option value="Кабардино-Балкарская Республика">Кабардино-Балкарская Республика</option>
                                            <option value="Калининградская область">Калининградская область</option>
                                            <option value="Калужская область">Калужская область</option>
                                            <option value="Камчатский край">Камчатский край</option>
                                            <option value="Карачаево-Черкесская Республика">Карачаево-Черкесская Республика</option>
                                            <option value="Кемеровская область - Кузбасс"> Кемеровская область - Кузбасс</option>
                                            <option value="Кировская область">Кировская область</option>
                                            <option value="Костромская область">Костромская область</option>
                                            <option value="Краснодарский край">Краснодарский край</option>
                                            <option value="Красноярский край">Красноярский край</option>
                                            <option value="Курганская область">Курганская область</option>
                                            <option value="Курская область">Курская область</option>
                                            <option value="Ленинградская область">Ленинградская область</option>
                                            <option value="Липецкая область">Липецкая область</option>
                                            <option value="Магаданская область">Магаданская область</option>
                                            <option value="Московская область">Московская область</option>
                                            <option value="Мурманская область">Мурманская область</option>
                                            <option value="Ненецкий автономный округ">Ненецкий автономный округ</option>
                                            <option value="Нижегородская область">Нижегородская область</option>
                                            <option value="Новгородская область">Новгородская область</option>
                                            <option value="Новосибирская область">Новосибирская область</option>
                                            <option value="Омская область">Омская область</option>
                                            <option value="Оренбургская область">Оренбургская область</option>
                                            <option value="Орловская область">Орловская область</option>
                                            <option value="Пензенская область">Пензенская область</option>
                                            <option value="Пермский край">Пермский край</option>
                                            <option value="Приморский край">Приморский край</option>
                                            <option value="Псковская область">Псковская область</option>
                                            <option value="Республика Адыгея (Адыгея)">Республика Адыгея (Адыгея)</option>
                                            <option value="Республика Алтай">Республика Алтай</option>
                                            <option value="Республика Башкортостан">Республика Башкортостан</option>
                                            <option value="Республика Бурятия">Республика Бурятия</option>
                                            <option value="Республика Дагестан">Республика Дагестан</option>
                                            <option value="Республика Ингушетия">Республика Ингушетия</option>
                                            <option value="Республика Калмыкия">Республика Калмыкия</option>
                                            <option value="Республика Карелия">Республика Карелия</option>
                                            <option value="Республика Коми">Республика Коми</option>
                                            <option value="Республика Крым">Республика Крым</option>
                                            <option value="Республика Марий Эл">Республика Марий Эл</option>
                                            <option value="Республика Мордовия">Республика Мордовия</option>
                                            <option value="Республика Тыва">Республика Тыва</option>
                                            <option value="Республика Хакасия">Республика Хакасия</option>
                                            <option value="Ростовская область">Ростовская область</option>
                                            <option value="Рязанская область">Рязанская область</option>
                                            <option value="Самарская область">Самарская область</option>
                                            <option value="Санкт-Петербург">Санкт-Петербург</option>
                                            <option value="Саратовская область">Саратовская область</option>
                                            <option value="Сахалинская область">Сахалинская область</option>
                                            <option value="Свердловская область">Свердловская область</option>
                                            <option value="Севастополь">Севастополь</option>
                                            <option value="Смоленская область">Смоленская область</option>
                                            <option value="Ставропольский край">Ставропольский край</option>
                                            <option value="Тамбовская область">Тамбовская область</option>
                                            <option value="Тверская область">Тверская область</option>
                                            <option value="Томская область">Томская область</option>
                                            <option value="Тульская область">Тульская область</option>
                                            <option value="Тюменская область">Тюменская область</option>
                                            <option value="Удмуртская Республика">Удмуртская Республика</option>
                                            <option value="Ульяновская область">Ульяновская область</option>
                                            <option value="Хабаровский край">Хабаровский край</option>
                                            <option value="Ханты-Мансийский автономный округ - Югра">Ханты-Мансийский автономный округ - Югра</option>
                                            <option value="Челябинская область">Челябинская область</option>
                                            <option value="Чеченская Республика">Чеченская Республика</option>
                                            <option value="Чувашская Республика - Чувашия">Чувашская Республика - Чувашия</option>
                                            <option value="Чукотский автономный округ">Чукотский автономный округ</option>
                                            <option value="Ямало-Ненецкий автономный округ">Ямало-Ненецкий автономный округ</option>
                                            <option value="Ярославская область">Ярославская область</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Населенный пункт <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="text" class="form-control" name="patient_locality" minlength="2" maxlength="30" required>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                                <i class="fas fa-file-medical-alt mr-1"></i>
                                Состояние здоровья
                            </h5>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Субъективные жалобы <strong style="color: var(--red--color)">*</strong></label>
                                        <textarea class="form-control" name="patient_subjective_complaint" minlength="3" maxlength="500" placeholder="Кратко о том, зачем приехал пациент. Если жалоб нет, то укажите 'Жалоб нет'" required></textarea>
                                        <small class="text-muted form-text">Минимум 3 символа</small>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <input type="hidden" name="user_role" value="Patient">
                                <button type="submit" class="btn mt-2 text-white" style="background-color: var(--dark-cyan-color)">
                                    <i class="fas fa-user-injured mr-2"></i>Зарегистрировать
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show <?php if($getSelected == 'doctor') echo "active";?>" id="doctor" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center animate slideIn" hidden>
                            <div class="col-md-12">
                                <div class="text-center mt-2">
                                    <img src="/images/mail_sent.svg" alt="" height="170">
                                    <h3 class="mt-4" style="color: var(--dark-cyan-color)"><b>Медперсонал зарегистрирован</b></h3>
                                    <p class="text-muted">Теперь он может пользоваться всеми функциями профиля! Не забудьте сообщить, что на указанную почту при регистрации ему отправлен пароль для входа в профиль</p>
                                    <button type="button" class="btn mt-2 text-white" style="background-color: var(--dark-cyan-color)" onclick="location.reload();">
                                        <i class="fas fa-reply mr-2"></i>Зарегистрировать еще
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php if(count($procedures->data) == 0 && count($specialities->data) == 0 && count($examinations->data) == 0) {?>
                        <div class="row justify-content-center animate slideIn">
                            <div class="col-md-12">
                                <div class="text-center mt-2">
                                    <img src="/images/403.svg" alt="" height="170">
                                    <h3 class="mt-4" style="color: var(--red--color)"><b>Нет услуг!</b></h3>
                                    <p class="text-muted">Необходимо создать услугу, чтобы получить доступ к регистрации медицинского персонала</p>
                                    <a href="/lk/services/editor.php?selected=specializations" class="btn mt-2 text-white" style="background-color: var(--dark-cyan-color)">
                                        <i class="fas fa-plus-circle mr-2"></i>Создать услугу
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <form id="queryRegistrationDoctor" enctype="multipart/form-data" method="post" action="/queries/admin/registrationUser.php">
                            <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                                <i class="fas fa-user mr-1"></i>
                                Персональные данные
                            </h5>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Фамилия <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="text" class="form-control" name="user_surname" minlength="2" maxlength="30" onkeyup="checkInputRu(this)" required>
                                    <small class="form-text text-muted">Кириллица</small>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Имя <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="text" class="form-control" name="user_name" minlength="2" maxlength="30" onkeyup="checkInputRu(this)" required>
                                    <small class="form-text text-muted">Кириллица</small>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Отчество</label>
                                        <input type="text" class="form-control" name="user_patronymic" maxlength="30" onkeyup="checkInputRu(this)">
                                    <small class="form-text text-muted">Кириллица</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Дата рождения <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="date" class="form-control" name="doctor_date_birth" min="1940-01-01" max="<?php echo date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y') - 18))?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Фото</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="user_photo" id="customFile" accept="image/jpeg, image/png">
                                            <label class="custom-file-label" for="customFile" data-browse="Открыть">Выберите фото</label>
                                        </div>
                                        <small class="form-text text-muted">До 2 Мб</small>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                                <i class="fas fa-address-book mr-1"></i>
                                Контактные данные
                            </h5>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Почта <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="email" class="form-control" placeholder="example@mail.ru" maxlength="50" name="user_email" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Номер телефона <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="tel" class="form-control" placeholder="+7 (999) 999-99-99" minlength="18" name="user_phone" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col alert alert-danger alert-dismissible fade show animate slideIn mr-3 ml-3" role="alert" id="alertErrorRegistrationDoctor" style="font-size: 12px" hidden>
                                    Аккаунт с указанным адресом электронной почты уже существует. Измените или проверьте введенный адрес электронной почты!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>

                            <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                                <i class="fas fa-briefcase mr-1"></i>
                                Профессиональные навыки
                            </h5>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Должность <strong style="color: var(--red--color)">*</strong></label>
                                        <select id="chosen_required_post" name="doctor_med_post" class="form-control form-control-chosen-required" data-placeholder="Выберите должность" required>
                                            <option></option>
                                            <?php if (count($specialities->data) > 0) { ?>
                                            <option value="Doctor"> Врач</option>
                                            <?php } if (count($examinations->data) > 0 || count($procedures->data) > 0) { ?>
                                            <option value="Specialist"> Специалист по услугам</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-5" id="chosen_med">
                                    <!--Тег для элемента выбора направления работы медперсонала. Не трогать. Используется JS-->
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Квалификационная категория <strong style="color: var(--red--color)">*</strong></label>
                                        <select id="chosen_required_category" name="doctor_med_category" class="form-control form-control-chosen-required" data-placeholder="Выберите категорию" required>
                                            <option></option>
                                            <option value="0"> Без категории</option>
                                            <option value="1"> Первая</option>
                                            <option value="2"> Вторая</option>
                                            <option value="3"> Высшая</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Стаж <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="number" name="doctor_job_stage" class="form-control" min="0" max="70" placeholder="Лет" required>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <input type="hidden" name="user_role" value="Doctor">
                                <button type="submit" class="btn mt-2 text-white" style="background-color: var(--dark-cyan-color)">
                                    <i class="fas fa-user-md mr-2"></i>Зарегистрировать
                                </button>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show <?php if($getSelected == 'administrator') echo "active";?>" id="admin" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center animate slideIn" hidden>
                            <div class="col-md-12">
                                <div class="text-center mt-2">
                                    <img src="/images/mail_sent.svg" alt="" height="170">
                                    <h3 class="mt-4" style="color: var(--dark-cyan-color)"><b>Администратор зарегистрирован</b></h3>
                                    <p class="text-muted">Теперь он может пользоваться всеми функциями профиля! Не забудьте сообщить, что на указанную почту при регистрации ему отправлен пароль для входа в профиль</p>
                                    <button type="button" class="btn mt-2 text-white" style="background-color: var(--dark-cyan-color)" onclick="location.reload();">
                                        <i class="fas fa-reply mr-2"></i>Зарегистрировать еще
                                    </button>
                                </div>
                            </div>
                        </div>
                        <form id="queryRegistrationAdmin" enctype="multipart/form-data">
                            <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                                <i class="fas fa-user mr-1"></i>
                                Персональные данные
                            </h5>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Фамилия <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="text" class="form-control" name="user_surname" minlength="2" maxlength="30" onkeyup="checkInputRu(this)" required>
                                    <small class="form-text text-muted">Кириллица</small>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Имя <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="text" class="form-control" name="user_name" minlength="2" maxlength="30" onkeyup="checkInputRu(this)" required>
                                    <small class="form-text text-muted">Кириллица</small>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Отчество</label>
                                        <input type="text" class="form-control" name="user_patronymic" maxlength="30" onkeyup="checkInputRu(this)">
                                    <small class="form-text text-muted">Кириллица</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Фото</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="user_photo" id="customFile" accept="image/jpeg, image/png">
                                            <label class="custom-file-label" for="customFile" data-browse="Открыть">Выберите фото</label>
                                        </div>
                                        <small class="form-text text-muted">До 2 Мб</small>
                                    </div>
                                </div>
                            </div>

                            <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                                <i class="fas fa-address-book mr-1"></i>
                                Контактные данные
                            </h5>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Почта <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="email" maxlength="50" class="form-control" placeholder="example@mail.ru" name="user_email" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Номер телефона <strong style="color: var(--red--color)">*</strong></label>
                                        <input type="tel" class="form-control" placeholder="+7 (999) 999-99-99" minlength="18" name="user_phone" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col alert alert-danger alert-dismissible fade show animate slideIn mr-3 ml-3" role="alert" id="alertErrorRegistrationAdmin" style="font-size: 12px" hidden>
                                    Аккаунт с указанным адресом электронной почты уже существует. Измените или проверьте введенный адрес электронной почты!
                                    <button type="submit" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>

                            <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                                <i class="fas fa-address-book mr-1"></i>
                                Прочее
                            </h5>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Должность <strong style="color: var(--red--color)">*</strong></label>
                                        <select id="chosen_required_post_adm" name="admin_post" class="form-control form-control-chosen-required" data-placeholder="Выберите должность" required>
                                            <option></option>
                                            <option value="Main">Главный администратор</option>
                                            <option value="Registrar">Регистратор</option>
                                            <option value="Maintenance">Управляющий услугами</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <input type="hidden" name="user_role" value="Admin">
                                <button type="submit" class="btn mt-2 text-white" style="background-color: var(--dark-cyan-color)">
                                    <i class="fas fa-user-cog mr-2"></i>Зарегистрировать
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Футер (нижний блок)-->
<?php require $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</body>
<script>
    function checkInputRu(obj) {
        obj.value = obj.value.replace(/[^а-яё]/ig,'');
    }

    $('#chosen_required_post_adm').chosen();
    $('#chosen_required_region').chosen();
    $('#chosen_required_post').chosen();
    $('#chosen_required_category').chosen();


    $('[name="user_photo"]').on('change', function () {
        if($(this).val !== "") {
            if (this.files[0].size > 2097152) {
                $(this).addClass('is-invalid');
                $(this).val("");
                $(this).parent().next().removeClass('text-muted');
                $(this).parent().next().addClass('text-danger');
            } else {
                $(this).removeClass('is-invalid');
                $(this).attr("placeholder", "Выберите фото");
                $(this).parent().next().removeClass('text-danger');
                $(this).parent().next().addClass('text-muted');
            }
        }
    });



    $(document).on('change', '#chosen_required_post', function () {

        if($('#chosen_required_post').val() === "Doctor") {
            $('#chosen_med').append(
                '<div class="form-group">' +
                    '<label style="color: var(--yellow-color)">Специальность <strong style="color: var(--red--color)">*</strong></label>' +
                    '<select multiple id="chosen_required_profession" name="doctor_profession[]" class="form-control form-control-chosen-required" data-placeholder="Выберите специальность" required>' +
                        '<option></option>' +
                    '</select>' +
                '</div>' +
                '<div class="form-group">' +
                    '<label style="color: var(--yellow-color)">Расположение <strong style="color: var(--red--color)">*</strong></label>' +
                    '<input type="text" class="form-control" placeholder="Номер кабинета или зала" maxlength="30" name="doctor_profession_location" required>'+
                '</div>'
            );
            <?php
            foreach ($specialities->data as $speciality) {
            $url = protocol."://".domain_name_api."/api/med/service/".$speciality['service'];
            $config = [
                "method" => "GET",
                "token" => $_COOKIE['user_token']
            ];
            $service_speciality = utils_call_api($url, $config);

            $url = protocol."://".domain_name_api."/api/med/service/".$service_speciality->data['id']."/servicemedper";
            if(count(utils_call_api($url, $config)->data) > 0)
                continue;
            ?>
            $('#chosen_required_profession').append($('<option>', {
                value: <?php echo $service_speciality->data['id']?>,
                text: "<?php echo $service_speciality->data['name']?>"
            }));
            <?php } ?>


            $('#chosen_required_profession').chosen();
            $('#chosen_required_procedure').closest('div').remove();
            $('#chosen_required_examination').parent().next().closest('div').remove();
            $('#chosen_required_examination').closest('div').remove();
        }
        if($('#chosen_required_post').val() === "Specialist") {
            $('#chosen_med').append(
                '<div class="form-group">' +
                    '<label style="color: var(--yellow-color)">Процедура</label>' +
                    '<select multiple id="chosen_required_procedure" name="doctor_procedure[]" class="form-control form-control-chosen-required" data-placeholder="Выберите процедуру">' +
                        '<option></option>' +
                    '</select>' +
                '</div>' +
                '<div class="form-group">' +
                    '<label style="color: var(--yellow-color)">Обследование</label>' +
                    '<select multiple id="chosen_required_examination" name="doctor_examination[]" class="form-control form-control-chosen-required" data-placeholder="Выберите обследование">' +
                        '<option></option>' +
                    '</select>' +
                '</div>' +
                '<div class="alert alert-info" role="alert" style="font-size: 12px">'
                    + 'Необходимо назначить хотя-бы одну процедуру или обследование' +
                '</div>'

            );

            <?php
            foreach ($procedures->data as $procedure) {
            $url = protocol."://".domain_name_api."/api/med/service/".$procedure['service'];
            $config = [
                "method" => "GET",
                "token" => $_COOKIE['user_token']
            ];
            $service_procedure = utils_call_api($url, $config);
            ?>
            $('#chosen_required_procedure').append($('<option>', {
                value: <?php echo $service_procedure->data['id']?>,
                text: "<?php echo $service_procedure->data['name']?>"
            }));
            <?php } ?>

            <?php
            foreach ($examinations->data as $examination) {
            $url = protocol."://".domain_name_api."/api/med/service/".$examination['service'];
            $config = [
                "method" => "GET",
                "token" => $_COOKIE['user_token']
            ];
            $service_examination = utils_call_api($url, $config);
            ?>
            $('#chosen_required_examination').append($('<option>', {
                value: <?php echo $service_examination->data['id']?>,
                text: "<?php echo $service_examination->data['name']?>"
            }));
            <?php } ?>

            $('#chosen_required_profession').parent().next().closest('div').remove();
            $('#chosen_required_profession').closest('div').remove();
            $('#chosen_required_procedure').chosen();
            $('#chosen_required_examination').chosen();
        }
    });


    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('input[name="user_phone"]').mask("+7 (999) 999-99-99");
    $('input[name="patient_passport_id"]').mask("99 99 999999");
    $('input[name="patient_passport_code"]').mask("999-999");
</script>
<script>
    $("#queryRegistrationPatient").submit(function () {
        $.ajax({
            url: "/queries/admin/registrationUser.php",
            method: "POST",
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            data: new FormData(this),
            success: function () {
                $("#queryRegistrationPatient").prev().removeAttr("hidden");
                $("#queryRegistrationPatient").attr("hidden", "hidden");
                $("#alertErrorRegistrationPatient").attr("hidden", "hidden");
                $('html, body').stop().animate({ scrollTop: $("body").offset().top - 100 }, 400);
            },
            error: function () {
                $("#alertErrorRegistrationPatient").removeAttr("hidden");
            }
        });
        return false;
    });

    $("#queryRegistrationDoctor").submit(function () {
        if($('#chosen_required_post').prop('selectedIndex') === 2) {
            if($('#chosen_required_examination').val().length === 0 && $('#chosen_required_procedure').val().length === 0) {
                $("#alertErrorRegistrationDoctor").removeAttr("hidden");
                $('#chosen_required_examination').parent().next().removeClass("alert-info");
                $('#chosen_required_examination').parent().next().addClass("alert-danger");
                return false;
            } else {
                $('#chosen_required_examination').parent().next().removeClass("alert-danger");
                $('#chosen_required_examination').parent().next().addClass("alert-info");
            }
        }
        $.ajax({
            url: "/queries/admin/registrationUser.php",
            method: "POST",
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            data: new FormData(this),
            success: function () {
                $("#queryRegistrationDoctor").prev().removeAttr("hidden");
                $("#queryRegistrationDoctor").attr("hidden", "hidden");
                $("#alertErrorRegistrationDoctor").attr("hidden", "hidden");
            },
            error: function () {
                $("#alertErrorRegistrationDoctor").removeAttr("hidden");
            }
        });
        return false;
    });

    $("#queryRegistrationAdmin").submit(function () {
        $.ajax({
            url: "/queries/admin/registrationUser.php",
            method: "POST",
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            data: new FormData(this),
            success: function () {
                $("#queryRegistrationAdmin").prev().removeAttr("hidden");
                $("#queryRegistrationAdmin").attr("hidden", "hidden");
                $("#alertErrorRegistrationAdmin").attr("hidden", "hidden");
                $('html, body').stop().animate({ scrollTop: $("body").offset().top - 100 }, 400);
            },
            error: function () {
                $("#alertErrorRegistrationAdmin").removeAttr("hidden");
            }
        });
        return false;
    });
</script>
</html>
