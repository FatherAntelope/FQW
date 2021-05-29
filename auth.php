<?php
//Если пользователь авторизован, то направляет к странице профиля
if (isset($_COOKIE['user_token']))
    header("Location: /lk/");
require $_SERVER['DOCUMENT_ROOT']. '/utils/variables.php';
?>
<!--
Страница авторизации в профиль пользователя
-->
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="//fonts.gstatic.com">
    <link href="//fonts.googleapis.com/css2?family=PT+Serif:wght@400;700&family=Source+Serif+Pro:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/images/logo-mini.png" type="image/x-icon">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
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
<!--Основной контент страницы-->
<div class="container align-items-center">
    <div class="row justify-content-center pt-5" id="card">
        <div class="col-lg-10">
<!--Карточка с формой авторизации-->
            <div class="card shadow-lg">
<!--Заголовок карточки с логотипом-гиперссылкой на главную страницу-->
                <div class="card-header pt-3 pb-3 d-flex justify-content-center" style="background-color: var(--cyan-color)">
                    <a href="/" class="text-decoration-none">
                        <div class="d-flex">
                            <img src="/images/logo-mini.png" alt="" height="40">
                            <div class="ml-2 d-flex justify-content-center flex-column">
                                <h5 class="text-uppercase mb-0 pb-0" style="font-family: 'PT Serif', serif; font-family: 'Source Serif Pro', serif; color: var(--yellow-color)"><? echo web_name_header; ?></h5>
                                <span class="text-white" style="font-size: 12px; font-family: 'PT Serif', serif; font-family: 'Source Serif Pro', serif;"><? echo web_name_span; ?></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
<!--Левая колонка с изображением-->
                        <div class="col-md-6 mb-3">
                            <img src="images/login.svg" class="img-fluid" alt="image">
                        </div>
<!--Правая колонка с формой авторизации-->
                        <div class="col-md-6">
                            <h3 style="color: var(--cyan-color)">Авторизация</h3>
                            <form id="queryLoginUser">
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
<!--Всплывающее сообщения об ошибке авторизации (если пользователь неверно ввел данные авторизации)-->
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
<!--Нижний блок карточки (копирайтер)-->
                <div class="card-footer" style="background-color: var(--cyan-color)">
                    <div class="row justify-content-center align-items-center">
                        <div class="text-white pt-2 text-center">
                            <p class="mb-1">©2021 <?php echo web_name_header; ?>. Все права защищены</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно с формой восстановления пароля пользователя-->
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
<!--Сообщение-информация о том, как надо заполнять форму-->
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Введите адрес электронной почты, который вы указали при регистрации в регистратуре. На указанный адрес будет отправлена ссылка для восстановления доступа к учетной записи.
                </div>
<!--Форма с динамической отправкой данных с помощью AJAX-->
                <form id="queryRecoveryPasswordUser">
                    <div class="form-group">
                        <label style="color: var(--yellow-color)">Почта</label>
                        <input type="email" name="user_email" class="form-control" placeholder="Введите адрес электронной почты" required>
                    </div>
                </form>
<!--Сообщение-предупреждение об ошибке (неверно указан адрес электронной почты - не найден)-->
                <div class="alert alert-danger alert-dismissible fade show animate slideIn" role="alert" style="font-size: 12px" id="alertErrorRecoveryPasswordUser" hidden>
                    Учетная запись с указанным адресом электронной почты не найдена. Повторите ввод и убедитесь, что вы были зарегистрированы с данным адресом.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
<!--Сообщение-успех об удачной отправке данных на почту со ссылкой восстановления пароля-->
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
    /**
     * Скрипт активируется при полной загрузке сообщения.
     * Ожидает нажатие на элемент #show_hide_password.
     * Скрипт для отображения символов пароля в поле ввода пароля.
     * Если тип поля - "text", то меняем тип на "password",
     * Иначе наоборот.
     */
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
    /**
     * Ожидает отправки формы #queryLoginUser.
     * Отправляет AJAX (асинхронный) запрос для обработки данных формы.
     * success: данные авторизации введены верно, переход на страницу профиля.
     * error: данные авторизации введены неверно, отображение сообщения об ошибке и очистка поля пароля.
     */
    $("#queryLoginUser").submit(function () {
        $.ajax({
            url: "/queries/loginUser.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $(location).attr('href', '/lk/');
            },
            error: function () {
                $("#alertErrorLogin").removeAttr("hidden");
                $("input[name='user_password']").val("");
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