<?php
$whose_user = 0;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>
    <title>СанКонтроль</title>
</head>
<style>
    .faq-question-q-box {
        height: 30px;
        width: 30px;
        color: #fff;
        background-color: var(--dark-cyan-color);
        text-align: center;
        border-radius: 50%;
        font-weight: 700;
        line-height: 31px;
    }
</style>
<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>

<!--Основной контент страницы-->
<div class="page-content" <?php if ($whose_user === 0) echo 'style="margin-top: 3.7rem !important;"';?>>
    <div class="container pt-3 pb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <h3 class="font-weight-bold" style="color: var(--dark-cyan-color)">Часто задаваемые вопросы</h3>
                            <p class="text-muted mt-2 mb-1">
                                Не нашли ответа на свой вопрос? Пишите в поддержку!
                            </p>
                            <button type="button" class="btn btn-warning mt-1 text-secondary" data-toggle="modal" data-target="#openModalSendMessageSupport" style="background-color: var(--yellow-color)">
                                <i class="fas fa-envelope mr-1"></i> Поддержка
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-sm-1">
                                <div class="faq-question-q-box">
                                    <i class="far fa-question-circle"></i>
                                </div>
                            </div>
                            <div class="col-sm-11">
                                <h5 class="text-muted font-weight-bold">What is Lorem Ipsum?</h5>
                                <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-sm-1">
                                <div class="faq-question-q-box">
                                    <i class="far fa-question-circle"></i>
                                </div>
                            </div>
                            <div class="col-sm-11">
                                <h5 class="text-muted font-weight-bold">What is Lorem Ipsum?</h5>
                                <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            </div>
                        </div>
                    </div>
                </div>
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
<?php require $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</body>
<script>
$('#notificationToast').toast('show');
</script>
</html>