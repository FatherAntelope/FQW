<?php
// Если токен авторизованного пользователя не существует, то направляет на страницу ошибки 401 (нет авторизации)
if(!isset($_COOKIE['user_token']))
    header("Location: /error/401.php");
require $_SERVER['DOCUMENT_ROOT'] . '/utils/variables.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . "/utils/User.php";

// Выгрузка данных пользователя
$user = new User($_COOKIE['user_token']);

// Если HTTP-код после обращения к выгрузке данных пользователя по API 400 или 403, то ...
if($user->getStatusCode() === 400 || $user->getStatusCode() === 403) {
    setcookie('user_token', '', 0, "/");
    header("Location: /error/401.php");
}
// Если роль пользователя не "Доктор", то направляет на страницу ошибки 403
if(!$user->isUserRole("Admin"))
    header("Location: /error/403.php");

// Выгружает данные пользователя
$user_data = $user->getData();
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
    <link rel="stylesheet" href="/css/chosen.min.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script type="text/javascript" charset="utf8" src="/js/datatables.js"></script>
    <script src="/js/chosen.js"></script>
    <script defer src="/js/all.js"></script>
    <title><? echo web_name_header; ?></title>
</head>
<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT'] . "/header.php"; ?>

<!--Основной контент страницы-->
<div class="page-content">
    <div class="container pt-3 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/lk" style="color: var(--dark-cyan-color)">Профиль</a></li>
                <li class="breadcrumb-item"><a href="/lk/patients" style="color: var(--dark-cyan-color)">Пациенты</a></li>
                <li class="breadcrumb-item"><a href="#" style="color: var(--dark-cyan-color)">Иванов И. И. (1234)</a></li>
                <li class="breadcrumb-item"><a href="#" style="color: var(--dark-cyan-color)">Медкарта</a></li>
                <li class="breadcrumb-item active" aria-current="page">Добавление эпикриза</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <form>
                    <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                        <i class="fas fa-disease mr-1"></i>
                        Диагнозы
                    </h5>

                    <div class="alert alert-info">Правильно вносите МКБ и описывайте каждый диагноз</div>
                    <table class="table table-sm table-borderless information_json">
                        <tr class="information_json_plus">
                            <td class="pl-0">
                                                <span class="btn btn-sm btn-success rounded-circle plus-disease">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                            </td>
                            <td class="pl-0"></td>
                        </tr>
                    </table>


                    <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Состояние
                    </h5>
                    <div class="form-group">
                        <label style="color: var(--yellow-color)">Жалобы  <strong style="color: var(--red--color)">*</strong></label>
                        <textarea class="form-control" placeholder="Напишите все жалобы пациента, если их нет то напишите 'отсутствуют'" minlength="11" maxlength="5000"></textarea>
                    </div>
                    <div class="form-group">
                        <label style="color: var(--yellow-color)">Анамнез  <strong style="color: var(--red--color)">*</strong></label>
                        <textarea class="form-control" placeholder="Напишите полученные сведения от пациента" minlength="11" maxlength="7000"></textarea>
                    </div>

                    <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                        <i class="fas fa-pills mr-1"></i>
                        Лекарства
                    </h5>
                    <div class="alert alert-info">
                        Указания:
                        <ul>
                            <li>Доза - сколько пациенту необходимо принять за раз. Например: 1/2 таб., 1 таб., 10 капель, 30 мг.</li>
                            <li>Правило приема - как нужно принимать лекарства</li>
                            <li>Повторы - сколько раз нужно принять лекарство за сутки. Любое число от 1 - раз в день</li>
                            <li>Период - сколько дней принимается лекарство</li>
                        </ul>
                    </div>
                    <table class="table table-sm table-borderless information_json">
                        <tr class="information_json_plus">
                            <td class="pl-0">
                                                <span class="btn btn-sm btn-success rounded-circle plus-pills">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                            </td>
                            <td class="pl-0"></td>
                        </tr>
                    </table>

                    <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                        <i class="fas fa-clipboard mr-1"></i>
                        Рекомендации
                    </h5>
                    <div class="alert alert-info">
                        Указания:
                        <ul>
                            <li>Период - сколько дней подряд выполнять рекомендацию. -1 - ежедневно, 0 - по желанию, любое число от 1 - дней подряд</li>
                        </ul>
                        Прочие указания - ваши собственные указания. Например: выпить 3 литра воды, спать по 8 часов в день.
                    </div>

                            <label style="color: var(--yellow-color)">Процедуры</label>
                            <table class="table table-sm table-borderless information_json">
                                <tr class="information_json_plus">
                                    <td class="pl-0">
                                                <span class="btn btn-sm btn-success rounded-circle plus-procedure-recommendations">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                    </td>
                                    <td class="pl-0"></td>
                                </tr>
                            </table>

                            <label style="color: var(--yellow-color)">Самоконтроль</label>
                            <table class="table table-sm table-borderless information_json">
                                <tr class="information_json_plus">
                                    <td class="pl-0">
                                                <span class="btn btn-sm btn-success rounded-circle plus-self-control-recommendations">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                    </td>
                                    <td class="pl-0"></td>
                                </tr>
                            </table>

                            <label style="color: var(--yellow-color)">Прочее</label>
                            <table class="table table-sm table-borderless information_json">
                                <tr class="information_json_plus">
                                    <td class="pl-0">
                                                <span class="btn btn-sm btn-success rounded-circle plus-other-recommendations">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                    </td>
                                    <td class="pl-0"></td>
                                </tr>
                            </table>
                    <div class="text-right">
                        <button type="submit" class="btn mb-3 text-white" style="background-color: var(--cyan-color)">Добавить<i class="fas fa-notes-medical ml-2"></i></button>
                    </div>
                </form>
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
<?php require $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>

</body>
<script>
    $('#notificationToast').toast('show');


    $(document).on('click', '.plus-disease', function(){
        $(this).closest('.information_json_plus').before(
            '<tr>' +
            '<td style="min-width: 15rem !important;" class="pl-0">' +
            '<select name="disease_type[]" class="form-control form-control-chosen-required" data-placeholder="Тип" required>' +
            '<option></option>' +
            '<option value="0">Основной</option>' +
            '<option value="1">Сопутствующий</option>' +
            '</select>' +
            '</td>' +
            '<td class="pl-0"><input type="text" class="form-control disease-mkb" name=disease_mkb" placeholder="МКБ" required></td>' +
            '<td class="pl-0"><input type="text" class="form-control" name=disease_description[]" minlength="20" maxlength="500" placeholder="Описание" required></td>' +
            '<td class="pl-0"><span class="btn btn-sm btn-danger rounded-circle minus mt-1"><i class="fas fa-minus"></i></span></td>' +
            '</tr>'
        );
        $('select[name="disease_type[]"]').chosen();
        $('.disease-mkb').mask('***-***');
    });

    $(document).on('click', '.plus-pills', function(){
        $(this).closest('.information_json_plus').before(
            '<tr>' +
            '<td class="pl-0"><input type="text" class="form-control" name="pill_name_json_val[]" minlength="2" maxlength="30" placeholder="Название" required></td>' +
            '<td class="pl-0"><input type="text" class="form-control" name="pill_name_json_val[]" minlength="2" maxlength="30" placeholder="Доза" required></td>' +
            '<td class="pl-0">' +
            '<select name="pill_rule_take_json_val[]" class="form-control form-control-chosen-required" data-placeholder="Правило приема" required>' +
            '<option></option>' +
            '<option value="0">До еды</option>' +
            '<option value="1">Во время еды</option>' +
            '<option value="2">После еды</option>' +
            '<option value="3">Натощак</option>' +
            '</select>' +
            '<td class="pl-0"><input type="number" min="1" max="1000" class="form-control" name="pill_name_json_val[]" placeholder="Повторы" required></td>' +
            '</td>' +
            '<td class="pl-0"><input type="number" min="1" max="1000" class="form-control" name="pill_period_json_val[]" placeholder="Период" required></td>' +
            '<td class="pl-0"><span class="btn btn-sm btn-danger rounded-circle minus mt-1"><i class="fas fa-minus"></i></span></td>' +
            '</tr>'
        );
        $('select[name="pill_rule_take_json_val[]"]').chosen();
    });

    $(document).on('click', '.plus-procedure-recommendations', function(){
        $(this).closest('.information_json_plus').before(
            '<tr>' +
            '<td class="pl-0">' +
            '<select name="procedure_recommendations_name_json_val[]" class="form-control form-control-chosen-required" data-placeholder="Процедура" required>' +
            '<option></option>' +
            '<option value="0">Процедура1</option>' +
            '<option value="1">Процедура2</option>' +
            '</select>' +
            '</td>' +
            '<td class="pl-0">' +
            '<select name="procedure_recommendations_type_json_val[]" class="form-control form-control-chosen-required" data-placeholder="Тип" required>' +
            '<option></option>' +
            '<option value="0">Обязательно</option>' +
            '<option value="1">Дополнительно</option>' +
            '</select>' +
            '</td>' +
            '<td class="pl-0" style="max-width: 3.5em"><input type="number" min="-1" max="1000" class="form-control" name="procedure_recommendations_period_json_val[]" placeholder="Период" required></td>' +
            '<td class="pl-0"><span class="btn btn-sm btn-danger rounded-circle minus mt-1"><i class="fas fa-minus"></i></span></td>' +
            '</tr>'
        );
        $('select[name="procedure_recommendations_name_json_val[]"]').chosen();
        $('select[name="procedure_recommendations_type_json_val[]"]').chosen();
    });

    $(document).on('click', '.plus-self-control-recommendations', function(){
        $(this).closest('.information_json_plus').before(
            '<tr>' +
            '<td class="pl-0">' +
            '<select name="self_control_recommendations_name_json_val[]" class="form-control form-control-chosen-required" data-placeholder="Самоконтроль" required>' +
            '<option></option>' +
            '<option value="0">Шаги 3000</option>' +
            '<option value="1">Прогулка 30 мин.</option>' +
            '</select>' +
            '</td>' +
            '<td class="pl-0">' +
            '<select name="self_control_recommendations_type_json_val[]" class="form-control form-control-chosen-required" data-placeholder="Тип" required>' +
            '<option></option>' +
            '<option value="0">Обязательно</option>' +
            '<option value="1">Дополнительно</option>' +
            '</select>' +
            '</td>' +
            '<td class="pl-0" style="max-width: 3.5em"><input type="number" min="-1" max="1000" class="form-control" name="self_control_recommendations_period_json_val[]" placeholder="Период" required></td>' +
            '<td class="pl-0"><span class="btn btn-sm btn-danger rounded-circle minus mt-1"><i class="fas fa-minus"></i></span></td>' +
            '</tr>'
        );
        $('select[name="self_control_recommendations_name_json_val[]"]').chosen();
        $('select[name="self_control_recommendations_type_json_val[]"]').chosen();
    });

    $(document).on('click', '.plus-other-recommendations', function(){
        $(this).closest('.information_json_plus').before(
            '<tr>' +
            '<td class="pl-0"><input type="text" class="form-control" name="other_recommendations_name_json_val[]" minlength="20" maxlength="200" placeholder="Прочая рекомендация" required></td>' +
            '<td class="pl-0">' +
            '<select name="other_recommendations_type_json_val[]" class="form-control form-control-chosen-required" data-placeholder="Тип" required>' +
            '<option></option>' +
            '<option value="0">Обязательно</option>' +
            '<option value="1">Дополнительно</option>' +
            '</select>' +
            '</td>' +
            '<td class="pl-0" style="max-width: 3.5em"><input type="number" min="-1" max="1000" class="form-control" name="other_recommendations_period_json_val[]" placeholder="Период" required></td>' +
            '<td class="pl-0"><span class="btn btn-sm btn-danger rounded-circle minus mt-1"><i class="fas fa-minus"></i></span></td>' +
            '</tr>'
        );
        $('select[name="other_recommendations_type_json_val[]"]').chosen();
    });

    $(document).on('click', '.minus', function(){
        $(this).closest('tr').remove();
    });
</script>
</html>