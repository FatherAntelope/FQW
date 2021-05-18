<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/images/logo-mini.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>
    <title>Авторизация</title>
</head>
<style>
    @media (max-width: 769px) {
        #card {
            padding: 0 !important;
        }
    }
</style>
<body>
<div class="container align-items-center">
    <div class="row justify-content-center pt-5" id="card">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-header text-center pt-3 pb-3" style="background-color: var(--cyan-color)">
                    <a href="/">
                        <img src="/images/logo.png" alt="" height="40">
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <img src="images/login.svg" class="img-fluid" alt="image">
                        </div>
                        <div class="col-md-6">
                            <h3 style="color: var(--cyan-color)">Авторизация</h3>
                            <form method="post" action="/queries/loginUser.php">
                                <div class="form-group">
                                    <label style="color: #ffa400">Логин</label>
                                    <input type="text" name="user_login" class="form-control" placeholder="Ваш логин" required>
                                </div>
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Пароль</label>
                                    <a href="#" class="float-right text-muted" data-toggle="modal" data-target="#openModalRecoveryPersonAccount">
                                        <small> Забыли пароль? </small>
                                    </a>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" name="user_password" class="form-control" placeholder="Ваш пароль" required>
                                        <div class="input-group-append" >
                                                <span class="input-group-text">
                                                    <a href="javascript://" class="text-muted text-decoration-none">
                                                        <i id="pass_icon" class="fas fa-eye-slash"></i>
                                                    </a>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-danger alert-dismissible animate slideIn" id="alertErrorLogin" style="font-size: 12px;" hidden>
                                    <strong>Ошибка авторизации.</strong>
                                    <hr style="margin: 5px">
                                    Пожалуйста, убедитесь что логин и пароль указаны верно.
                                    <br>
                                    Если вы не еще зарегистрированы, то обратитесь в регистратуру вашего санатория для выдачи вам данных к личному кабинету.
                                    <button type="submit" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <button type="submit" class="btn btn-warning btn-block text-secondary font-weight-bold" style="background-color: var(--yellow-color)">Войти</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="background-color: var(--cyan-color)">
                    <div class="row justify-content-center align-items-center">
                        <div class="text-white pt-2 text-center">
                            <p class="mb-1">©2021 СанКонтроль. Все права защищены</p>
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
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function() {
            if($(this).parent().parent().prev().attr('type') === "text"){
                $(this).parent().parent().prev().attr('type', 'password');
                $(this).children().removeClass("fa-eye");
                $(this).children().addClass("fa-eye-slash" );
            }else if($(this).parent().parent().prev().attr('type') === "password"){
                $(this).parent().parent().prev().attr('type', 'text');
                $(this).children().removeClass("fa-eye-slash" );
                $(this).children().addClass("fa-eye");
            }
        });
    });
</script>
<script>
    $("#queryLoginUser").submit(function () {
        $.ajax({
            url: "/queries/loginUser.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                //$(location).attr('href', '/lk/');
            },
            error: function () {
                $("#alertErrorLogin").removeAttr("hidden");
                $("input[name='user_password']").val("");
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
</script>
</body>
</html>