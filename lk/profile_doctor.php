<?php
if(!isset($user_data) || $user_data['role'] !== "Doctor") {
    header("Location: /error/403.php");
}
$url = protocol."://".domain_name_api."/api/med/medpersona";
$config = [
    "method" => "GET",
    "token" => $_COOKIE['user_token']
];
$doctor_data = utils_call_api($url, $config);

$url = protocol . '://' . domain_name_api . '/api/med/servicemedper/';
$data = [
    "medpersona" => $doctor_data->data['id']
];
$config = [
    'token' => $_COOKIE['user_token'],
    'method' => 'POST',
    'data' => $data
];
$services_medperson = utils_call_api($url, $config);

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
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="/js/all.js"></script>
    <title><?php echo web_name_header; ?></title>
</head>
<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>

<!--Основной контент страницы-->
<div class="page-content">
    <div class="container pt-3 pb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 text-center">
                        <img src="<?php echo getUrlUserPhoto($user_data['photo'])?> " class="rounded-circle img-thumbnail mb-2" style="object-fit: cover;height: 8rem;width: 8rem;">
                        <br>
                        <a href="/lk/settings/" type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)"><i class="fas fa-user-cog"></i></a>
                        <button type="button" class="btn mt-1 btn-sm btn-danger text-white"><i class="fas fa-door-open"></i></button>
                    </div>
                    <div class="col-lg-10 mt-2">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-bold" style="color: var(--dark-cyan-color)">
                                    <?php echo $user_data['surname']." ".$user_data['name']." ".$user_data['patronymic'];?>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="text-muted">Возраст:
                                    <?php echo floor( (time() - strtotime($doctor_data->data['birth_date'])) /(60 * 60 * 24 * 365.25));?>
                                    (<?php echo date("d.m.Y", strtotime($doctor_data->data['birth_date']));?>)
                                </h5>
                                <h5 class="text-muted">Должность: <?php echo getDoctorPositionRu($doctor_data->data['position'])?></h5>
                                <h5 class="text-muted">Квалификационная категория: <?php echo getDoctorQualificationRu($doctor_data->data['qualification'])?></h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="text-muted">Стаж: <?php echo $doctor_data->data['experience']." ".getTextYear($doctor_data->data['experience'])?></h5>
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
                            <?php echo $doctor_data->data['specialization']?>
                        </h6>
                    </div>
                    <div class="col">
                        <h5 class="text-muted">Образование:</h5>
                        <ul class="text-muted">
                            <?php
                            foreach($doctor_data->data['education'] as $education) {?>
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
                        <a href="tel:<?php echo $user_data['phone_number'];?>" aria-haspopup="true" style="text-decoration: none; color: var(--yellow-color)">
                            <h5 class="font-weight-bold"><i class="fas fa-phone mr-1"></i> <?php echo $user_data['phone_number'];?></h5>
                        </a>
                        <a href="mailto:<?php echo $user_data->data['user']['email'];?>" aria-haspopup="true" style="text-decoration: none; color: var(--yellow-color)">
                            <h5 class="font-weight-bold"><i class="fas fa-envelope-open-text mr-1"></i><?php echo $user_data['email'];?></h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--Карточки мониторинга-->
        <div class="row">
            <div class="col-xl-3 col-md-4 mt-3">
                <!--Карточка с информацией о своих пациентах-->
                <div class="card">
                    <div class="card-body">
                        <div class="float-right text-white widget-icon" style="background-color: var(--dark-cyan-color)">
                            <i class="fas fa-user-injured"></i>
                        </div>
                        <h5 class="text-muted mt-0">Мои пациенты</h5>
                        <h3 class="mt-3 mb-3" style="color: var(--dark-cyan-color)">15</h3>
                    </div>
                </div>
                <!--Карточка с информацией о дневниках самонаблюдения-->
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="float-right bg-danger text-white widget-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h5 class="text-muted mt-0">Дневники</h5>
                        <h3 class="mt-3 mb-3" style="color: var(--dark-cyan-color)">7</h3>
                        <p class="mb-0 text-danger">
                            <i class="fas fa-arrow-alt-circle-down"></i> 10.08%
                        </p>
                        <p class="mb-0 text-muted">Вам нужно проверить все дневники самонаблюдения своих пациентов за текущий день</span></p>
                    </div>
                </div>
            </div>

            <!--Карточка с фиксированием посещения пациентов-->
            <div class="col-xl col-md-8">
                <div class="card mt-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-user-check mr-2"></i>Фиксирование посещаемости пациентов</div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="text-center mt-2">
                                    <img src="/images/no_data.svg" alt="" height="170">
                                    <h5 class="mt-4 text-danger"><b>Пациенты отсутствуют</b></h5>
                                    <p class="text-muted mb-0">К вам не записан ни один пациент на текущий день. Пригласите пациентов к себе на прием, если это необходимо</p>
                                    <a href="#" class="btn text-white btn-sm" style="background-color: var(--cyan-color)">Пациенты</a>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-auto" style="max-height: 307px">
                            <div class="table-responsive">
                                <table class="table table-centered table-striped table-hover mb-0">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="text-muted">Иванов И.И.</span>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="radio_box_expectation_1" name="user_visited_1" value="0" class="custom-control-input" checked>
                                                <label class="custom-control-label" for="radio_box_expectation_1">Ожидание</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="radio_box_visited_1" name="user_visited_1" value="1" class="custom-control-input">
                                                <label class="custom-control-label" for="radio_box_visited_1">Посетил</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="radio_box_not_visited_1" name="user_visited_1" value="2" class="custom-control-input">
                                                <label class="custom-control-label" for="radio_box_not_visited_1">Не посетил</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-muted">Кузнецов И.И.</span>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="radio_box_expectation_2" name="user_visited_2" value="0" class="custom-control-input" checked>
                                                <label class="custom-control-label" for="radio_box_expectation_2">Ожидание</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="radio_box_visited_2" name="user_visited_2" value="1" class="custom-control-input">
                                                <label class="custom-control-label" for="radio_box_visited_2">Посетил</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="radio_box_not_visited_2" name="user_visited_2" value="2" class="custom-control-input">
                                                <label class="custom-control-label" for="radio_box_not_visited_2">Не посетил</label>
                                            </div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8">
                <!--Карточка с таблицей пациентов на сегодня-->
                <div class="card mt-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-notes-medical mr-2"></i>Прием пациентов на сегодня</div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="text-center mt-2">
                                    <img src="/images/no_data.svg" alt="" height="170">
                                    <h5 class="mt-4 text-danger"><b>Пациенты отсутствуют</b></h5>
                                    <p class="text-muted mb-0">К вам не записан ни один пациент на текущий день. Пригласите пациентов к себе на прием, если это необходимо</p>
                                    <a href="#" class="btn text-white btn-sm" style="background-color: var(--cyan-color)">Пациенты</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped table-hover mb-0">
                                <tbody>
                                <tr>
                                    <td>
                                        <h5 class="my-1" style="color: var(--dark-cyan-color)">Лечащийся</h5>
                                        <span class="text-muted">Иванов И.И.</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">Статус</span> <br>
                                        <span class="badge badge-pill text-white" style="background-color: var(--cyan-color)">Ожидание</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">ID карты</span>
                                        <h5>123456789</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted">Участковый</span>
                                        <h5>Иванов И.И.</h5>
                                    </td>

                                    <td>
                                        <span class="text-muted">До приема</span>
                                        <h5>3ч 20мин</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="my-1" style="color: var(--dark-cyan-color)">Отдыхающий</h5>
                                        <span class="text-muted">Иванов И.И.</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">Статус</span> <br>
                                        <span class="badge badge-pill bg-success text-white">Посетил</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">ID карты</span>
                                        <h5>123456789</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted">Участковый</span>
                                        <h5>Иванов И.И.</h5>
                                    </td>

                                    <td>
                                        <span class="text-muted">До приема</span>
                                        <h5>-</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="my-1" style="color: var(--dark-cyan-color)">Отдыхающий</h5>
                                        <span class="text-muted">Иванов И.И.</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">Статус</span> <br>
                                        <span class="badge badge-pill bg-danger text-white">Отсутствовал</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">ID карты</span>
                                        <h5>123456789</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted">Участковый</span>
                                        <h5>-</h5>
                                    </td>

                                    <td>
                                        <span class="text-muted">До приема</span>
                                        <h5>-</h5>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!--Карточка с заметками из органайзера за текущий день-->
            <div class="col-xl-4">
                <div class="card mt-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-tasks mr-2"></i>Заметки на сегодня</div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="text-center mt-2">
                                    <img src="/images/add_notes.svg" alt="" height="170">
                                    <h5 class="mt-4 text-danger"><b>Заметки отсутствуют</b></h5>
                                    <p class="text-muted mb-1">Добавьте новые заметки в органайзере</p>
                                    <a href="#" class="btn text-white btn-sm" style="background-color: var(--cyan-color)">Добавить</a>
                                </div>
                            </div>
                        </div>
                        <form>
                            <div class="custom-checkbox custom-control">
                                <input class="custom-control-input" id="task_1" type="checkbox">
                                <label class="custom-control-label text-muted" for="task_1">Lorem ipsum dolor sit amet.</label>
                            </div>
                            <div class="custom-checkbox custom-control mt-2">
                                <input class="custom-control-input" id="task_2" type="checkbox">
                                <label class="custom-control-label text-muted" for="task_2">Lorem ipsum dolor sit.</label>
                            </div>
                            <div class="custom-checkbox custom-control mt-2">
                                <input class="custom-control-input" id="task_3" type="checkbox">
                                <label class="custom-control-label text-muted" for="task_3">Lorem ipsum dolor sit amet, consectetur adipisicing.</label>
                            </div>
                        </form>
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
<?php require $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

</body>
<script>
    $('#notificationToast').toast('show');
    $(document).ready(function() {
        $('input[type=checkbox]').change(function() {

            if (this.checked) {
                $(this).next().css("text-decoration-line", "line-through");
            } else {
                $(this).next().css("text-decoration-line", "none");
            }

        });
    });
</script>
</html>