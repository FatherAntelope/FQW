<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/frameworks/bootstrap.min.css">
    <link rel="stylesheet" href="/css/login.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Вход</title>
</head>
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
                    <input type="password" class="form-control" placeholder="Ваш пароль" aria-describedby="password-help">
                    <small id="password-help" class="form-text text-muted"><a href="">Забыли пароль?</a></small>
                </div>
                <button type="button" class="btn btn-warning btn-block" style="color: #fff; background-color: #ffa400">Войти</button>
            </form>
        </div>
    </div>
</div>
</body>


</html>