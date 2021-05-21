<?php
$user_data = $user_data;
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 text-center">
                        <img src="/images/user.png" class="img-thumbnail rounded-circle mb-2" width="120" alt="">
                        <br>
                        <a href="/lk/settings/" type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)"><i class="fas fa-user-cog"></i></a>
                        <a href="/queries/exitUser.php" type="button" class="btn mt-1 btn-sm btn-danger text-white"><i class="fas fa-door-open"></i></a>
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-bold" style="color: var(--dark-cyan-color)">
                                    <?php echo $user_data->data['user']['surname']." ".$user_data->data['user']['name']." ".$user_data->data['user']['patronymic'];?>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <h5 class="text-muted">Должность: главный администратор</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-top: 3px solid var(--yellow-color);">

                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-around flex-xl-row flex-md-row flex-sm-column flex-column">
                        <a href="tel:<?php echo $user_data->data['user']['phone_number'];?>" aria-haspopup="true" style="text-decoration: none; color: var(--yellow-color)">
                            <h5 class="font-weight-bold"><i class="fas fa-phone mr-1"></i> <?php echo $user_data->data['user']['phone_number'];?></h5>
                        </a>
                        <a href="mailto:<?php echo $user_data->data['user']['email'];?>" aria-haspopup="true" style="text-decoration: none; color: var(--yellow-color)">
                            <h5 class="font-weight-bold"><i class="fas fa-envelope-open-text mr-1"></i><?php echo $user_data->data['user']['email'];?></h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-xl-6 col-md-6 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right text-white widget-icon" style="background-color: var(--dark-cyan-color)">
                                    <i class="fas fa-user-injured"></i>
                                </div>
                                <h5 class="text-muted mt-0">Лечащиеся</h5>
                                <h3 class="mt-3 mb-3" style="color: var(--dark-cyan-color)">50</h3>
                                <p class="mb-0 text-danger">
                                    <i class="fas fa-arrow-alt-circle-down"></i> 20%
                                </p>
                                <p class="mb-0 text-muted">Ниже прошлого месяца</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right text-secondary widget-icon" style="background-color: var(--yellow-color)">
                                    <i class="fas fa-user-injured"></i>
                                </div>
                                <h5 class="text-muted mt-0">Отдыхающие</h5>
                                <h3 class="mt-3 mb-3" style="color: var(--dark-cyan-color)">90</h3>
                                <p class="mb-0 text-success">
                                    <i class="fas fa-arrow-alt-circle-up"></i> 10%
                                </p>
                                <p class="mb-0 text-muted">Выше прошлого месяца</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right bg-secondary text-white widget-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <h5 class="text-muted mt-0">Медперсонал</h5>
                                <h6 class="mt-1" style="color: var(--dark-cyan-color)">Врач: 10</h6>
                                <h6 class="mt-1" style="color: var(--dark-cyan-color)">Спец. по процедурам: 15</h6>
                                <h6 class="mt-1" style="color: var(--dark-cyan-color)">Спец. по обследованиям: 5</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right bg-secondary text-white widget-icon">
                                    <i class="fas fa-user-cog"></i>
                                </div>
                                <h5 class="text-muted mt-0">Администраторы</h5>
                                <h6 class="mt-1" style="color: var(--dark-cyan-color)">Главный: 2</h6>
                                <h6 class="mt-1" style="color: var(--dark-cyan-color)">Регистратор: 7</h6>
                                <h6 class="mt-1" style="color: var(--dark-cyan-color)">Управляющий: 5</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card mt-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-chart-bar mr-2"></i>Количество пациентов в месяц</div>
                    </div>
                    <div class="card-body">
                        <canvas id="chart_patients" height="157"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card mt-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-chart-pie mr-2"></i>Мониторинг услуг санатория</div>
                    </div>
                    <div class="card-body">
                        <canvas id="chart_services"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mt-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-chart-line mr-2"></i>Доход за текущий месяц</div>
                    </div>
                    <div class="card-body">
                        <canvas id="chart_profit" height="134"></canvas>
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
<script>

    const footer = (tooltipItems) => {
        let sum = 0;

        tooltipItems.forEach(function(tooltipItem) {
            sum += tooltipItem.parsed.y;
        });
        return 'Всего: ' + sum;
    };

    let chart_patients = new Chart(document.getElementById('chart_patients').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Январь', 'Февраль', 'Март'],
            datasets: [
                {
                    label: 'Лечащиеся',
                    data: [40, 70, 50],
                    backgroundColor: 'rgb(0,112,96)',
                    borderColor: 'rgb(0, 112, 96)',
                    borderWidth: 1
                },
                {
                    label: 'Отдыхающие',
                    data: [70, 80, 90],
                    backgroundColor: 'rgb(255, 164, 0)',
                    borderColor: 'rgb(255, 164, 0)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        footer: footer,
                    }
                }
            }
        }
    });

    let chart_services = new Chart(document.getElementById('chart_services').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Специальности', 'Процедуры', 'Обследования', 'Мероприятия'],
            datasets: [{
                data: [15, 15, 10, 5],
                backgroundColor: [
                    'rgb(92,129,238)',
                    'rgb(226,37,81)',
                    'rgb(0,247,255)',
                    'rgb(46,168,96)',
                ],
            }]
        },
        options: {
            cutout: '60%'
        },
    });

    let chart_profit = new Chart(document.getElementById('chart_profit').getContext('2d'), {
        type: 'line',
        data: {
            labels: ['21.04', '22.04', '23.04', '24.04'],
            datasets: [{
                data: [32000, 33000, 38000, 36000],
                backgroundColor: 'rgb(0,112,96)',
                borderColor: 'rgb(255, 164, 0)',
            }]
        },
        options: {
            plugins: {
                legend: false
            }

        },
    });
</script>
</html>