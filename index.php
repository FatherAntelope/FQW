<?php
if(isset($_COOKIE['user_token'])) {
    require $_SERVER['DOCUMENT_ROOT'] . "/utils/curl.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";

    $url = "https://".domain_name_api."/api/med/user";
    $method = "GET";
    $auth_token = 'Authorization: Bearer '.$_COOKIE['user_token'];
    $user_data = utils_call_api($method, $url, null, [$auth_token]);
    $whose_user = $user_data->data['user']['role'];
    if($whose_user === "Admin") {
        $whose_user = 1;
    } elseif ($whose_user === "Patient") {
        $whose_user = 2;
    } elseif ($whose_user === "Doctor") {
        $whose_user = 3;
    } else {
        $whose_user = 0;
    }
} else {
    $whose_user = 0;
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/images/logo-mini.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="js/all.js"></script>
    <title>СанКонтроль</title>
</head>

<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>


<div style="min-height: 90vh; margin-top: 6.3rem">

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