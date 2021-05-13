<?php
$whose_user = 3;
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
    <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/js/datatables.js"></script>
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
                <li class="breadcrumb-item"><a href="/lk/patients/" style="color: var(--dark-cyan-color)">Пациенты</a></li>
                <li class="breadcrumb-item active" aria-current="page">Иванов И. И.</li>
            </ol>
        </nav>
        <!--Карточка с основной информацией пациента-->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 text-center">
                        <img src="/images/user.png" class="img-thumbnail rounded-circle mb-2" width="120" alt="">
                        <br>
                        <button type="button" disabled class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)"><i class="fas fa-comments"></i></button>
                        <button type="button" class="btn mt-1 btn-sm btn-secondary text-white"><i class="fas fa-book-medical"></i></button>
                        <button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)"><i class="fas fa-heartbeat"></i></button>
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
                                <h5 class="text-muted">Категория: Лечащийся </h5>
                            </div>
                            <div class="col-lg-7">
                                <h5 class="text-muted">ID карты: 123456789</h5>
                                <h5 class="text-muted">Терапевт:
                                    <a href="#" style="color: var(--dark-cyan-color); text-decoration: none">Иванов И.И.</a>
                                    / <a href="#" data-toggle="modal" data-target="#openModalDetachingPatient" style="color: var(--red); text-decoration: none">Открепить</a>
                                    / Отсутствует
                                    <a href="#" data-toggle="modal" data-target="#openModalSecuringPatient" style="color: var(--red); text-decoration: none">Закрепить к себе</a>
                                </h5>
                                <h5 class="text-muted">Дата поступления: 01.01.1999</h5>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h5 class="text-muted">Группа пациента:</h5>
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
                    <div class="col">
                        <h5 class="text-muted">Субъективные жалобы:</h5>
                        <h6 class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda natus nemo quis sequi. Aut debitis deleniti id in possimus quidem, quo tempore tenetur! A cupiditate dicta dolore doloremque eius ex impedit laborum, libero, mollitia nam nemo optio praesentium qui quo reprehenderit similique totam. Ab delectus labore nihil. Deserunt, enim, vel!</h6>
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
                <hr style="border-top: 3px solid var(--yellow-color);">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center flex-xl-row flex-md-row flex-sm-column flex-column">
                        <a href="#" type="button" class="btn mt-1 text-white mr-xl-2 mr-md-2 mr-sm-0" style="background-color: var(--cyan-color)">Записать к себе</a>
                        <a href="#" type="button" class="btn mt-1 text-white mr-xl-2 mr-md-2" style="background-color: var(--cyan-color)">Записать на обследование</a>
                        <a href="#" type="button" class="btn mt-1 text-white" style="background-color: var(--cyan-color)">Записать к другому врачу</a>
                    </div>
                </div>
            </div>
        </div>

        <!--Карточка задач пациента-->
        <div class="card mt-3">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-notes-medical mr-2"></i>Список задач пациента</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_services_monitoring" class="table table-centered table-sm table-striped table-hover mb-0">
                        <thead class="text-white" style="background-color: var(--cyan-color);">
                        <tr>
                            <th>Задача</th>
                            <th>Статус</th>
                            <th>Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <h6 class="my-1" style="color: var(--dark-cyan-color)">Посетить врача</h6>
                                <span class="text-muted">Терапевт</span>
                            </td>
                            <td>
                                <span class="badge badge-pill text-white" style="background-color: var(--cyan-color)">Ожидание</span>
                            </td>
                            <td class="text-muted">
                                10.10.2020 21:00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6 class="my-1" style="color: var(--dark-cyan-color)">Посетить процедуру</h6>
                                <span class="text-muted">Бассейн</span>
                            </td>
                            <td>
                                <span class="badge badge-pill badge-danger">Не выполнено</span>
                            </td>
                            <td class="text-muted">
                                10.10.2020 20:30
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6 class="my-1" style="color: var(--dark-cyan-color)">Посетить мероприятие</h6>
                                <span class="text-muted">Экскурсия по зоопарку</span>
                            </td>
                            <td>
                                <span class="badge badge-pill badge-success">Выполнено</span>
                            </td>
                            <td class="text-muted">
                                10.10.2020 17:10
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6 class="my-1" style="color: var(--dark-cyan-color)">Принять лекарство</h6>
                                <span class="text-muted">Магнелис B6</span>
                            </td>
                            <td>
                                <span class="badge badge-pill badge-success">Выполнено</span>
                            </td>
                            <td class="text-muted">
                                10.10.2020 12:15
                            </td>
                        </tr>
                        </tbody>
                        <tfoot class="text-white" style="background-color: var(--cyan-color);">
                        <tr>
                            <th>Задача</th>
                            <th>Статус</th>
                            <th>Дата</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<!--Модальное окно закрепления к себе пациента-->
<div class="modal fade" tabindex="-1" id="openModalSecuringPatient">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" >
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    Вы уверены, что хотите закрепить пациента к себе?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Нет</button>
                <button type="button" class="btn btn-success">Да</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно отмены закрепления-->
<div class="modal fade" tabindex="-1" id="openModalDetachingPatient">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" >
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    Вы уверены, что хотите открепить пациента?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Нет</button>
                <button type="button" class="btn btn-success">Да</button>
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

    $('#table_services_monitoring').DataTable({
        "language": {
            "zeroRecords": "<span class='text-muted'>Совпадения отсутствуют</span>",
            "search": "<span class='text-muted' style='margin-right: 0.5rem; font-size: 1.3rem'>Поиск:</span>",
            "info": "<span class='text-muted'>Показан диапазон от _START_ до _END_ элементов</span>",
            "infoEmpty": "<span class='text-muted'>Услуги отсутствуют</span>",
            "infoFiltered": "<span class='text-muted'>(отфильтровано общих элементов - _MAX_)</span>",
            "lengthMenu": '<span class="text-muted" style="margin-right: 0.5rem; font-size: 1rem">Отобразить элементов: <\span>' +
                '<select class="form-control-sm">'+
                '<option value="5">5</option>'+
                '<option value="10">20</option>'+
                '<option value="20">20</option>'+
                '<option value="30">30</option>'+
                '<option value="-1">Все</option>'+
                '</select>',
            "loadingRecords": "Загрузка...",
            "processing": "Выполнение...",
            "paginate": {
                "next": "Вперед",
                "previous": "Назад"
            }
        },
    });
</script>
</html>