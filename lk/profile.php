<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>
    <title>Профиль</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <a href="/lk/settings.php" class="btn btn-warning btn-sm text-white" style="background-color: var(--yellow-color); position: absolute; right: 1.2rem">
                            <i class="fas fa-cog"></i>
                        </a>
                        <div class="row">
                            <div class="col-lg-2 text-center">
                                <img src="/images/user.png" class="img-thumbnail rounded-circle" width="153" alt="">
                            </div>
                            <div class="col-lg-7">
                                <h4 class="font-weight-bold my-1" style="color: var(--cyan-color)">
                                    "Имя Фамилия"
                                </h4>
                                <p class="font-weight-bold text-muted">
                                    "Роль"
                                </p>
                                <div class="text-muted">
                                    "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum eligendi ex illum magnam modi nulla quae quibusdam recusandae sapiente voluptate."
                                </div>
                            </div>
                            <div class="col-lg-3 mt-lg-4 mt-sm-2">
                                <div class="mt-2">
                                    <label style="color: var(--yellow-color)">
                                        Прогресс пребывания
                                    </label>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped bg-info" role="progressbar" style="width: 25%;" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>