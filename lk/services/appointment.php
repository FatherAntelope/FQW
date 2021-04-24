<?php
$whose_user = 2;
$getSelected = $_GET['selected'];
if($getSelected != "doctors" &&
    $getSelected != "procedures" &&
    $getSelected != "examinations" &&
    $getSelected != "events") {
    header("Location: /lk/services/");
    exit;
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
    <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/js/datatables.js"></script>
    <script defer src="/js/all.js"></script>
    <title>СанКонтроль</title>
</head>
<style>
 .form-control-sm option:link {
     background-color: var(--cyan-color) !important;
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
                <li class="breadcrumb-item"><a href="#" style="color: var(--dark-cyan-color)">Профиль</a></li>
                <li class="breadcrumb-item"><a href="/lk/services/" style="color: var(--dark-cyan-color)">Услуги</a></li>
                <li class="breadcrumb-item active" aria-current="page">Запись на услуги</li>
            </ol>
        </nav>
        <ul class="nav nav-pills flex-column flex-sm-row mb-2" role="tablist">
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <? if($getSelected == 'doctors') echo "active";?>" onclick="window.history.pushState('', '', '/lk/services/appointment.php?selected=doctors');" data-toggle="tab" href="#tab-doctors" role="tab">
                    <i class="fas fa-user-md mr-2"></i>Врачи
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <? if($getSelected == 'procedures') echo "active";?>" onclick="window.history.pushState('', '', '/lk/services/appointment.php?selected=procedures');" data-toggle="tab" href="#tab-procedures" role="tab">
                    <i class="fas fa-diagnoses mr-2"></i>Процедуры
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <? if($getSelected == 'examinations') echo "active";?>" onclick="window.history.pushState('', '', '/lk/services/appointment.php?selected=examinations');" data-toggle="tab" href="#tab-examinations" role="tab">
                    <i class="fas fa-microscope mr-1"></i>Обследования
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold <? if($getSelected == 'events') echo "active";?>" onclick="window.history.pushState('', '', '/lk/services/appointment.php?selected=events');" data-toggle="tab" href="#tab-events" role="tab">
                    <i class="fas fa-walking mr-1"></i>Мероприятия
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show <? if($getSelected == 'doctors') echo "active";?>" id="tab-doctors" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_doctors" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Врач</th>
                                <th>Специальность</th>
                                <th>Расположение</th>
                                <th>Разрешение</th>
                                <th>Цена, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Врач:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td class="text-muted" data-label="Спец.-ть:">
                                    Терапевт
                                </td>
                                <td class="text-muted" data-label="Расп.-ие:">505 каб.</td>
                                <td class="text-muted" data-label="Раз.-ие:"><span class="badge badge-pill badge-success">Дополнительно</span></td>
                                <td class="text-muted" data-label="Цена, р.:">500</td>
                                <td><button type="button" class="btn btn-sm btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)">Запись</button></td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Врач:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Николаев И. И.</td>
                                <td class="text-muted" data-label="Спец.-ть:">
                                    Оториноларинголог
                                </td>
                                <td class="text-muted" data-label="Расп.-ие:">302 каб.</td>
                                <td class="text-muted" data-label="Раз.-ие:"><span class="badge badge-pill badge-danger">Обязательно</span></td>
                                <td class="text-muted" data-label="Цена, р.:">700</td>
                                <td><button type="button" class="btn btn-sm btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)">Запись</button></td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Врач</th>
                                <th>Специальность</th>
                                <th>Расположение</th>
                                <th>Разрешение</th>
                                <th>Цена, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show <? if($getSelected == 'procedures') echo "active";?>" id="tab-procedures" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_procedures" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Специалист</th>
                                <th>Процедура</th>
                                <th>Расположение</th>
                                <th>Разрешение</th>
                                <th>Цена, руб.</th>
                                <th>Повторы</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Сп.-ист:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td class="text-muted" data-label="Спец.-ть:">Бассейн</td>
                                <td class="text-muted" data-label="Расп.-ие:">105 каб.</td>
                                <td class="text-muted" data-label="Раз.-ие:"><span class="badge badge-pill badge-success">Дополнительно</span></td>
                                <td class="text-muted" data-label="Цена, р.:">550</td>
                                <td class="text-muted" data-label="Повторов:">–</td>
                                <td><a href="#" type="button" class="btn btn-sm btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)">Запись</a></td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Сп.-ист:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Николаев И. И.</td>
                                <td class="text-muted" data-label="Спец.-ть:">Мануальная терапия</td>
                                <td class="text-muted" data-label="Расп.-ие:">108 каб.</td>
                                <td class="text-muted" data-label="Раз.-ие:"><span class="badge badge-pill badge-danger">Обязательно</span></td>
                                <td class="text-muted" data-label="Цена, р.:">750</td>
                                <td class="text-muted" data-label="Повторов:">10</td>
                                <td><a href="#" type="button" class="btn btn-sm btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)">Запись</a></td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Специалист</th>
                                <th>Процедура</th>
                                <th>Расположение</th>
                                <th>Разрешение</th>
                                <th>Цена, руб.</th>
                                <th>Повторов</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show <? if($getSelected == 'examinations') echo "active";?>" id="tab-examinations" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <table id="table_examinations" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Специалист</th>
                                <th>Обследование</th>
                                <th>Расположение</th>
                                <th>Цена, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Сп.-ист:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td class="text-muted" data-label="Спец.-ть:">ОАК</td>
                                <td class="text-muted" data-label="Расп.-ие:">105 каб.</td>
                                <td class="text-muted" data-label="Цена, р.:">550</td>
                                <td><a href="#" type="button" class="btn btn-sm btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)">Запись</a></td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Сп.-ист:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Николаев И. И.</td>
                                <td class="text-muted" data-label="Спец.-ть:">ОАМ</td>
                                <td class="text-muted" data-label="Расп.-ие:">108 каб.</td>
                                <td class="text-muted" data-label="Цена, р.:">750</td>
                                <td><a href="#" type="button" class="btn btn-sm btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)">Запись</a></td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Специалист</th>
                                <th>Обследование</th>
                                <th>Расположение</th>
                                <th>Цена, руб.</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show <? if($getSelected == 'events') echo "active";?>" id="tab-events" role="tabpanel">
                4
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
$('#table_doctors, #table_procedures, #table_examinations').DataTable({
    "language": {
        "zeroRecords": "<span class='text-muted'>Услуги отсутствуют</span>",
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