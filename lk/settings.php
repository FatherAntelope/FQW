<!doctype html>
<html lang="en">
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
    <title>Настройки</title>
</head>
<style>

    .avatar {
        height: 12rem;
        width: 12rem;
    }

</style>
<body>

<div class="container mt-4 mb-4" style="min-height: 100vh">
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card">
                <div class="card-header text-center" style="background-color: var(--cyan-color">
                    <img src="/images/vladlen.jpg" class="rounded-circle avatar img-thumbnail">
                    <h4 class="mb-0 mt-2 text-white"">"Имя Фамилия"</h4>
                    <p class="mb-2" style="color: var(--yellow-color)">"Роль"</p>
                    <button data-toggle="modal" data-target="#openModalReplaceAvatar" class="btn btn-warning btn-sm text-white" style="background-color: var(--yellow-color)">
                        Изменить фото
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm text-white" style="background-color: var(--red--color)">Выйти</button>
                </div>
                <div class="card-body">
                    <div class="text-left mt-1">
                        <p class="text-muted mb-1">
                            <strong>ФИО:</strong>
                            <span class="ml-2">"Фамилия Имя Отчество"</span>
                        </p>
                        <p class="text-muted mb-1">
                            <strong>Возраст:</strong>
                            <span class="ml-2">"10 (10-10-1000)"</span>
                        </p>
                        <p class="text-muted mb-1">
                            <strong>Телефон:</strong>
                            <span class="ml-2">"8(999)-123-12-34"</span>
                        </p>
                        <p class="text-muted mb-1">
                            <strong>Почта:</strong>
                            <span class="ml-2 ">"info@mail.ru"</span>
                        </p>
                        <p class="text-muted mb-1">
                            <strong>Адрес проживания:</strong>
                            <span class="ml-2">"Адрес"</span>
                        </p>
                        <p class="text-muted mb-1">
                            <strong>ID карты:</strong>
                            <span class="ml-2">"ID"</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-7">
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

                        <h5 class="mb-3 text-muted text-uppercase bg-light p-2"><i class="fas fa-address-book mr-1"></i> Контактные данные</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Почта</label>
                                    <input type="email" class="form-control" placeholder="Ваша электронная почта">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Номер телефона</label>
                                    <input type="text" class="form-control" placeholder="Ваш номер">
                                </div>
                            </div>
                            <div class="col alert alert-danger alert-dismissible fade show animate slideIn mr-3 ml-3" role="alert" style="font-size: 12px">
                                Аккаунт с указанным адресом электронной почтой уже существует. Измените или проверьте введенный адрес электронной почты!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Адрес проживания</label>
                                    <input type="text" class="form-control" placeholder="Ваш адрес проживания">
                                </div>
                            </div>
                        </div>
                        <h5 class="mb-3 text-muted text-uppercase bg-light p-2"><i class="fas fa-key mr-1"></i></i> Пароль</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Старый пароль</label>
                                    <input type="text" class="form-control" placeholder="Ваш старый пароль">
                                    <a href="#" class="text-muted" data-toggle="modal" data-target="#openModalRecoveryPersonAccount">
                                        <small> Забыли пароль? </small>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Новый пароль</label>
                                    <input type="text" class="form-control" placeholder="Ваш новый пароль">
                                </div>
                            </div>

                            <div class="col alert alert-danger alert-dismissible fade show animate slideIn mr-3 ml-3" role="alert" style="font-size: 12px">
                                Старый пароль введен неверно или новый пароль соответствует старому. Убедитесь, что старый и новый пароли указаны верно!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success mt-2">Изменить<i class="fas fa-user-edit ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer style="background-color: var(--cyan-color)">
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <a href="/">
                            <img src="/images/logo.png" height="40">
                        </a>
                        <p class="mt-2 text-white opacity-8 pr-lg-4">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad architecto aspernatur consequuntur dicta dolor et excepturi fugiat harum impedit iusto laboriosam minus, modi non numquam repellendus sed tempore temporibus voluptate.
                        </p>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 ml-lg-auto mb-5 mb-lg-0">
                        <h6 class="heading mb-3" style="font-weight: 700 ;color: var(--yellow-color)">Аккаунт</h6>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="#">Личный кабинет</a>
                            </li>
                            <li>
                                <a href="#" style="color: ">Настройки</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                        <h6 class="heading mb-3" style="font-weight: 700 ;color: var(--yellow-color)">О нас</h6>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="#">Цены</a>
                            </li>
                            <li>
                                <a href="#">Контакты</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                        <h6 class="heading mb-3" style="font-weight: 700 ;color: var(--yellow-color)">Помощь</h6>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="#">Часто задаваемые вопросы</a>
                            </li>
                            <li>
                                <a href="#">Поддержка</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <hr style="border-top: 3px solid var(--yellow-color);">

                <div class="row justify-content-center align-items-center">
                    <div class="text-white">
                        <p>©2021 HeartBlaze. Все права защищены</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>




<div class="modal fade" id="openModalRecoveryPersonAccount" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Восстановление пароля</h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert" style="font-size: 12px">
                    Введите адрес электронной почты, который вы указали при регистрации в регистратуре. На указаный адрес будет отправлена ссылка для восстановления доступа к учетной записи.
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
</body>
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
</html>
