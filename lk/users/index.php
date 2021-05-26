<?php
if(!isset($_COOKIE['user_token']))
    header("Location: /error/401.php");
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";
$user = new User($_COOKIE['user_token']);
if($user->getUserStatusCode() === 400 || $user->getUserStatusCode() === 403) {
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.php");
}
if(!$user->isUserRole("Admin"))
    header("Location: /error/403.php");

$user_data = $user->getUserData();
$whose_user = 1;
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
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/js/datatables.js"></script>
    <script defer src="/js/all.js"></script>
    <title><? echo web_name_header; ?></title>
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
                <li class="breadcrumb-item active" aria-current="page">Пользователи</li>
            </ol>
        </nav>
        <ul class="nav nav-pills flex-column flex-sm-row mb-2" role="tablist">
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold active" data-toggle="tab" href="#patient" role="tab">
                    <i class="fas fa-user-injured mr-1"></i>Пациенты
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#doctor" role="tab">
                    <i class="fas fa-user-md mr-1"></i> Медицинский персонал
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#admin" role="tab">
                    <i class="fas fa-user-cog mr-1"></i> Администраторы
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="patient" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <a href="/lk/users/add.php?selected=patient" class="btn btn-sm btn-success float-right text-white mb-2">
                            <i class="fas fa-plus-circle mr-2"></i>Зарегистрировать пациента
                        </a>
                        <table id="table_patients" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Пациент</th>
                                <th>ID карты</th>
                                <th>Категория</th>
                                <th>Почта</th>
                                <th>Телефон</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Пац.-т:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Шамсемухаметов И. И.</td>
                                <td class="text-muted" data-label="ID карты:">123456789</td>
                                <td class="text-muted" data-label="Тип:"><span class="badge badge-pill text-white" style="background-color: var(--dark-cyan-color)">Лечащийся</span></td>
                                <td class="text-muted" data-label="Почта:">info@mail.ru</td>
                                <td class="text-muted" data-label="Телефон:">+7 (999) 999-99-99</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm btn-secondary text-white" data-toggle="modal" data-target="#openModalRecoveryPasswordUser">Восстановить пароль</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)">Профиль</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveUser">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Пац.-т:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td class="text-muted" data-label="ID карты:">123456789</td>
                                <td class="text-muted" data-label="Тип:"><span class="badge badge-pill text-muted" style="background-color: var(--yellow-color)">Отдыхающий</span></td>
                                <td class="text-muted" data-label="Почта:">info@mail.ru</td>
                                <td class="text-muted" data-label="Телефон:">+7 (999) 999-99-99</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm btn-secondary text-white" data-toggle="modal" data-target="#openModalRecoveryPasswordUser">Восстановить пароль</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)">Профиль</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveUser">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Пац.-т:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td class="text-muted" data-label="ID карты:">123456789</td>
                                <td class="text-muted" data-label="Тип:"><span class="badge badge-pill badge-danger">Выписан</span></td>
                                <td class="text-muted" data-label="Почта:">info@mail.ru</td>
                                <td class="text-muted" data-label="Телефон:">+7 (999) 999-99-99</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm btn-secondary text-white" data-toggle="modal" data-target="#openModalRecoveryAccessPatient">Восстановить доступ</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)">Профиль</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveUser">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Пациент</th>
                                <th>ID карты</th>
                                <th>Категория</th>
                                <th>Почта</th>
                                <th>Телефон</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="doctor" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <a href="/lk/users/add.php?selected=doctor" class="btn btn-sm btn-success float-right text-white mb-2">
                            <i class="fas fa-plus-circle mr-2"></i>Зарегистрировать медперсонал
                        </a>
                        <table id="table_doctors" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Специалист</th>
                                <th>Должность</th>
                                <th>Направление</th>
                                <th>Почта</th>
                                <th>Телефон</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Пац.-т:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td class="text-muted" data-label="Долж.-ть:">Врач</td>
                                <td class="text-muted" data-label="Напр.-ие:">
                                    <ul class="list-unstyled">
                                        <li><span class="badge badge-pill badge-secondary">Терапевт</span></li>
                                        <li><span class="badge badge-pill badge-secondary">Невролог</span></li>
                                    </ul>
                                </td>
                                <td class="text-muted" data-label="Почта:">info@mail.ru</td>
                                <td class="text-muted" data-label="Телефон:">+7 (999) 999-99-99</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm btn-secondary text-white" data-toggle="modal" data-target="#openModalRecoveryPasswordUser">Восстановить пароль</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)">Профиль</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveUser">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted" data-label="Пац.-т:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td class="text-muted" data-label="Долж.-ть:">Специалист по процедурам</td>
                                <td class="text-muted" data-label="Напр.-ие:">
                                    <ul class="list-unstyled">
                                        <li><span class="badge badge-pill badge-secondary">Бассейн</span></li>
                                        <li><span class="badge badge-pill badge-secondary">Йога</span></li>
                                    </ul>
                                </td>
                                <td class="text-muted" data-label="Почта:">info@mail.ru</td>
                                <td class="text-muted" data-label="Телефон:">+7 (999) 999-99-99</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm btn-secondary text-white" data-toggle="modal" data-target="#openModalRecoveryPasswordUser">Восстановить пароль</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)">Профиль</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveUser">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Пациент</th>
                                <th>ID карты</th>
                                <th>Тип</th>
                                <th>Почта</th>
                                <th>Телефон</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="admin" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <a href="/lk/users/add.php?selected=administrator" class="btn btn-sm btn-success float-right text-white mb-2">
                            <i class="fas fa-plus-circle mr-2"></i>Зарегистрировать администратора
                        </a>
                        <table id="table_administrators" class="table table-striped table-hover">
                            <thead class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Администратор</th>
                                <th>Должность</th>
                                <th>Почта</th>
                                <th>Телефон</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-muted" data-label="Пац.-т:"><img src="/images/user.png" height="30" class="rounded-circle" alt="...">  Иванов И. И.</td>
                                <td class="text-muted" data-label="Долж.-ть:">Главный админ</td>
                                <td class="text-muted" data-label="Почта:">info@mail.ru</td>
                                <td class="text-muted" data-label="Телефон:">+7 (999) 999-99-99</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li><button type="button" class="btn mt-1 btn-sm btn-secondary text-white" data-toggle="modal" data-target="#openModalRecoveryPasswordUser">Восстановить пароль</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm text-white" style="background-color: var(--cyan-color)">Профиль</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-warning text-secondary" style="background-color: var(--yellow-color)">Редактирование</button></li>
                                        <li><button type="button" class="btn mt-1 btn-sm btn-danger" data-toggle="modal" data-target="#openModalRemoveUser">Удаление</button></li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="text-white" style="background-color: var(--cyan-color);">
                            <tr>
                                <th>Администратор</th>
                                <th>Должность</th>
                                <th>Почта</th>
                                <th>Телефон</th>
                                <th>Действие</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Модальное окно удаления пользователя-->
<div class="modal fade" tabindex="-1" id="openModalRemoveUser" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    Вы уверены, что хотите удалить данного пользователя?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Нет</button>
                <form id="queryDeleteUserProfile">
                    <input type="hidden">
                    <button type="submit" class="btn btn-success" name="user_email" value="mail@mail.ru">Да</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно восстановления пароля пользователя-->
<div class="modal fade" tabindex="-1" id="openModalRecoveryPasswordUser" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    Пользователю <b>Иванов И. И.</b> будет отправлена ссылка восстановления пароля на его почту. Вы согласны?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Нет</button>
                <form id="queryRecoveryPasswordUser">
                    <input type="hidden" name="user_email" value="mail@mail.ru">
                    <button type="submit" class="btn btn-success">Да</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно восстановления доступа пользователя после его повторного приезда-->
<div class="modal fade" tabindex="-1" id="openModalRecoveryAccessPatient" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Восстановление доступа</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Пользователь <b>Иванов И. И.</b> повторно приехал в санаторий? Выберите его категорию
                </div>
                <form id="queryRecoveryAccessPatient" method="post" action="/queries/admin/recoveryAccessPatient.php">
                    <label style="color: var(--yellow-color)">Категория пациента</label><br>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="radio_box_healing" name="patient_category" value="healing" class="custom-control-input" checked>
                        <label class="custom-control-label" for="radio_box_healing">Лечащийся</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="radio_box_resting" name="patient_category" value="resting" class="custom-control-input">
                        <label class="custom-control-label" for="radio_box_resting">Отдыхающий</label>
                    </div>
                </form>
                <div class="alert alert-success mt-3" role="alert" style="font-size: 12px" id="alertSuccessRecoveryAccessPatient" hidden>
                    Пользователю на почту отправлено сообщение с восстановлением пароля к профилю!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Нет</button>
                <button type="submit" class="btn btn-success" form="queryRecoveryAccessPatient">Да</button>
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

    $('#table_patients, #table_doctors, #table_administrators').DataTable({
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
<script>
    $("#queryDeleteUserProfile").submit(function () {
        $.ajax({
            url: "/queries/admin/deleteUserProfile.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#openModalRemoveUser").modal('hide');
            },
            error: function () {

            }
        });
        return false;
    });

    $("#queryRecoveryPasswordUser").submit(function () {
        $.ajax({
            url: "/queries/recoveryPasswordUser.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#openModalRecoveryPasswordUser").modal('hide');
            },
            error: function () {

            }
        });
        return false;
    });

    $("#queryRecoveryAccessPatient").submit(function () {
        $.ajax({
            url: "/queries/admin/recoveryAccessPatient.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $('#alertSuccessRecoveryAccessPatient').removeAttr("hidden");
                $('#queryRecoveryAccessPatient').attr("hidden", "hidden");
                $('#queryRecoveryAccessPatient').prev().attr("hidden", "hidden");
                $('#queryRecoveryAccessPatient').parent().next().attr("hidden", "hidden");
                setTimeout(function(){ $("#openModalRecoveryAccessPatient").modal('hide');}, 3000);
            },
            error: function () {

            }
        });
        return false;
    });
</script>
</html>
