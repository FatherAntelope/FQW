<?php
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
if(!isset($_COOKIE['user_token'])) {
    header("Location: /error/401.php");
    exit();
}
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";
$user = new User($_COOKIE['user_token']);
if($user->getStatusCode() === 400 || $user->getStatusCode() === 403) {
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.php");
    exit();
}
if(!$user->isUserRole("Admin")) {
    header("Location: /error/403.php");
    exit();
}
$user_data = $user->getData();
$whose_user = 1;

if(!isset($_GET['admin']) && !isset($_GET['patient']) && !isset($_GET['doctor']) || count($_GET) > 1)
    header("Location: /lk/users/");

$config = null; $user_group_info = null; $user_info = null;

if(array_keys($_GET)[0] === "patient") {
    // Достает все данные пациента
    $url = protocol . '://' . domain_name_api . '/api/med/patients/' . $_GET['patient'];
    $config = [
        'token' => $_COOKIE['user_token'],
        'method' => 'GET'
    ];
    $user_group_info = utils_call_api($url, $config);
    if ($user_group_info->status_code == 404) {
        header("Location: /lk/users/");
        exit();
    }

    // Достает все данные пользователя
    $url = protocol.'://'.domain_name_api.'/api/med/users/'.$user_group_info->data['user'];
    $user_info = utils_call_api($url, $config);

    // Достает данные медицинской карты пользователя
    $url = protocol."://".domain_name_api."/api/med/users/patients/".$_GET['patient']."/medcard";
    $config = [
        "method" => "GET",
        "token" => $_COOKIE['user_token']
    ];
    $patient_medcard = utils_call_api($url, $config);

    // Достает паспортные данные пациента
    $url = protocol."://".domain_name_api."/api/med/users/".$user_info->data['user']['id']."/passport";
    $config = [
        "method" => "GET",
        "token" => $_COOKIE['user_token']
    ];
    $passport_data = utils_call_api($url, $config);


    $url = protocol."://".domain_name_api."/api/med/medicpatient?patient=" . $_GET['patient'];
    $medicpatient = utils_call_api($url, $config);

    if (count($medicpatient->data) > 0) {
        $url = protocol."://".domain_name_api."/api/med/medics/".$medicpatient->data[0]['medpersona'];
        $medicpatient_doctor = utils_call_api($url, $config);

        $url = protocol."://".domain_name_api."/api/med/users/".$medicpatient_doctor->data['user'];
        $medicpatient_doctor_user = utils_call_api($url, $config);
    }
}

if(array_keys($_GET)[0] === "admin") {
    $url = protocol . '://' . domain_name_api . '/api/med/admins/' . $_GET['admin'];
    $config = [
        'token' => $_COOKIE['user_token'],
        'method' => 'GET'
    ];
    $user_group_info = utils_call_api($url, $config);
    if ($user_group_info->status_code == 404) {
        header("Location: /lk/users/");
        exit();
    }
    $url = protocol.'://'.domain_name_api.'/api/med/users/'.$user_group_info->data['user'];
    $user_info = utils_call_api($url, $config);
}

if(array_keys($_GET)[0] === "doctor") {
    $url = protocol . '://' . domain_name_api . '/api/med/medics/'.$_GET['doctor'];
    $config = [
        'token' => $_COOKIE['user_token'],
        'method' => 'GET'
    ];
    $user_group_info = utils_call_api($url, $config);
    if ($user_group_info->status_code == 404) {
        header("Location: /lk/users/");
        exit();
    }
    $url = protocol.'://'.domain_name_api.'/api/med/users/'.$user_group_info->data['user'];
    $user_info = utils_call_api($url, $config);


    $url = protocol . '://' . domain_name_api . '/api/med/medics/'.$user_group_info->data['id'].'/servicemedper';
    $config = [
        'token' => $_COOKIE['user_token'],
        'method' => 'GET'
    ];
    $services_medperson = utils_call_api($url, $config);
}
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
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>
    <title>СанКонтроль</title>
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
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo getItitialsFullName($user_info->data['user']['surname'], $user_info->data['user']['name'], $user_info->data['user']['patronymic']); ?>
                </li>
            </ol>
        </nav>
        <!--Карточка с основной информацией пациента-->
        <?php if(array_keys($_GET)[0] === "patient") { ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 text-center">
                        <img src="<?php echo getUrlUserPhoto($user_info->data['user']['photo'])?>" class="rounded-circle img-thumbnail mb-2" style="height: 8rem;width: 8rem; object-fit: cover">
                        <br>
                        <button type="button" disabled class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)"><i class="fas fa-comments"></i></button>
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-bold" style="color: var(--dark-cyan-color)">
                                    <?php echo $user_info->data['user']['surname']." ".$user_info->data['user']['name']." ". $user_info->data['user']['patronymic']; ?>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <h5 class="text-muted">Возраст:
                                    <?php echo floor( (time() - strtotime($user_group_info->data['birth_date'])) /(60 * 60 * 24 * 365.25));?>
                                    (<?php echo date("d.m.Y", strtotime($user_group_info->data['birth_date']));?>)
                                </h5>
                                <h5 class="text-muted">Пол: <?php echo getPatientGenderRu($user_group_info->data['gender']); ?></h5>
<!--                                <h5 class="text-muted">Рост: 170 cм. </h5>-->
                                <h5 class="text-muted">Категория: <?php echo getPatientCategoryRu($user_group_info->data['type']); ?> </h5>
                            </div>
                            <div class="col-lg-7">
                                <h5 class="text-muted">ID карты: <?php echo $patient_medcard->data['id']; ?></h5>
                                <h5 class="text-muted">Участковый врач:
                                    <?php
                                    if(isset($medicpatient_doctor_user)) { ?>
                                        <a href="#" style="color: var(--dark-cyan-color); text-decoration: none">
                                            <?php echo getItitialsFullName(
                                                $medicpatient_doctor_user->data['user']['surname'],
                                                $medicpatient_doctor_user->data['user']['name'],
                                                $medicpatient_doctor_user->data['user']['patronymic']
                                            ); ?>
                                        </a>
                                    <?php } else {
                                        echo "Отсутствует";
                                    }?>
                                </h5>
                                <h5 class="text-muted">Дата поступления: <?php echo date("d.m.Y", strtotime($user_group_info->data['receipt_date']));?></h5>
                                <?php if(count($user_group_info->data['group']) > 0) {?>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h5 class="text-muted">Группа пациента:</h5>
                                    </div>
                                    <div class="col">
                                        <ul class="list-unstyled">
                                            <?php foreach ($user_group_info->data['group'] as $group) { ?>
                                            <li>
                                                <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)"><?php echo $group?></span>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-top: 3px solid var(--yellow-color);">
                <div class="row">
                    <div class="col-lg-4">
                        <h5 class="text-muted">Паспортные данные:</h5>
                        <p class="text-muted mb-1">
                            <strong>Серия и номер:</strong>
                            <span class="ml-2"><?php echo $passport_data->data['series_number'];?></span>
                        </p>
                        <p class="text-muted mb-1">
                            <strong>Код подразделения:</strong>
                            <span class="ml-2"><?php echo $passport_data->data['code'];?></span>
                        </p>
                        <p class="text-muted mb-1">
                            <strong>Дата выдачи:</strong>
                            <span class="ml-2"><?php echo date("d.m.Y", strtotime($passport_data->data['series_number']));?></span>
                        </p>
                        <p class="text-muted mb-1">
                            <strong>Кем выдан:</strong>
                            <span class="ml-2"><?php echo $passport_data->data['by_whom'];?></span>
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <h5 class="text-muted">Субъективные жалобы:</h5>
                        <h6 class="text-muted"><?php echo $user_group_info->data['complaints']?></h6>
                    </div>
                </div>
                <hr style="border-top: 3px solid var(--yellow-color);">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-around flex-xl-row flex-md-row flex-sm-column flex-column">
                        <a href="tel:<?php echo $user_info->data['user']['phone_number']?>" aria-haspopup="true" style="text-decoration: none; color: var(--yellow-color)">
                            <h5 class="font-weight-bold"><i class="fas fa-phone mr-1"></i> <?php echo $user_info->data['user']['phone_number']?></h5>
                        </a>
                        <a href="mailto:<?php echo $user_info->data['user']['email']?>" aria-haspopup="true" style="text-decoration: none; color: var(--yellow-color); word-break: break-word;">
                            <h5 class="font-weight-bold"><i class="fas fa-envelope-open-text mr-1"></i><?php echo $user_info->data['user']['email']?></h5>
                        </a>
                        <h5 class="font-weight-bold" style="word-break: break-word; color: var(--yellow-color)">
                            <i class="fas fa-map-marked-alt mr-1"></i>
                            <?php echo $user_group_info->data['region']?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <!--Карточка основной информации врача-->
        <?php if(array_keys($_GET)[0] === "doctor") { ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 text-center">
                        <img src="<?php echo getUrlUserPhoto($user_info->data['user']['photo'])?>" class="rounded-circle img-thumbnail mb-2" style="height: 8rem;width: 8rem; object-fit: cover">
                        <br>
                        <button type="button" disabled class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)"><i class="fas fa-comments"></i></button>
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-bold" style="color: var(--dark-cyan-color)">
                                    <?php echo $user_info->data['user']['surname']." ".$user_info->data['user']['name']." ". $user_info->data['user']['patronymic']; ?>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="text-muted">Возраст:
                                    <?php echo floor( (time() - strtotime($user_group_info->data['birth_date'])) /(60 * 60 * 24 * 365.25));?>
                                    (<?php echo date("d.m.Y", strtotime($user_group_info->data['birth_date']));?>)
                                </h5>
                                <h5 class="text-muted">Должность: <?php echo getDoctorPositionRu($user_group_info->data['position'])?></h5>
                                <h5 class="text-muted">Квалификационная категория: <?php echo getDoctorQualificationRu($user_group_info->data['qualification'])?></h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="text-muted">Стаж: <?php echo $user_group_info->data['experience']." ".getTextYear($user_group_info->data['experience'])?> </h5>
                                <h5 class="text-muted">Направление:</h5>
                                <?php foreach ($services_medperson->data as  $service_medperson) {
                                    $url = protocol . '://' . domain_name_api . '/api/med/service/'. $service_medperson['service'];
                                    $config = [
                                        'token' => $_COOKIE['user_token'],
                                        'method' => 'GET',
                                    ];
                                    $service_main = utils_call_api($url, $config);
                                    ?>
                                    <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)"><?php echo $service_main->data['name'];?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-top: 3px solid var(--yellow-color);">
                <div class="row">
                    <div class="col">
                        <h5 class="text-muted">Специализация:</h5>
                        <h6 class="text-muted">
                            <?php echo $user_group_info->data['specialization']?>
                        </h6>
                    </div>
                    <div class="col">
                        <h5 class="text-muted">Образование:</h5>
                        <ul class="text-muted">
                            <?php
                            foreach($user_group_info->data['education'] as $education) {?>
                            <li>
                                <?php echo $education; ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <hr style="border-top: 3px solid var(--yellow-color);">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-around flex-xl-row flex-md-row flex-sm-column flex-column">
                        <a href="tel:<?php echo $user_info->data['user']['phone_number']?>" aria-haspopup="true" style="text-decoration: none; color: var(--yellow-color)">
                            <h5 class="font-weight-bold"><i class="fas fa-phone mr-1"></i> <?php echo $user_info->data['user']['phone_number']?></h5>
                        </a>
                        <a href="mailto:<?php echo $user_info->data['user']['email']?>" aria-haspopup="true" style="word-break: break-word; text-decoration: none; color: var(--yellow-color)">
                            <h5 class="font-weight-bold"><i class="fas fa-envelope-open-text mr-1"></i><?php echo $user_info->data['user']['email']?></h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <!--Карточка основной информации администратора-->
        <?php if(array_keys($_GET)[0] === "admin") { ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 text-center">
                        <img src="<?php echo getUrlUserPhoto($user_info->data['user']['photo'])?>" class="rounded-circle img-thumbnail mb-2" style="height: 8rem;width: 8rem; object-fit: cover">
                        <br>
                        <button type="button" disabled class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)"><i class="fas fa-comments"></i></button>
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-bold" style="color: var(--dark-cyan-color)">
                                    <?php echo $user_info->data['user']['surname']." ".$user_info->data['user']['name']." ". $user_info->data['user']['patronymic']; ?>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <h5 class="text-muted">Должность: <?php echo getAdminPositionRu($user_group_info->data['position']); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-top: 3px solid var(--yellow-color);">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-around flex-xl-row flex-md-row flex-sm-column flex-column">
                        <a href="tel:<?php echo $user_info->data['user']['phone_number']?>" aria-haspopup="true" style="text-decoration: none; color: var(--yellow-color)">
                            <h5 class="font-weight-bold"><i class="fas fa-phone mr-1"></i><?php echo $user_info->data['user']['phone_number']?></h5>
                        </a>
                        <a href="mailto:<?php echo $user_info->data['user']['email']?>" aria-haspopup="true" style="text-decoration: none; color: var(--yellow-color); word-break: break-word;">
                            <h5 class="font-weight-bold"><i class="fas fa-envelope-open-text mr-1"></i><?php echo $user_info->data['user']['email']?></h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
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

</script>
</html>