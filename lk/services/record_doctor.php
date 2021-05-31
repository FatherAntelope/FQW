<?php
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
$weeks = [ "Mon"=> "Пн" , "Tue" => "Вт" , "Wed" => "Ср" , "Thu" => "Чт" , "Fri" => "Пт" , "Sat" => "Сб",  "Sun" =>"Вс"];
$days_num = 7; //количество
$time_start = "8:00"; //время старта
$time_span = 15; //минуты
$count_records = 10; //количество
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
    <link rel="stylesheet" href="/css/record.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/chosen.js"></script>
    <script defer src="/js/all.js"></script>
    <title><?php echo web_name_header; ?></title>
</head>
<style>
    @media (max-width: 992px) {
        #cost {
            display: none;
        }
    }
</style>
<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>

<!--Основной контент страницы-->
<div class="page-content">
    <div class="container pt-3 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/lk/" style="color: var(--dark-cyan-color)">Профиль</a></li>
                <li class="breadcrumb-item"><a href="/lk/services/" style="color: var(--dark-cyan-color)">Услуги</a></li>
                <li class="breadcrumb-item"><a href="/lk/services/appointment.php?selected=doctors" style="color: var(--dark-cyan-color)">Врачи</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Запись к врачу
                </li>
            </ol>
        </nav>
        <!--Карточка основной информации врача-->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 text-center">
                        <img src="/images/user.png" class="img-thumbnail rounded-circle mb-2" width="120" alt="">
                        <br>
                        <button type="button" disabled class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)"><i class="fas fa-comments"></i></button>
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-md">
                                <h4 class="font-weight-bold" style="color: var(--dark-cyan-color)">Иванова Екатерина Ивановна</h4>
                            </div>
                            <div class="col-md">
                                <h3>
                                    <span class="badge text-secondary float-md-right" style="background-color: var(--yellow-color)">От 500₽</span>
                                    <span class="badge badge-info float-md-right mr-2">506 каб.</span>
                                </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5 class="text-muted">Квалификационная категория: Без категории / Первая / Вторая / Высшая</h5>
                                <h5 class="text-muted">Стаж: 14 лет</h5>
                                <h5 class="text-muted" style="display:inline">Специальность:</h5>
                                <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">Терапевт 500₽</span>
                                <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">Стоматолог 700₽</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-top: 3px solid var(--yellow-color);">
                <div class="row">
                    <div class="col">
                        <h5 class="text-muted">Специализация:</h5>
                        <h6 class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda natus nemo quis sequi. Aut debitis deleniti id in possimus quidem, quo tempore tenetur! A cupiditate dicta dolore doloremque eius ex impedit laborum, libero, mollitia nam nemo optio praesentium qui quo reprehenderit similique totam. Ab delectus labore nihil. Deserunt, enim, vel!</h6>
                    </div>
                    <div class="col">
                        <h5 class="text-muted">Образование:</h5>
                        <ul class="text-muted">
                            <li>
                                1998 г. Медицинский колледж при БГМУ по специальности зубной врач
                            </li>
                            <li>
                                2003-2008 гг. Башкирский государственный медицинский университет
                            </li>
                            <li>
                                2008-2009 гг. Прохождение интернатуры по специальности «Терапевтическая стоматология»
                            </li>
                        </ul>
                    </div>
                </div>
                <hr style="border-top: 3px solid var(--yellow-color);">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-around flex-xl-row flex-md-row flex-sm-column flex-column">
                        <a href="tel:+7 (999) 999-99-99" aria-haspopup="true" style="text-decoration: none; color: var(--yellow-color)">
                            <h5 class="font-weight-bold"><i class="fas fa-phone mr-1"></i> +7 (999) 999-99-99</h5>
                        </a>
                        <a href="mailto:mail@mail.ru" aria-haspopup="true" style="text-decoration: none; color: var(--yellow-color)">
                            <h5 class="font-weight-bold"><i class="fas fa-envelope-open-text mr-1"></i>mail@mail.ru</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--Карточка выбора даты и времени записи на слугу-->
        <div class="card mt-3">
            <div class="card-body">
                <h3 class="text-muted font-weight-bold">Выберите свободную запись</h3>
                <select id="chosen_select_specialization" name="record_select_specialization" class="form-control form-control-chosen-required" data-placeholder="Выберите должность" required>
                    <option value="main" selected>Терапевт</option>
                    <option value="registrar">Стоматолог</option>
                </select>
                <div class="card-body__table" id="card-body__table">

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

<!--Модальное окно подтверждения записи-->
<div class="modal fade" id="openModalRecordConfirm">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h3 style="color: var(--dark-cyan-color)">Регистрация записи на услугу</h3>
                    <span class="text-muted">Запись к врачу</span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Специальность:
                    <span style="color: var(--cyan-color)" id="span_service_name"></span>
                </p>
                <p class="text-muted">Врач:
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
                <form id="queryRecordConfirm">
                    <div class="custom-checkbox custom-control">
                        <input class="custom-control-input" id="record_confirm" name="record_confirm" type="checkbox" required>
                        <label class="custom-control-label text-muted" for="record_confirm" style="text-decoration-line: none">Соглашаюсь с правилом и даю согласие на запись</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info text-white mr-1" style="background-color: var(--cyan-color)" form="queryRecordConfirm">
                    <i class="fas fa-edit mr-1"></i> Подтвердить
                </button>
            </div>
        </div>
    </div>
</div>

<!--Футер (нижний блок)-->
<?php require $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</body>
<script>
    $('#notificationToast').toast('show');
    $('#chosen_select_specialization').chosen();
</script>
<script>
    $(document).ready( () => {
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
        for(let key in timeMap){
            const timeTable = $('#card-body__table');
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

                timeMap[key].forEach(element => {
                    let ceil = document.createElement('div');
                    ceil.classList.add('card-body__ceil');

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
            $('#span_service_name').text('Терапевт');
            $('#span_service_doctor').text('Иванова Екатерина Ивановна');
            $('#span_service_location').text('505 кабинет');
            $('#span_service_datetime').text($(this).siblings(".head").text() + " " +$(this).text());
            $('#span_service_cost').text('500₽');

            $('#openModalRecordConfirm').modal('show');
        });

    });


</script>
</html>