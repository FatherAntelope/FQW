<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/frameworks/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Вход</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #007060;
    }

    .content {
        margin: 8%;
        background-color: #fff;
        padding: 4rem 1rem 4rem 1rem;
        box-shadow: 0 0 5px 5px rgba(0,0,0,.05);
    }

    .animate {
        animation-duration: 0.3s;
        -webkit-animation-duration: 0.3s;
        animation-fill-mode: both;
        -webkit-animation-fill-mode: both;
    }

    .slideIn {
        -webkit-animation-name: slideIn;
        animation-name: slideIn;
    }
    .notification-list {
        margin-left: 0;
    }

    @keyframes slideIn {
        0% {
            transform: translateY(1rem);
            opacity: 0;
        }
        100% {
            transform:translateY(0rem);
            opacity: 1;
        }
        0% {
            transform: translateY(1rem);
            opacity: 0;
        }
    }

    @-webkit-keyframes slideIn {
        0% {
            -webkit-opacity: 0;
        }
        100% {
            -webkit-transform: translateY(0);
            -webkit-opacity: 1;
        }
        0% {
            -webkit-transform: translateY(1rem);
            -webkit-opacity: 0;
        }
    }
</style>
<body>
<div class="container">
    <div class="row content">
        <div class="col-md-6 mb-3">
            <img src="images/login.svg" class="img-fluid" alt="image">
        </div>
        <div class="col-md-6">
            <h3 style="color: #00AC94">Авторизация</h3>
            <form>
                <div class="form-group">
                    <label style="color: #ffa400">Логин</label>
                    <input type="text" name="user_login" class="form-control" placeholder="Ваш логин">
                </div>
                <div class="form-group">
                    <label style="color: #ffa400">Пароль</label>
                    <input type="password" name="user_password" class="form-control" placeholder="Ваш пароль" required>
                    <small id="password-help" class="form-text text-muted">
                        <a href="#"  data-toggle="modal" data-target="#openModalRecoveryPersonAccount">Забыли пароль?</a>
                    </small>
                </div>
                <div class="alert alert-danger alert-dismissible fade show animate slideIn" role="alert" style="font-size: 12px">
                    <strong>Ошибка авторизации.</strong>
                    <hr style="margin: 5px">
                    Пожалуйста, убедитесь что логин и пароль написаны верно.
                    <br>
                    Если вы не еще зарегистрированы, то обратитесь в регистратуру вашего санатория для выдачи вам данных к личному кабинету.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <button type="button" class="btn btn-warning btn-block" style="color: #fff; background-color: #ffa400">Войти</button>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="openModalRecoveryPersonAccount" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: #00AC94">Восстановление пароля</h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Введите адрес электронной почты, который вы указали при регистрации в регистратуре. На указаный адрес будет отправлена ссылка для восстановления доступа к учетной записи.
                </div>
                <form>
                    <div class="form-group">
                        <label style="color: #ffa400">Почта</label>
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
                <button type="button" class="btn btn-warning btn-block" style="color: #fff; background-color: #ffa400">Отправить</button>
            </div>
        </div>
    </div>
</div>





</body>
</html>