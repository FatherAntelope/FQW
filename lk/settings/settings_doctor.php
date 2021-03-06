<?php
// Если данные пользователя не выгружены или роль пользователя не "Доктор",
// то направляет на страницу ошибки 403 (нет доступа)
if(!isset($user_data) || $user_data['role'] !== "Doctor") {
    header("Location: /error/403.php");
}

// Получение данных медперсонала
$url = protocol."://".domain_name_api."/api/med/medpersona";
$config = [
    "method" => "GET",
    "token" => $_COOKIE['user_token']
];
$doctor_data = utils_call_api($url, $config);

// Получение данных об услугах медперсонала
$url = protocol . '://' . domain_name_api . '/api/med/medics/'.$doctor_data->data['id'].'/servicemedper';
$config = [
    'token' => $_COOKIE['user_token'],
    'method' => 'GET'
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
    <script src="//cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>
    <title><?php echo web_name_header; ?></title>
</head>
<style>

</style>
<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>

<!--Основной контент страницы-->
<div class="page-content">
    <div class="container pt-3 pb-3" style="min-height: 100vh">
<!--"Хлебные крошки" для ориентации и навигации по родительским страницам-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/lk/" style="color: var(--dark-cyan-color)">Профиль</a></li>
                <li class="breadcrumb-item active" aria-current="page">Настройки</li>
            </ol>
        </nav>
        <div class="row">
<!--Левая колонка с отображением имеющихся персональных данных, отображением фотографии, ее изменения и выхода из профиля-->
            <div class="col-xl-4 col-lg-5">
                <div class="card">
                    <div class="card-header text-center" style="background-color: var(--cyan-color">
                        <img src="<?php echo getUrlUserPhoto($user_data['photo']); ?>" class="rounded-circle img-thumbnail" style="object-fit: cover; height: 12rem;width: 12rem;">
                        <h4 class="mb-0 mt-2" style="color: var(--yellow-color)">
                            <?php echo $user_data['surname']." ".$user_data['name']." ".$user_data['patronymic'];?>
                        </h4>
                        <p class="mb-2 text-white" >Медперсонал</p>
                        <button data-toggle="modal" data-target="#openModalReplaceAvatar" class="btn btn-warning btn-sm text-white" style="background-color: var(--yellow-color)">
                            Изменить фото
                        </button>
                        <a href="/queries/exitUser.php" class="btn btn-danger btn-sm text-white" style="background-color: var(--red--color)">Выйти</a>
                    </div>
                    <div class="card-body">
                        <div class="text-left mt-1">
                            <h6 class="text-muted text-uppercase bg-light p-2"><i class="fas fa-address-book mr-1"></i>Основные данные</h6>
                            <p class="text-muted mb-1">
                                <strong>Возраст:</strong>
                                <span class="ml-2">
                                    <?php echo floor( (time() - strtotime($doctor_data->data['birth_date'])) /(60 * 60 * 24 * 365.25));?>
                                    (<?php echo date("d.m.Y", strtotime($doctor_data->data['birth_date']));?>)
                                </span>
                            </p>
                            <p class="text-muted mb-1">
                                <strong>Должность:</strong>
                                <span class="ml-2"><?php echo getDoctorPositionRu($doctor_data->data['position'])?></span>
                            </p>
                            <p class="text-muted mb-1">
                                <strong>Кв. категория:</strong>
                                <span class="ml-2"><?php echo getDoctorQualificationRu($doctor_data->data['qualification'])?></span>
                            </p>
                            <p class="text-muted mb-1">
                                <strong>Направление:</strong>
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
                            </p>
                            <p class="text-muted mb-1">
                                <strong>Стаж:</strong>
                                <span class="ml-2"><?php echo $doctor_data->data['experience']." ".getTextYear($doctor_data->data['experience'])?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
<!--Правая колонка с настройками-->
            <div class="col-xl-8 col-lg-7">
                <ul class="nav nav-pills flex-column flex-sm-row mb-2 mt-3 mt-xl-0 mt-lg-0" role="tablist">
                    <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                        <a class="nav-link tab-bg-active font-weight-bold active"  data-toggle="tab" href="#user_data_edit" role="tab">
                            <i class="fas fa-user-edit mr-1"></i> Редактирование данных
                        </a>
                    </li>
                    <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
                        <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#settings_system" role="tab">
                            <i class="fas fa-sliders-h mr-1"></i> Настройки системы
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
<!--Содержимое редактирования персональных данных-->
                    <div class="tab-pane fade show active" id="user_data_edit" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <form id="queryEditContactDataUser">
                                    <h6 class="mb-3 text-muted text-uppercase bg-light p-2"><i class="fas fa-address-book mr-1"></i>
                                        Контактные данные
                                        <div class="spinner-border spinner-border-sm float-right text-info" role="status" hidden>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <i class="fas fa-check float-right text-success animate slideIn" hidden></i>
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="color: var(--yellow-color)">Почта</label>
                                                <input type="email" class="form-control" placeholder="example@mail.ru" maxlength="50" name="user_email" onkeyup="checkContactData()" value="<?php echo $user_data['email'];?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="color: var(--yellow-color)">Номер телефона </label>
                                                <input type="tel" class="form-control" placeholder="+7 (999) 999-99-99" name="user_phone" onkeyup="checkContactData()" value="<?php echo $user_data['phone_number'];?>" required>
                                            </div>
                                        </div>
                                        <div class="col alert alert-danger alert-dismissible fade show animate slideIn mr-3 ml-3" role="alert" id="alertErrorUserEditContactData" style="font-size: 12px" hidden>
                                            Аккаунт с указанным адресом электронной почты уже существует, либо вы его ввели неверно. Измените или проверьте введенный адрес электронной почты!
                                            <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" id="btnEditContactDataUser" class="btn mb-3 text-white" style="background-color: var(--cyan-color)"  disabled>
                                            Изменить<i class="fas fa-address-book ml-2"></i>
                                        </button>
                                    </div>
                                </form>
                                <form id="queryEditPasswordUser">
                                    <h6 class="mb-3 text-muted text-uppercase bg-light p-2"><i class="fas fa-key mr-1"></i>
                                        Пароль
                                        <div class="spinner-border spinner-border-sm float-right text-info" role="status" hidden>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <i class="fas fa-check float-right text-success animate slideIn" hidden></i>
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="color: var(--yellow-color)">Старый пароль</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control" name="user_old_password" onkeyup="checkPassword()" placeholder="Ваш старый пароль" required>
                                                    <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a href="javascript://" class="text-muted text-decoration-none">
                                                        <i id="pass_icon" class="fas fa-eye-slash"></i>
                                                    </a>
                                                </span>
                                                    </div>
                                                </div>
                                                <a href="#" class="text-muted" data-toggle="modal" data-target="#openModalRecoveryPersonAccount">
                                                    <small> Забыли пароль? </small>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="color: var(--yellow-color)">Новый пароль</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control" name="user_new_password" onkeyup="checkPassword()" placeholder="Ваш новый пароль" minlength="8" maxlength="16" required>
                                                    <div class="input-group-append" >
                                                <span class="input-group-text">
                                                    <a href="javascript://" class="text-muted text-decoration-none">
                                                        <i id="pass_icon" class="fas fa-eye-slash"></i>
                                                    </a>
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col alert alert-danger alert-dismissible fade show animate slideIn mr-3 ml-3" role="alert" id="alertErrorUserEditPassword" style="font-size: 12px" hidden>
                                            Старый пароль введен неверно или новый пароль соответствует старому
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn mb-3 text-white" id="btnEditPassword" disabled style="background-color: var(--cyan-color)">
                                            Изменить<i class="fas fa-key ml-2"></i>
                                        </button>
                                    </div>
                                </form>
                                <form id="queryEditAchievementsDoctor">
                                    <h6 class="mb-3 text-muted text-uppercase bg-light p-2"><i class="fas fa-graduation-cap mr-1"></i>
                                        Достижения
                                        <div class="spinner-border spinner-border-sm float-right text-info" role="status" hidden>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <i class="fas fa-check float-right text-success animate slideIn" hidden></i>
                                    </h6>
                                    <div class="form-group">
                                        <label style="color: var(--yellow-color)">Специализация</label>
                                        <textarea rows="5" class="form-control" name="doctor_specialization" placeholder="Чем владеете, чем занимаетесь и т.п." minlength="300" maxlength="5000" required><?php echo $doctor_data->data['specialization']; ?></textarea>
                                        <small class="text-muted form-text">Минимум 300 символов</small>
                                    </div>
                                    <div class="row">
                                        <div class="col" id="list_education">
                                            <label style="color: var(--yellow-color)">Образование и повышение квалификации</label>
                                            <div class="alert alert-info">Сначала укажите даты, затем опишите где вы учились или чего достигли.
                                                <br> Например: <b>2003-2008 гг. Башкирский государственный медицинский университет </b></div>
                                            <table class="table table-sm table-borderless information_json">
                                                <?php
                                                foreach($doctor_data->data['education'] as $education) {?>
                                                        <tr class="animate slideIn">
                                                            <td class="pl-0">
                                                                <input type="text" class="form-control" name=doctor_education_json[]" value="<?php echo $education; ?>" minlength="5" maxlength="100" placeholder="Дата. Описание" required></td>
                                                            <td class="pl-0">
                                                        <span class="btn btn-sm btn-danger rounded-circle minus mt-1">
                                                            <i class="fas fa-minus"></i>
                                                        </span>
                                                            </td>
                                                        </tr>
                                                <?php } ?>


                                                <tr class="information_json_plus">
                                                    <td class="pl-0">
                                                <span class="btn btn-sm btn-success rounded-circle plus-education">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                    </td>
                                                    <td class="pl-0"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn mb-3 text-white" style="background-color: var(--cyan-color)">Изменить<i class="fas fa-graduation-cap ml-2"></i></button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
<!--Содержимое системных настроек-->
                    <div class="tab-pane fade show" id="settings_system" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <form id="queryEditNotificationUser">
                                    <h6 class="text-muted text-uppercase bg-light p-2"><i class="fas fa-bell mr-1"></i>
                                        Уведомления
                                        <div class="spinner-border spinner-border-sm float-right text-info" role="status" hidden>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <i class="fas fa-check float-right text-success animate slideIn" hidden></i>
                                    </h6>
                                    <div class="alert alert-info">Выберите за какое время уведомлять вас о событиях?</div>
                                    <div class="ml-3">
                                        <div class="custom-switch custom-control">
                                            <input class="custom-control-input" name="user_notification[]" value="5" id="time_notify_5" type="checkbox" checked>
                                            <label class="custom-control-label text-muted" for="time_notify_5">5 минут</label>
                                        </div>
                                        <div class="custom-switch custom-control mt-2">
                                            <input class="custom-control-input" name="user_notification[]" value="10" id="time_notify_10" type="checkbox">
                                            <label class="custom-control-label text-muted" for="time_notify_10">10 минут</label>
                                        </div>
                                        <div class="custom-switch custom-control mt-2">
                                            <input class="custom-control-input" name="user_notification[]" value="30" id="time_notify_30" type="checkbox">
                                            <label class="custom-control-label text-muted" for="time_notify_30">30 минут</label>
                                        </div>
                                        <div class="custom-switch custom-control mt-2">
                                            <input class="custom-control-input" name="user_notification[]" value="60" id="time_notify_60" type="checkbox">
                                            <label class="custom-control-label text-muted" for="time_notify_60">60 минут</label>
                                        </div>

                                    </div>
                                    <div class="alert alert-danger alert-dismissible fade show animate slideIn mt-2" role="alert" id="alertErrorEditNotificationUser" style="font-size: 12px" hidden>
                                        Выберите хотя бы один параметр!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn mt-2 text-white" style="background-color: var(--cyan-color)">Изменить<i class="fas fa-sliders-h ml-2"></i></button>
                                    </div>
                                </form>
                                <form>
                                    <h6 class="mt-3 text-muted text-uppercase bg-light p-2"><i class="fas fa-shapes mr-1"></i>
                                        Виджеты
                                        <div class="spinner-border spinner-border-sm float-right text-info" role="status" hidden>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <i class="fas fa-check float-right text-success animate slideIn" hidden></i>
                                    </h6>
                                    <div class="alert alert-info">Выберите какие виджеты отображать в профиле?</div>
                                    <div class="ml-3">
                                        <div class="custom-switch custom-control">
                                            <input class="custom-control-input" id="widget_info_patients" type="checkbox" checked>
                                            <label class="custom-control-label text-muted" for="widget_info_patients">Краткая информация по пациентам</label>
                                        </div>
                                        <div class="custom-switch custom-control mt-2">
                                            <input class="custom-control-input" id="widget_tasks" type="checkbox" checked>
                                            <label class="custom-control-label text-muted" for="widget_tasks">Задачи текущего дня</label>
                                        </div>
                                        <div class="custom-switch custom-control mt-2">
                                            <input class="custom-control-input" id="widget_notes" type="checkbox" checked>
                                            <label class="custom-control-label text-muted" for="widget_notes">Заметки текущего дня</label>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn mt-2 text-white" style="background-color: var(--cyan-color)">Изменить<i class="fas fa-sliders-h ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!--Модальное окно восстановления пароля-->
<div class="modal fade" id="openModalRecoveryPersonAccount" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Восстановление пароля</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Введите адрес электронной почты, который вы указали при регистрации в регистратуре. На указанный адрес будет отправлена ссылка для восстановления доступа к учетной записи.
                </div>
                <form id="queryRecoveryPasswordUser">
                    <div class="form-group">
                        <label style="color: var(--yellow-color)">Почта</label>
                        <input type="email" name="user_email" class="form-control" placeholder="Введите адрес электронной почты" required>
                    </div>
                </form>
                <div class="alert alert-danger alert-dismissible fade show animate slideIn" role="alert" style="font-size: 12px" id="alertErrorRecoveryPasswordUser" hidden>
                    Учетная запись с указанным адресом электронной почты не найдена. Повторите ввод и убедитесь, что вы были зарегистрированы с данным адресом.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success animate slideIn" role="alert" style="font-size: 12px" id="alertSuccessRecoveryPasswordUser" hidden>
                    Сообщение отправлено на указанную электронную почту. Если сообщение не пришло, то проверьте его в разделе <strong>спам</strong>.
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)" form="queryRecoveryPasswordUser">Отправить</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно изменения фотографии-->
<div class="modal fade" id="openModalReplaceAvatar" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Смена фотографии</h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Выбирайте ту фотографию, где строго изображены только вы!
                </div>
                <form id="queryEditPhotoUser" method="post" action="/queries/editPhotoUser.php" enctype="multipart/form-data">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="user_photo" id="customFile" accept="image/png,image/jpeg" required>
                        <label class="custom-file-label" for="customFile" data-browse="Открыть">Выберите фотографию</label>
                    </div>
                    <small class="form-text text-muted">До 2мб</small>
                </form>
                <div class="alert alert-success" role="alert" hidden>
                    Фотография успешно изменена на новую!
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning btn-block" form="queryEditPhotoUser" style="color: #fff; background-color: var(--yellow-color)">Изменить</button>
            </div>
        </div>
    </div>
</div>

<!--Футер (нижний блок)-->
<?php require $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>
</body>
<script>
    $('[name="user_photo"]').on('change', function () {
        if($(this).val !== "") {
            if (this.files[0].size > 2097152) {
                $(this).addClass('is-invalid');
                $(this).val("");
                $(this).parent().next().removeClass('text-muted');
                $(this).parent().next().addClass('text-danger');
            } else {
                $(this).removeClass('is-invalid');
                $(this).attr("placeholder", "Выберите фото");
                $(this).parent().next().removeClass('text-danger');
                $(this).parent().next().addClass('text-muted');
            }
        }
    });

    /**
     * Проверяет все поля контактных данных на изменение и дает доступ к отправке запроса на смену этих данных
     */
    function checkContactData() {
        if(
            $('input[name="user_email"]').val() === "<?php echo $user_data['phone_email']?>" &&
            $('input[name="user_phone"]').val() === "<?php echo $user_data['phone_number']?>"
        ) {
            $('#btnEditContactDataUser').attr("disabled", "disabled");
        } else {
            $('#btnEditContactDataUser').removeAttr("disabled");
        }
    }

    /**
     * Проверяет старый и новый пароли на изменение и дает доступ к отправке запроса на смену пароля
     */
    function checkPassword() {
        if(
            $('input[name="user_old_password"]').val() === "" ||
            $('input[name="user_new_password"]').val() === ""
        ) {
            $('#btnEditPassword').attr("disabled", "disabled");
        } else {
            $('#btnEditPassword').removeAttr("disabled");
        }
    }

    /**
     * После загрузки всей страницы дает доступ к функции, прослушивающей нажатие на #show_hide_password
     * Если поле пароля имеет тип text, то после нажатия ПКМ меняется на password, иначе наоборот
     */
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function() {
            if($(this).parent().parent().prev().attr('type') == "text"){
                $(this).parent().parent().prev().attr('type', 'password');
                $(this).children().removeClass("fa-eye");
                $(this).children().addClass("fa-eye-slash" );
            }else if($(this).parent().parent().prev().attr('type') == "password"){
                $(this).parent().parent().prev().attr('type', 'text');
                $(this).children().removeClass("fa-eye-slash" );
                $(this).children().addClass("fa-eye");
            }
        });
    });

    $(document).on('click', '.plus-education', function(){
        $(this).closest('.information_json_plus').before(
            '<tr class="animate slideIn">' +
            '<td class="pl-0"><input type="text" class="form-control" name=doctor_education_json[]" minlength="5" maxlength="100" placeholder="Дата. Описание" required></td>' +
            '<td class="pl-0"><span class="btn btn-sm btn-danger rounded-circle minus mt-1"><i class="fas fa-minus"></i></span></td>' +
            '</tr>'
        );
    });

    $(document).on('click', '.minus', function(){
        $(this).closest('tr').remove();
    });

    //Передает путь в placeholder поля к полю загрузки изображения
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // Маска для поля ввода номера телефона
    $('input[name="user_phone"]').mask("+7 (999) 999-99-99");
</script>
<script>


    //Закомментить, если надо посмотреть, как происходит обработка в editPhotoUser.php
    /**
     * Ожидает отправки формы #queryEditPhotoUser.
     * Отправляет AJAX (асинхронный) запрос для редактирования фотографии пользователя.
     * Запрос отправляется в кодировке form-data.
     * success: скрывает информационное сообщение и форму, показывает сообщение об успехе и
     * через пару секунд перезагружает страницу
     * error:
     */
    $("#queryEditPhotoUser").submit(function () {
        $.ajax({
            url: "/queries/editPhotoUser.php",
            method: "POST",
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            data: new FormData(this),
            success: function () {
                $("#queryEditPhotoUser").prev().attr("hidden", "hidden");
                $("#queryEditPhotoUser").attr("hidden", "hidden");
                $("#queryEditPhotoUser").next().removeAttr("hidden");
                setTimeout(function(){ location.reload();}, 2000);
            },
            error: function () {
            }
        });
        return false;
    });

    /**
     * Ожидает отправки формы #queryEditContactDataUser.
     * Показывает спиннер загрузки
     * Отправляет AJAX (асинхронный) запрос для редактирования контактных данных пользователя.
     * success: скрывает выведенные ошибки, спиннер загрузки и показывает галочку успеха,
     * через секунду перезагружает страницу
     * error: показывает ошибку ввода адреса электронной почты и скрывает спиннер загрузки
     */
    $("#queryEditContactDataUser").submit(function () {
        let spinner = $(this).children().find('.spinner-border');
        let checker = $(this).children().find('.fa-check');
        spinner.removeAttr("hidden");
        $.ajax({
            url: "/queries/editContactDataUser.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#alertErrorUserEditContactData").attr("hidden", "hidden");
                spinner.attr("hidden", "hidden");
                checker.removeAttr("hidden");
                setTimeout(function(){ checker.attr("hidden", "hidden"); location.reload();}, 1100);
            },
            error: function () {
                $("#alertErrorUserEditContactData").removeAttr("hidden");
                spinner.attr("hidden", "hidden");
            }
        });
        return false;
    });

    /**
     * Ожидает отправки формы #queryEditPasswordUser.
     * Показывает спиннер загрузки
     * Отправляет AJAX (асинхронный) запрос для редактирования пароля
     * success: скрывает выведенные ошибки, спиннер загрузки и показывает галочку успеха,
     * через секунду перезагружает страницу
     * error: показывает ошибку ввода адреса электронной почты и скрывает спиннер загрузки
     */
    $("#queryEditPasswordUser").submit(function () {
        let spinner = $(this).children().find('.spinner-border');
        let checker = $(this).children().find('.fa-check');
        spinner.removeAttr("hidden");
        $.ajax({
            url: "/queries/editPasswordUser.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#alertErrorUserEditPassword").attr("hidden", "hidden");
                $('input[name="user_old_password"]').val("");
                $('input[name="user_new_password"]').val("");
                $('#btnEditPassword').attr("disabled", "disabled");
                spinner.attr("hidden", "hidden");
                checker.removeAttr("hidden");
                setTimeout(function(){checker.attr("hidden", "hidden"); }, 1100);
            },
            error: function () {
                $("#alertErrorUserEditPassword").removeAttr("hidden");
                spinner.attr("hidden", "hidden");
            }
        });
        return false;
    });

    /**
     * Ожидает отправки формы #queryRecoveryPasswordUser.
     * Отправляет AJAX (асинхронный) запрос для обработки данных формы.
     * success: почта введена верно, вывод сообщения об успешной отправке сообщения на почту и скрытие формы.
     * error: отображение ошибки о неверном вводе адреса e-почты.
     */
    $("#queryRecoveryPasswordUser").submit(function () {
        $.ajax({
            url: "/queries/recoveryPasswordUser.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#alertSuccessRecoveryPasswordUser").removeAttr("hidden");
                $("#alertErrorRecoveryPasswordUser").attr("hidden", "hidden");
                $("input[name='user_email']").val("");
            },
            error: function () {
                $("#alertErrorRecoveryPasswordUser").removeAttr("hidden");
            }
        });
        return false;
    });

    $("#queryEditAchievementsDoctor").submit(function () {
        let spinner = $(this).children().find('.spinner-border');
        let checker = $(this).children().find('.fa-check');
        spinner.removeAttr("hidden");
        $.ajax({
            url: "/queries/doctor/editAchievements.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                spinner.attr("hidden", "hidden");
                checker.removeAttr("hidden");
                setTimeout(function(){checker.attr("hidden", "hidden"); }, 1100);
            },
            error: function () {
                spinner.attr("hidden", "hidden");
            }
        });
        return false;
    });

    /**
     * Ожидает отправки формы #queryEditNotificationUser.
     * Показывает спиннер загрузки
     * Отправляет AJAX (асинхронный) запрос для изменения настроек уведомления.
     * success: скрывает выведенные ошибки, спиннер загрузки и показывает галочку успеха,
     * через секунду перезагружает страницу
     * error: показывает ошибку (необходимо выбрать хотя-бы 1 параметр)
     */
    $("#queryEditNotificationUser").submit(function () {
        let spinner = $(this).children().find('.spinner-border');
        let checker = $(this).children().find('.fa-check');
        spinner.removeAttr("hidden");
        $.ajax({
            url: "/queries/editNotificationUser.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#alertErrorEditNotificationUser").attr("hidden", "hidden");
                spinner.attr("hidden", "hidden");
                checker.removeAttr("hidden");
                setTimeout(function(){ checker.attr("hidden", "hidden");}, 1100);
            },
            error: function () {
                console.log($(this).text());
                $("#alertErrorEditNotificationUser").removeAttr("hidden");
                spinner.attr("hidden", "hidden");
            }
        });
        return false;
    });
</script>
</html>
