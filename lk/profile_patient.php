<?php

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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="/js/all.js"></script>
    <title>СанКонтроль</title>
</head>
<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>

<!--Основной контент страницы-->
<div class="page-content">
    <div class="container pt-3 pb-3">
        <!--Карточка с основной информацией пользователя-->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 text-center">
                        <img src="/images/user.png" class="img-thumbnail rounded-circle mb-4" width="120" alt="">
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-bold" style="color: var(--dark-cyan-color)">Иванов Иван Иванович</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <h5 class="text-muted">Возраст: 22 (01.01.1999)</h5>
                                <h5 class="text-muted">Пол: Мужской</h5>
                                <h5 class="text-muted">Рост: 170 cм. </h5>
                                <h5 class="text-muted">Тип: Лечащийся </h5>
                            </div>
                            <div class="col-lg-7">
                                <h5 class="text-muted">ID карты: 123456789</h5>
                                <h5 class="text-muted">Ваш терапевт: <a href="#" style="color: var(--dark-cyan-color); text-decoration: none">Иванов И.И.</a> </h5>
                                <h5 class="text-muted">Дата поступления: 01.01.1999</h5>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h5 class="text-muted">Категория:</h5>
                                    </div>
                                    <div class="col">
                                        <ul class="list-unstyled">
                                            <li>
                                                <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">С сахарным диабетом</span>
                                            </li>
                                            <li>
                                                <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">После Ковид</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <h5 class="font-weight-bold" style="color: var(--yellow-color)">
                            <i class="fas fa-map-marked-alt mr-1"></i>
                            Республика Башкортостан
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <!--Карточки с информацией из дневника самонаблюдения-->
        <div class="row">
            <!--Карточка с информацией о шагах за текущий день-->
            <div class="col-xl col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right bg-danger text-white widget-icon">
                            <i class="fas fa-shoe-prints"></i>
                        </div>
                        <h5 class="text-muted mt-0">Шаги</h5>
                        <h3 class="mt-3 mb-3" style="color: var(--dark-cyan-color)">5,000</h3>
                        <p class="mb-0 text-danger">
                            <i class="fas fa-arrow-alt-circle-down"></i> 50%
                        </p>
                        <p class="mb-0 text-muted">Ниже нормы</span></p>
                    </div>
                </div>
            </div>
            <!--Карточка с информацией о весе (последняя запись)-->
            <div class="col-xl col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right bg-danger text-white widget-icon">
                            <i class="fas fa-weight"></i>
                        </div>
                        <h5 class="text-muted mt-0">Вес</h5>
                        <h3 class="mt-3 mb-3" style="color: var(--dark-cyan-color)">90</h3>
                        <p class="mb-0 text-danger">
                            <i class="fas fa-arrow-alt-circle-up"></i> 10.08%
                        </p>
                        <p class="mb-0 text-muted">Выше нормы</span></p>
                    </div>
                </div>
            </div>
            <!--Карточка с информацией о пульсе (последняя запись)-->
            <div class="col-xl col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right bg-success text-white widget-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h5 class="text-muted mt-0">Пульс</h5>
                        <h3 class="mt-3 mb-3" style="color: var(--dark-cyan-color)">80</h3>
                        <p class="mb-0 text-success">
                            <i class="fas fa-check-circle"></i> -
                        </p>
                        <p class="mb-0 text-muted">Норма</span></p>
                    </div>
                </div>
            </div>
            <!--Карточка с информацией о АД (последняя запись)-->
            <div class="col-xl col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right bg-warning text-white widget-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h5 class="text-muted mt-0">Давление</h5>
                        <h3 class="mt-3 mb-3" style="color: var(--dark-cyan-color)">140/90</h3>
                        <p class="mb-0 text-warning">
                            <i class="fas fa-arrow-alt-circle-up"></i> 1.08%
                        </p>
                        <p class="mb-0 text-muted">Чуть выше нормы</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!--Карточки с информацией из дневника самонаблюдения, как и выше, если данные отсутствуют-->
        <div class="row">
            <div class="col-xl col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right bg-info text-white widget-icon">
                            <i class="fas fa-shoe-prints"></i>
                        </div>
                        <h5 class="text-muted mt-0">Шаги</h5>
                        <div class="text-center mt-2">
                            <img src="/images/visual_data.svg" alt="" height="70">
                        </div>
                        <p class="mb-0 text-muted">Данные отсутствуют</span></p>
                    </div>
                </div>
            </div>
            <div class="col-xl col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right bg-info text-white widget-icon">
                            <i class="fas fa-weight"></i>
                        </div>
                        <h5 class="text-muted mt-0">Вес</h5>
                        <div class="text-center mt-2">
                            <img src="/images/visual_data.svg" alt="" height="70">
                        </div>
                        <p class="mb-0 text-muted">Данные отсутствуют</span></p>
                    </div>
                </div>
            </div>

            <div class="col-xl col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right bg-info text-white widget-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h5 class="text-muted mt-0">Пульс</h5>
                        <div class="text-center mt-2">
                            <img src="/images/visual_data.svg" alt="" height="70">
                        </div>
                        <p class="mb-0 text-muted">Данные отсутствуют</span></p>
                    </div>
                </div>
            </div>
            <div class="col-xl col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right bg-info text-white widget-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h5 class="text-muted mt-0">Давление</h5>
                        <div class="text-center mt-2">
                            <img src="/images/visual_data.svg" alt="" height="70">
                        </div>
                        <p class="mb-0 text-muted">Данные отсутствуют</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8">
                <!--Карточка с таблицей задач на текущий день-->
                <div class="card mt-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-notes-medical mr-2"></i>Задачи на сегодня</div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="text-center mt-2">
                                    <img src="/images/no_data.svg" alt="" height="170">
                                    <h5 class="mt-4 text-danger"><b>Задачи отсутствуют</b></h5>
                                    <p class="text-muted mb-0">Запишитесь на услугу или посетите терапевта</p>
                                    <a href="#" class="btn text-white btn-sm" style="background-color: var(--cyan-color)">Услуги</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-centered table-striped table-hover mb-0">
                                <tbody>
                                <tr>
                                    <td>
                                        <h5 class="my-1" style="color: var(--dark-cyan-color)">Посетить врача</h5>
                                        <span class="text-muted">Терапевт</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">Статус</span> <br>
                                        <span class="badge badge-pill text-white" style="background-color: var(--cyan-color)">Ожидание</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">Специалист</span>
                                        <h5>Иванов И. И.</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted">До начала</span>
                                        <h5>3ч 20мин</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="my-1" style="color: var(--dark-cyan-color)">Посетить процедуру</h5>
                                        <span class="text-muted">Бассейн</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">Статус</span> <br>
                                        <span class="badge badge-pill badge-danger">Не посещено</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">Специалист</span>
                                        <h5>Иванов И. И.</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted">До начала</span>
                                        <h5>-</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="my-1" style="color: var(--dark-cyan-color)">Посетить мероприятие</h5>
                                        <span class="text-muted">Экскурсия по зоопарку</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">Статус</span> <br>
                                        <span class="badge badge-pill badge-success">Посещено</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">Специалист</span>
                                        <h5>Иванов И. И.</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted">До начала</span>
                                        <h5>-</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="my-1" style="color: var(--dark-cyan-color)">Принять лекарство</h5>
                                        <span class="text-muted">Магнелис B6</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">Доза</span> <br>
                                        <h5>200 мг</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted">Правило приема</span>
                                        <h5>До еды</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted">До начала</span>
                                        <h5>5ч 8мин</h5>
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


    /**
    Временный скрипт отображения графика "пончик" для шагов пациента
     */
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Пройдено шагов', 'Осталось пройти шагов'],
            datasets: [{
                data: [7000, 3000],
                backgroundColor: [
                    'rgb(0, 112, 96)',
                    'rgb(255, 164, 0)',
                ],
            }]
        },
        options: {
            cutout: '80%',
            radius: '50%',
            plugins: {
                legend: false,
            },
        }
    });
</script>
</html>