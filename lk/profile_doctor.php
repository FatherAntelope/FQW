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
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 text-center">
                        <img src="/images/user.png" class="img-thumbnail rounded-circle mb-4" width="120" alt="">
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-bold" style="color: var(--dark-cyan-color)">Иванова Екатерина Ивановна</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="text-muted">Возраст: 45</h5>
                                <h5 class="text-muted">Должность: Врач / Специалист по процедурам / Специалист по обследованиям </h5>
                                <h5 class="text-muted">Квалификационная категория: Без категории / Первая / Вторая / Высшая</h5>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="text-muted">Стаж: 14 лет</h5>
                                <h5 class="text-muted">Специальность:</h5>
                                <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">Стоматолог</span>
                                <span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">Терапевт</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-top: 3px solid var(--yellow-color);">
                <div class="row">
                    <div class="col">
                        <h5 class="text-muted">Биография:</h5>
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
        <!--Карточки мониторинга-->
        <div class="row">
            <!--Карточка с информацией о своих пациентах-->
            <div class="col-xl-3 col-md-6 mt-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="float-right text-white widget-icon" style="background-color: var(--dark-cyan-color)">
                            <i class="fas fa-user-injured"></i>
                        </div>
                        <h5 class="text-muted mt-0">Мои пациенты</h5>
                        <h3 class="mt-3 mb-3" style="color: var(--dark-cyan-color)">15</h3>
                    </div>
                </div>
            </div>
            <!--Карточка с информацией дневниках самонаблюдения-->
            <div class="col-xl col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right bg-danger text-white widget-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h5 class="text-muted mt-0">Дневники самонаблюдения</h5>
                        <h3 class="mt-3 mb-3" style="color: var(--dark-cyan-color)">7</h3>
                        <p class="mb-0 text-danger">
                            <i class="fas fa-arrow-alt-circle-down"></i> 10.08%
                        </p>
                        <p class="mb-0 text-muted">Вам нужно проверить все дневники самонаблюдения своих пациентов за текущий день</span></p>
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
</script>
</html>