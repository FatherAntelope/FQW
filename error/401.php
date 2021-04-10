<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/frameworks/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>
    <title>401</title>
</head>
<style>
    .btn-go-home {
        background-color: var(--cyan-color)
    }

    .btn-go-home:hover {
        background-color: var(--dark-cyan-color)
    }

    .btn-go-auth {
        background-color: var(--yellow-color)
    }

    .btn-go-auth:hover {
        background-color: #A66B00
    }



</style>
<body>
<div class="container" style="min-height: 100vh; position: relative">
    <div class="justify-content-center error-content-center">
        <div class="row">
            <div class="col-lg-6 text-center">
                <h4 class="text-error font-weight-bold" >401</h4>
                <p class="text-muted">
                    У вас нет доступа к данной странице. Необходимо авторизоваться в личном кабинете.
                </p>
                <a href="/" class="btn text-white btn-go-home m-1">
                    <i class="fas fa-home mr-2"></i>
                    На главную
                </a>
                <a href="/auth.php" class="btn text-white btn-go-auth m-1">
                    <i class="fas fa-user-lock mr-2"></i>
                    Авторизоваться
                </a>
            </div>
            <div class="col-lg-6 text-center">
                <img src="/images/401.svg" class="img-fluid">
            </div>
        </div>
    </div>
</div>
</body>
</html>

