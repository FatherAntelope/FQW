<!--
Страница ошибки неполадки сервера базы данных
-->
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="//code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>
    <title>404</title>
</head>
<style>
    .btn-go-home {
        background-color: var(--cyan-color)
    }

    .btn-go-home:hover {
        background-color: var(--dark-cyan-color)
    }
</style>
<body>
<div class="container" style="min-height: 100vh; position: relative">
    <div class="justify-content-center error-content-center">
        <div class="row">
            <div class="col-lg-6 text-center">
                <h4 class="text-error font-weight-bold" >502</h4>
                <p class="text-muted">Неполадки с сервером базы данных. Пожалуйста, повторите попытку позднее</p>
                <a href="/" class="btn text-white btn-go-home mb-3">
                    <i class="fas fa-home mr-2"></i>
                    На главную
                </a>
            </div>
            <div class="col-lg-6 text-center">
                <img src="/images/502.svg" class="img-fluid">
            </div>
        </div>
    </div>
</div>
</body>
</html>