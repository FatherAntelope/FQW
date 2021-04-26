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
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
    <title>СанКонтроль</title>
</head>
<style>

</style>
<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>

<!--Основной контент страницы-->
<div class="page-content">
    <div class="container pt-3 pb-3" style="min-height: 100vh">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/lk/" style="color: var(--dark-cyan-color)">Профиль</a></li>
                <li class="breadcrumb-item active" aria-current="page">Настройки</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card">
                    <div class="card-header text-center" style="background-color: var(--cyan-color">
                        <img src="/images/user.png" class="rounded-circle img-thumbnail" style="height: 12rem;width: 12rem;">
                        <h4 class="mb-0 mt-2" style="color: var(--yellow-color)">"Имя Фамилия"</h4>
                        <p class="mb-2 text-white" >
                            Администратор
                        </p>
                        <button data-toggle="modal" data-target="#openModalReplaceAvatar" class="btn btn-warning btn-sm text-white" style="background-color: var(--yellow-color)">
                            Изменить фото
                        </button>
                        <button type="submit" class="btn btn-danger btn-sm text-white" style="background-color: var(--red--color)">Выйти</button>
                    </div>
                    <div class="card-body">
                        <div class="text-left mt-1">
                            <h6 class="text-muted text-uppercase bg-light p-2"><i class="fas fa-address-book mr-1"></i>Основные данные</h6>
                            <p class="text-muted mb-1">
                                <strong>Должность:</strong>
                                <span class="ml-2">Главный администратор</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
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
                    <div class="tab-pane fade show active" id="user_data_edit" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <h5 class="mb-3 text-muted text-uppercase bg-light p-2"><i class="fas fa-user mr-1"></i> Персональные данные</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="color: var(--yellow-color)">Фамилия</label>
                                                <input type="text" class="form-control" id="firstname" placeholder="Ваша фамилия">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="color: var(--yellow-color)">Имя</label>
                                                <input type="text" class="form-control" placeholder="Ваше имя">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="color: var(--yellow-color)">Отчество</label>
                                                <input type="text" class="form-control" placeholder="Ваше отчество">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn mb-3 text-white" style="background-color: var(--cyan-color)">Изменить<i class="fas fa-user ml-2"></i></button>
                                    </div>
                                </form>
                                <form>
                                    <h5 class="mb-3 text-muted text-uppercase bg-light p-2"><i class="fas fa-address-book mr-1"></i> Контактные данные</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="color: var(--yellow-color)">Почта</label>
                                                <input type="email" class="form-control" placeholder="example@mail.ru" name="user_email" value="mail@mail.ru" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="color: var(--yellow-color)">Номер телефона </label>
                                                <input type="tel" class="form-control" placeholder="+7 (999) 99-99-999" name="user_phone" value="+7 (999) 99-99-999">
                                            </div>
                                        </div>
                                        <div class="col alert alert-danger alert-dismissible fade show animate slideIn mr-3 ml-3" role="alert" style="font-size: 12px">
                                            Аккаунт с указанным адресом электронной почты уже существует. Измените или проверьте введенный адрес электронной почты!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn mb-3 text-white" style="background-color: var(--cyan-color)">Изменить<i class="fas fa-address-book ml-2"></i></button>
                                    </div>
                                </form>
                                <form>
                                    <h5 class="mb-3 text-muted text-uppercase bg-light p-2"><i class="fas fa-key mr-1"></i>Пароль</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="color: var(--yellow-color)">Старый пароль</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control" placeholder="Ваш старый пароль">
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
                                                    <input type="password" class="form-control" placeholder="Ваш новый пароль">
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

                                        <div class="col alert alert-danger alert-dismissible fade show animate slideIn mr-3 ml-3" role="alert" style="font-size: 12px">
                                            Старый пароль введен неверно или новый пароль соответствует старому
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn mb-3 text-white" style="background-color: var(--cyan-color)">Изменить<i class="fas fa-key ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="settings_system" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <h5 class="text-muted text-uppercase bg-light p-2"><i class="fas fa-bell mr-1"></i> Уведомления </h5>
                                    <div class="alert alert-info">Выберите за какое время уведомлять вас о событиях?</div>
                                    <div class="ml-3">
                                        <div class="custom-switch custom-control">
                                            <input class="custom-control-input" id="time_notify_5" type="checkbox" checked>
                                            <label class="custom-control-label text-muted" for="time_notify_5">5 минут</label>
                                        </div>
                                        <div class="custom-switch custom-control mt-2">
                                            <input class="custom-control-input" id="time_notify_10" type="checkbox">
                                            <label class="custom-control-label text-muted" for="time_notify_10">10 минут</label>
                                        </div>
                                        <div class="custom-switch custom-control mt-2">
                                            <input class="custom-control-input" id="time_notify_30" type="checkbox">
                                            <label class="custom-control-label text-muted" for="time_notify_30">30 минут</label>
                                        </div>
                                        <div class="custom-switch custom-control mt-2">
                                            <input class="custom-control-input" id="time_notify_60" type="checkbox">
                                            <label class="custom-control-label text-muted" for="time_notify_60">60 минут</label>
                                        </div>
                                    </div>

                                    <h5 class="mt-3 text-muted text-uppercase bg-light p-2"><i class="fas fa-shapes mr-1"></i> Виджеты </h5>
                                    <div class="alert alert-info">Выберите какие виджеты отображать в профиле?</div>
                                    <div class="ml-3">
                                        <div class="custom-switch custom-control">
                                            <input class="custom-control-input" id="widget_diary" type="checkbox" checked>
                                            <label class="custom-control-label text-muted" for="widget_diary">Мониторинг пользователей</label>
                                        </div>
                                        <div class="custom-switch custom-control mt-2">
                                            <input class="custom-control-input" id="widget_tasks" type="checkbox" checked>
                                            <label class="custom-control-label text-muted" for="widget_tasks">Мониторинг системы</label>
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



<div class="modal fade" id="openModalRecoveryPersonAccount" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Восстановление пароля</h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Введите адрес электронной почты, который вы указали при регистрации в регистратуре. На указанный адрес будет отправлена ссылка для восстановления доступа к учетной записи.
                </div>
                <form>
                    <div class="form-group">
                        <label style="color: var(--yellow-color)">Почта</label>
                        <input type="email" name="user_mail" class="form-control" placeholder="Введите адрес электронной почты" required>
                    </div>
                </form>
                <div class="alert alert-danger alert-dismissible fade show animate slideIn" role="alert" style="font-size: 12px">
                    Учетная запись с указанным адресом электронной почты не найдена. Повторите ввод и убедитесь, что вы были зарегистрированы с данным адресом.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success animate slideIn" role="alert" style="font-size: 12px">
                    Сообщение отправлено на указанную электронную почту. Если сообщение не пришло, то проверьте его в разделе <strong>спам</strong>.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)">Отправить</button>
            </div>
        </div>
    </div>
</div>

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
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" accept="image/*">
                    <label class="custom-file-label" for="customFile" data-browse="Открыть">Выберите фотографию</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-block" style="color: #fff; background-color: var(--yellow-color)">Изменить</button>
            </div>
        </div>
    </div>
</div>

<!--Футер (нижний блок)-->
<?php require $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>
</body>
<script>
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

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('input[name="user_phone"]').mask("+7 (999) 99-99-999");
</script>
</html>
