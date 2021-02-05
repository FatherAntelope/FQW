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
    <title>Регистрация пользователя</title>
</head>

<style>
    .tab-bg-active {
        color: var(--dark-cyan-color);
    }

    .tab-bg-active:hover {
        color: var(--yellow-color);
    }

    .nav-pills .nav-link.active, .nav-pills .show>.nav-link.tab-bg-active {
        background-color: var(--cyan-color) !important;
        color: #fff !important;
    }

</style>

<body>
<div class="container">
    <ul class="nav nav-pills flex-column flex-sm-row mb-2" id="myTab" role="tablist">
        <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
            <a class="nav-link tab-bg-active font-weight-bold active" data-toggle="tab" href="#patient" role="tab">
                <i class="fas fa-procedures mr-1"></i>Пациент
            </a>
        </li>
        <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
            <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#doctor" role="tab">
                <i class="fas fa-user-md mr-1"></i> Медицинский персонал
            </a>
        </li>
        <li class="nav-item flex-sm-fill text-sm-center mr-1 ml-1" role="presentation">
            <a class="nav-link tab-bg-active font-weight-bold" data-toggle="tab" href="#admin" role="tab">
                <i class="fas fa-user-cog mr-1"></i> Администрация
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="patient" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <form>
                        <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                            <i class="fas fa-user mr-1"></i>
                            Персональные данные
                        </h5>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Фамилия <strong style="color: var(--red--color)">*</strong></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Имя <strong style="color: var(--red--color)">*</strong></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Отчество</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Дата рождения <strong style="color: var(--red--color)">*</strong></label>
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Рост <strong style="color: var(--red--color)">*</strong></label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Вес <strong style="color: var(--red--color)">*</strong></label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Фото</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" accept="image/*">
                                        <label class="custom-file-label" for="customFile" data-browse="Открыть">Выберите фотографию</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color: var(--yellow-color)">Паспортные данные <strong style="color: var(--red--color)">*</strong></label>
                            <div class="form-row">
                                <div class="col-lg-2">
                                    <input type="number" class="form-control">
                                    <small class="text-muted form-text">Серия и номер</small>
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control">
                                    <small class="text-muted form-text">Код подразделения</small>
                                </div>
                                <div class="col-lg-2">
                                    <input type="date" class="form-control" placeholder="Дата выдачи">
                                    <small class="text-muted form-text">Дата выдачи</small>
                                </div>
                                <div class="col-lg">
                                    <input type="text" class="form-control">
                                    <small class="text-muted form-text">Кем выдан</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">СНИЛС <strong style="color: var(--red--color)">*</strong></label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">ИНН <strong style="color: var(--red--color)">*</strong></label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                        </div>


                        <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                            <i class="fas fa-address-book mr-1"></i>
                            Контактные данные
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Почта <strong style="color: var(--red--color)">*</strong></label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">Номер телефона <strong style="color: var(--red--color)">*</strong></label>
                                    <input type="text" class="form-control">
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
                                    <label style="color: var(--yellow-color)">Фактический адрес проживания <strong style="color: var(--red--color)">*</strong></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                            <i class="fas fa-file-medical-alt mr-1"></i>
                            Состояние здоровья
                        </h5>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label style="color: var(--yellow-color)">История болезни <strong style="color: var(--red--color)">*</strong></label>
                                    <textarea class="form-control"></textarea>
                                    <small class="text-muted form-text">Кратко с чем поступил пациент</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6" id="list_diagnosis">

                                    <label style="color: var(--yellow-color)">Диагнозы <strong style="color: var(--red--color)">*</strong></label>
                                    <table class="table table-sm table-borderless information_json">
                                        <tr class="information_json_plus">
                                            <td class="pl-0">
                                                <span class="btn btn-sm btn-success rounded-circle plus">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                            </td>
                                            <td class="pl-0"></td>
                                        </tr>
                                    </table>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn mt-2 text-white" style="background-color: var(--cyan-color)">
                                <i class="fas fa-procedures mr-2"></i>Зарегистрировать
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="doctor" role="tabpanel">2</div>
        <div class="tab-pane fade" id="admin" role="tabpanel">3</div>
    </div>






</div>
</body>
<script>
    $('.plus').click(function(){
        $('.information_json_plus').before(
            '<tr>' +
            '<td class="pl-0"><input type="text" class="form-control" name="information_json_val[]" placeholder="Название диагноза" required></td>' +
            '<td class="pl-0"><span class="btn btn-sm btn-danger rounded-circle minus mt-1"><i class="fas fa-minus"></i></span></td>' +
            '</tr>'
        );
    });

    $(document).on('click', '.minus', function(){
        $( this ).closest( 'tr' ).remove();
    });
</script>

</html>
