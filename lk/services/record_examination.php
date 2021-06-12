<?php
if(!isset($user_data))
    header("Location: /error/403.php");

$weeks = [ "Mon"=> "Пн" , "Tue" => "Вт" , "Wed" => "Ср" , "Thu" => "Чт" , "Fri" => "Пт" , "Sat" => "Сб",  "Sun" =>"Вс"];
$days_num = 7; //количество
$time_start = "8:00"; //время старта
$time_span = 15; //минуты
$count_records = 10; //количество

if($user_data['role'] == "Patient") {
    $url = protocol."://".domain_name_api."/api/med/patient";
    $config = [
        "method" => "GET",
        "token" => $_COOKIE['user_token']
    ];
    $patient_data = utils_call_api($url, $config);
}

// Достает данные обследования по ID
$url = protocol."://".domain_name_api."/api/med/survey/".$_GET['id'];
$config = [
    "method" => "GET",
    "token" => $_COOKIE['user_token']
];
$examination = utils_call_api($url, $config);

// Достает основные данные обследования по ID
$url = protocol."://".domain_name_api."/api/med/service/".$examination->data['service'];
$examination_service = utils_call_api($url, $config);

$url = protocol . '://' . domain_name_api . '/api/med/service/'.$examination_service->data['id'].'/servicemedper';
$service_medpers_examination = utils_call_api($url, $config);
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
    <link rel="stylesheet" href="/css/record.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>
    <title><?php echo web_name_header; ?></title>
</head>
<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>

<!--Основной контент страницы-->
<div class="page-content">
    <div class="container pt-3 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php if($user_data['role'] == "Patient") {?>
                    <li class="breadcrumb-item"><a href="/lk/" style="color: var(--dark-cyan-color)">Профиль</a></li>
                    <li class="breadcrumb-item"><a href="/lk/services/" style="color: var(--dark-cyan-color)">Услуги</a></li>
                    <li class="breadcrumb-item"><a href="/lk/services/appointment.php?selected=examinations" style="color: var(--dark-cyan-color)">Обследования</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Запись на мероприятие
                    </li>
                <?php } ?>
                <?php if($user_data['role'] == "Admin") {?>
                    <li class="breadcrumb-item"><a href="/lk/" style="color: var(--dark-cyan-color)">Профиль</a></li>
                    <li class="breadcrumb-item"><a href="/lk/services/editor.php?selected=examinations" style="color: var(--dark-cyan-color)">Управление услугами</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Просмотр обследования
                    </li>
                <?php } ?>
            </ol>
        </nav>
        <!--Карточка основной информации об обследовании-->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h3 class="text-center font-weight-bold" style="color: var(--cyan-color)">
                            <?php echo $examination_service->data['name']; ?>
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h3>
                            <span class="badge text-secondary float-md-right" style="background-color: var(--yellow-color)">
                                <?php echo $examination_service->data['cost']; ?>₽
                            </span>
                            <span class="badge badge-info float-md-right mr-2">
                                <?php echo $examination->data['placement']; ?>
                            </span>
                        </h3>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-5">
                        <img src="<?php echo getUrlUserPhoto($examination->data['photo'])?>" class="img-fluid  rounded" alt="...">
                    </div>
                    <div class="col-lg-7">
                        <h5 class="text-muted">
                            <?php echo $examination->data['description']; ?>
                        </h5>
                    </div>
                </div>
                <div class="row mt-3">
                    <?php if (count($examination->data['purposes']) > 0) {?>
                    <div class="col-lg-7">
                        <div class="alert alert-success">
                            <h5>Назначения:</h5>
                            <ul>
                                <?php foreach ($examination->data['purposes'] as $purposes) {?>
                                    <li><?php echo $purposes; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <h5 class="text-muted" id="specialists"> Специалист:
                    <span>
                        <?php foreach ($service_medpers_examination->data as $service_medper_examination) {
                            $url = protocol . '://' . domain_name_api . '/api/med/medics/' . $service_medper_examination['medpersona'];
                            $examination_medpersona = utils_call_api($url, $config);

                            $url = protocol . '://' . domain_name_api . '/api/med/users/' . $examination_medpersona->data['user'];
                            $examination_medpersona_user = utils_call_api($url, $config);
                            ?>
                            <span class="badge badge-pill text-white" style="background-color: var(--cyan-color)">
                                <?php echo getItitialsFullName($examination_medpersona_user->data['user']['surname'], $examination_medpersona_user->data['user']['name'], $examination_medpersona_user->data['user']['patronymic']);  ?>
                            </span>
                        <?php } ?>
                    </span>
                </h5>
            </div>
        </div>

        <!--Карточка выбора даты и времени записи на слугу-->
        <?php if($user_data['role'] == "Patient") { ?>
        <div class="card mt-3">
            <div class="card-body">
                <h3 class="text-muted font-weight-bold">
                    Выберите запись на свободное время
                </h3>
                <div class="card-body__table" id="card-body__table">

                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<!--Модальное окно подтверждения записи-->
<div class="modal fade" id="openModalRecordConfirm">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h3 style="color: var(--dark-cyan-color)">Регистрация записи на услугу</h3>
                    <span class="text-muted">Запись на обследование</span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success mt-3" role="alert" style="font-size: 12px" id="alertSuccessRecordOnServiceConfirm" hidden>
                    Вы успешно записались на обследование!
                </div>
                <div>
                    <p class="text-muted">Направление:
                        <span style="color: var(--cyan-color)" id="span_service_name"></span>
                    </p>
                    <p class="text-muted">Специалисты:
                        <span style="color: var(--cyan-color)" id="span_service_doctor"></span>
                    </p>
                    <p class="text-muted">Расположение:
                        <span style="color: var(--cyan-color)" id="span_service_location"></span>
                    </p>
                    <p class="text-muted">Дата и время:
                        <span style="color: var(--cyan-color)" id="span_service_datetime"></span>
                    </p>
                    <p class="text-muted">Стоимость услуги:
                        <span style="color: var(--cyan-color)" id="span_service_cost"></span>
                    </p>
                    <div class="alert alert-secondary" style="font-size: 12px">
                        Правило: <br>
                        Если не сможете посетить услугу в выбранное время, пожалуйста, отмените прием
                    </div>
                </div>
                <form id="queryRecordOnServiceConfirm">
                    <input type="hidden" name="record_time">
                    <input type="hidden" name="record_id_service">
                    <input type="hidden" name="record_service_type" value="survey">
<!--                    <input type="hidden" value="--><?php //echo $patient_data->data['id'];?><!--" name="record_id_patient">-->
                    <div class="custom-checkbox custom-control">
                        <input class="custom-control-input" id="record_confirm" name="record_confirm" type="checkbox" required>
                        <label class="custom-control-label text-muted" for="record_confirm" style="text-decoration-line: none">Соглашаюсь с правилом и даю согласие на запись</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info text-white mr-1" style="background-color: var(--cyan-color)" form="queryRecordOnServiceConfirm">
                    <i class="fas fa-edit mr-1"></i> Подтвердить
                </button>
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
</script>
<script>
    let busyDates = [];
    $(document).ready(function(){
        $.ajax({
            url: '/queries/patient/getBusyTimes.php',
            method: 'POST',
            data: {
                'record_id_service': '<?php echo $examination_service->data['id']; ?>'
            },
            async: false,
            dataType: 'json',
            success: function(data) {
                busyDates = data;
            },
            // error: function() {
            //     alert('an error occurred while getting busy times!');
            // }
        });
    // });
    // $(document).ready( () => {
        const timeMap = {
            <?php for($i = 0; $i < $days_num; $i++) {?>
            '<?php echo date("d.m", time() + 86400 * $i)." ".$weeks[date("D", time() + 86400 * ($i))]; ?> ' : [
                <?php
                //past, busy, empty
                for($j = 0; $j < $count_records; $j++) { ?>
                {
                    time: '<?php echo date("H:i", strtotime('+'.$time_span * $j.' min', strtotime($time_start))); ?>',
                    flag: '',
                    id: '<?php echo "datetime_".$i."_".$j?>',
                },
                <?php } ?>
            ],
            <?php } ?>
        }

        $(".card-body__row").remove();
        for(let key in timeMap){
            const timeTable = $('#card-body__table  ');
            if(timeMap.hasOwnProperty(key)){
                //создаем элемент столбца
                let row = document.createElement('div');
                row.classList.add('card-body__row');

                //создаем элемент главной ячейки
                let ceilHead = document.createElement('div');
                ceilHead.classList.add('card-body__ceil');
                ceilHead.classList.add('head');
                ceilHead.innerHTML = key;

                //вставляем ячейку в столбец
                row.append(ceilHead);

                //вставляем столбец на страницу
                timeTable.append(row);
                let busyTimes = [];
                Object.keys(busyDates).forEach(element => {
                    if (key.indexOf(element) !== -1) {
                        busyTimes = busyDates[element];
                    }
                });

                timeMap[key].forEach(element => {
                    let ceil = document.createElement('div');
                    ceil.classList.add('card-body__ceil');

                    if (busyTimes.includes(element.time)) {
                        element.flag = 'busy';
                    }

                    if(element.flag && element.flag != ''){
                        ceil.classList.add(element.flag);
                    }
                    if(element.time && element.time != ''){
                        ceil.innerHTML = element.time;
                    }
                    if(element.id && element.id != ''){
                        ceil.id = element.id;
                    }
                    row.append(ceil);
                });
            }
        }


        $(".card-body__ceil").click(function(){
            $('input[name="record_time"]').val($(this).siblings(".head").text() + " " +$(this).text());
            $('input[name="record_id_service"]').val('<?php echo $examination_service->data['id']; ?>');

            $('#span_service_name').text('<?php echo $examination_service->data['name']; ?>');
            $('#span_service_doctor').html($("#specialists").children().html());
            $('#span_service_location').text('<?php echo $examination->data['placement']; ?>');
            $('#span_service_datetime').text($(this).siblings(".head").text() + " " +$(this).text());
            $('#span_service_cost').text('<?php echo $examination_service->data['cost']; ?>' + "₽");
            $('#openModalRecordConfirm').modal('show');
        });
    });
</script>
<script>
    $("#queryRecordOnServiceConfirm").submit(function () {
        $.ajax({
            url: "/queries/patient/queryRecordOnServiceConfirm.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#alertSuccessRecordOnServiceConfirm").removeAttr("hidden");
                $("#queryRecordOnServiceConfirm").prev().attr("hidden", "hidden");
                $("#queryRecordOnServiceConfirm").parent().next().attr("hidden", "hidden");
                $("#queryRecordOnServiceConfirm").attr("hidden", "hidden");
                setTimeout(function(){ location.reload()}, 1100);
            },
            error: function () {

            }
        });
        return false;
    });
</script>
</html>