<?php
$whose_user = 2;
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
    <link rel="stylesheet" href="/css/timeline.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="/js/all.js"></script>
    <title>СанКонтроль</title>
</head>
<body>
<!--Панель навигации по модулям пользователя-->
<?php require $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>

<!--Основной контент страницы-->
<div class="page-content">
    <div class="container pt-3 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/lk/" style="color: var(--dark-cyan-color)">Профиль</a></li>
                <li class="breadcrumb-item active" aria-current="page">Медицинская карта</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-xl-4 col-lg-4">
                <div class="card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-disease mr-2"></i>Мои диагнозы</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl col-md">
                                <div class="text-center">
                                    <img class="card-img" src="/images/medical_research.svg" height="100" alt="">
                                </div>
                            </div>
                            <div class="col-xl col-md">
                                <h3 class="text-muted">Диагнозов</h3>
                                <h2 style="color: var(--dark-cyan-color)">10</h2>
                                <button type="button" class="btn btn-sm text-white btn-block" data-toggle="modal" data-target="#openModalDiagnoses" style="background-color: var(--dark-cyan-color)">Посмотреть</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="card mt-3 mt-xl-0 mt-lg-0">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-clipboard mr-2"></i>Мои рекомендации</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-md">
                                <div class="text-center">
                                    <img class="card-img" src="/images/recommendations.svg" height="100" alt="">
                                </div>
                            </div>
                            <div class="col-xl-6 col-md">
                                <h5 class="text-muted">Рекомендаций</h5>
                                <h2 style="color: var(--dark-cyan-color)">10</h2>
                                <button type="button" class="btn btn-sm text-white btn-block mt-xl-3 mt-lg-3" data-toggle="modal" data-target="#openModalRecommendations" style="background-color: var(--dark-cyan-color)">Посмотреть</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="card mt-3 mt-xl-0 mt-lg-0">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-pills mr-2"></i>Мои лекарства</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl col-md">
                                <div class="text-center">
                                    <img class="card-img" src="/images/medical_care.svg" height="100" alt="">
                                </div>
                            </div>
                            <div class="col-xl col-md">
                                <h3 class="text-muted">Лекарств</h3>
                                <h2 style="color: var(--dark-cyan-color)">10</h2>
                                <button type="button" class="btn btn-sm text-white btn-block" data-toggle="modal" data-target="#openModalPills" style="background-color: var(--dark-cyan-color)">Посмотреть</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mt-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-notes-medical mr-2"></i>Моя история по эпикризам</div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="text-center mt-2">
                                    <img src="/images/no_data.svg" alt="" height="170">
                                    <h5 class="mt-4 text-danger"><b>Эпикризы отсутствуют</b></h5>
                                    <p class="text-muted mb-1">Вы не посещали врача, либо же вы полностью здоровы</p>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-auto" style="max-height: 400px">
                            <!--Список с краткой информацией эпикризов во временной линии-->
                            <div class="vertical-timeline vertical-timeline--one-column">
                                <!--Эпикриз-->
                                <div class="vertical-timeline-item vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in">
                                            <i class="badge badge-dot badge-dot-xl" style="background-color: var(--cyan-color)"> </i>
                                        </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title" style="color: var(--cyan-color)">Эпикриз врача <a href="" class="text-decoration-none text-danger">Иванов И. И.</a> </h4>
                                            <p class="text-truncate mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aperiam dolores eius est excepturi incidunt libero, nam non nostrum, optio quaerat, quam reiciendis sunt unde velit veritatis voluptate. Ab, accusantium aliquam blanditiis commodi cum delectus deleniti dolorem doloribus eligendi impedit iure nulla numquam quae quis repellat tenetur ullam veniam veritatis!</p>
                                            <a class="text-decoration-none text-info" href="#" data-toggle="modal" data-target="#openModalInfoEpicrisis">Подробнее...</a>
                                            <span class="vertical-timeline-element-date text-muted">10.04.21</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mt-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-weight-bold" style="color: var(--dark-cyan-color)"><i class="fa fa-microscope mr-2"></i>Мои история результатов обследований</div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="text-center mt-2">
                                    <img src="/images/no_data.svg" alt="" height="170">
                                    <h5 class="mt-4 text-danger"><b>Результаты отсутствуют</b></h5>
                                    <p class="text-muted mb-1">Вы не проходили ни одно обследование</p>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-auto" style="max-height: 400px">
                            <!--Список с краткой информацией эпикризов во временной линии-->
                            <div class="vertical-timeline vertical-timeline--one-column">
                                <!--Эпикриз-->
                                <div class="vertical-timeline-item vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in">
                                            <i class="badge badge-dot badge-dot-xl" style="background-color: var(--yellow-color)"> </i>
                                        </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title" style="color: var(--yellow-color)">Общий анализ крови</h4>
                                            <p class="mb-0">Принимал специалист: <a href="" class="text-decoration-none text-danger">Иванов И. И.</a></p>
                                            <a class="text-decoration-none text-info" href="#" data-toggle="modal" data-target="#openModalInfoAnalysis">Подробнее...</a>
                                            <span class="vertical-timeline-element-date text-muted">15.04.21</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Модальное окно подробной информации об эпикризе-->
<div class="modal fade" tabindex="-1" id="openModalInfoEpicrisis">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Выписной эпикриз №1234 от 01.01.2010</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-muted">Врач: <a href="" class="text-decoration-none text-danger">Иванов И. И.</a></h5>
                <h5 class="text-muted">Специальность:
                    <span class="badge badge-pill badge-secondary">Терапевт</span>
                    <span class="badge badge-pill badge-secondary">Хирург</span>
                </h5>
                <h5 class="mb-0 text-muted text-uppercase bg-light p-2">
                    <i class="fas fa-disease mr-1"></i>
                    Диагнозы
                </h5>
                <table class="table table-striped table-hover table-sm">
                    <thead class="text-white" style="background-color: var(--cyan-color);">
                    <tr>
                        <th>Тип</th>
                        <th>МКБ</th>
                        <th>Описание</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-muted" data-label="Тип:">Основной</td>
                        <td class="text-muted" data-label="МКБ:">021</td>
                        <td class="text-muted" data-label="Описание:">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, repellat!</td>
                    </tr>
                    <tr>
                        <td class="text-muted" data-label="Тип:">Сопутствующий</td>
                        <td class="text-muted" data-label="МКБ:">023.1</td>
                        <td class="text-muted" data-label="Описание:">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, repellat!</td>
                    </tr>
                    </tbody>
                </table>
                <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Состояние
                </h5>
                <p class="text-muted">Жалобы: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, placeat.</p>
                <p class="text-muted">Анамнез: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, placeat.</p>
                <h5 class="mb-3 text-muted text-uppercase bg-light p-2">
                    <i class="fas fa-clipboard mr-1"></i>
                    Рекомендации
                </h5>
                <ul class="text-muted">
                    <li>Ограничение физических нагрузок</li>
                    <li>Ежедневная прогулка по 3000 шагов</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam assumenda consequatur cum dignissimos dolore doloremque dolores eligendi error expedita explicabo facere fuga fugiat in incidunt ipsum iusto labore laudantium magni maxime minima necessitatibus nihil nisi non nostrum odio odit officiis quaerat quas qui reprehenderit saepe, sapiente sunt suscipit veniam voluptas voluptatem voluptates. Aut dolor enim numquam quas rem. Accusamus aperiam commodi dicta eius ex fugiat laboriosam nulla, obcaecati rerum tempore unde velit veritatis voluptatibus? Amet aut consequuntur, cupiditate deleniti distinctio doloribus earum ex harum ipsam iste iusto laboriosam omnis quaerat, quibusdam, sapiente sint unde. Aspernatur assumenda cupiditate deserunt laborum nobis quo, sit tempora ullam voluptas voluptatibus. Accusamus alias aliquam eius eligendi, eum ex fugit inventore iste maxime minima natus necessitatibus nemo omnis perferendis porro quibusdam quisquam quo quos rem, sequi sint, suscipit veniam voluptatum? Accusamus accusantium adipisci aliquid atque consequatur cumque deleniti dolores enim eos impedit, nesciunt pariatur, quaerat quasi quia repellendus sunt tempora vel! Aperiam debitis delectus deserunt dolore minus modi neque nostrum praesentium quidem quod repudiandae, sint ullam? Culpa dolorem eligendi eveniet, id ipsum iste iusto maxime obcaecati qui rerum, unde velit voluptate. Id incidunt labore quisquam similique. Ad aliquam aspernatur at blanditiis consectetur cum deserunt, dolorem ea esse est eveniet, ex impedit iste laudantium magnam minus nam, nisi non nostrum nulla numquam obcaecati qui recusandae repudiandae saepe unde vel? At aut cupiditate excepturi ipsa nesciunt officiis praesentium, quia totam veniam? Asperiores deleniti est nesciunt nihil odio tempora? A accusantium animi aspernatur consequuntur cum dicta dolorum eos et, facilis illo in odit perferendis quidem repellendus tempora vel, voluptatem? Aspernatur blanditiis cumque eaque est fuga perspiciatis voluptas! Culpa est explicabo, laborum maxime odit quasi soluta ullam ut. Ab doloremque eveniet ipsa, itaque magnam magni pariatur quas quis quisquam tenetur. Consectetur dolorem eaque eveniet fugiat minus mollitia odit pariatur recusandae! Aperiam aspernatur autem beatae commodi consectetur delectus dicta distinctio dolor esse et eum fugiat fugit itaque iusto laboriosam maxime necessitatibus provident quibusdam quod, recusandae repellat rerum totam vel veniam voluptatum! Cupiditate est itaque laboriosam perspiciatis tempora veniam voluptates. Animi quam sit sunt tempore! Ea quas quos sapiente vero! Aut dicta eum harum, minima nam perferendis perspiciatis ratione repellendus! Ad aliquam assumenda beatae debitis deserunt ex hic illo labore laboriosam molestiae molestias neque nesciunt nobis nostrum odit officia, quae quaerat quisquam reiciendis repellat repudiandae sapiente sed similique sit unde? At blanditiis deserunt eveniet possimus veritatis! Animi aspernatur autem consequuntur, delectus eaque eius et facilis fugiat hic itaque libero modi nesciunt, perferendis provident quisquam ratione sint sit ullam velit veniam. Eos ipsam quo velit. Aut commodi corporis culpa dignissimos dolore, dolorem, enim, excepturi impedit magnam necessitatibus optio repudiandae sunt veniam. Accusamus consectetur eum inventore minus perspiciatis sit soluta ullam ut! Aliquid animi consequuntur deleniti excepturi ipsam minus perferendis, saepe suscipit voluptas. Amet architecto assumenda doloribus dolorum explicabo ipsum nam non perspiciatis quis quo rerum sequi tempora, voluptatem. Adipisci alias amet, aperiam aspernatur aut beatae culpa deserunt dolorum excepturi exercitationem fugiat hic inventore ipsam itaque maiores necessitatibus nemo neque odio odit omnis quasi quia quidem recusandae rem rerum sed sequi temporibus veniam voluptas voluptatem. Cupiditate dolor incidunt iusto maxime quas. Aspernatur fuga fugiat illo, laboriosam laudantium minus molestiae quaerat quis voluptate voluptatibus. Accusamus accusantium animi aspernatur consectetur consequatur deleniti dicta doloremque ducimus eum eveniet expedita id illo magni, maiores minima necessitatibus neque nostrum officia officiis perferendis porro quas qui quod ratione reiciendis rem repellat sequi similique sit totam ullam velit veritatis vitae. A accusantium ad aliquam cum delectus ducimus eius eligendi excepturi ipsam nihil, nostrum quasi qui quia suscipit voluptatum? A, aut autem debitis, delectus distinctio enim excepturi itaque nobis officia quae quas similique temporibus vero! Dolore fugiat maiores optio quae quam suscipit veritatis? Aspernatur corporis enim est in iusto minus odit ullam velit. Dicta et hic optio voluptatibus. Consequuntur dolor id laudantium molestiae, nemo nisi pariatur provident quae repellat similique, tempora vel veniam? Aliquid architecto asperiores, aspernatur culpa dolor ex in ipsam labore magni, odit officiis pariatur placeat, quo temporibus velit veniam voluptatem? Amet architecto eaque impedit nisi vero? Aspernatur eaque nam numquam reiciendis. At, blanditiis consectetur, cupiditate dignissimos distinctio dolore earum et ipsam laudantium modi molestias natus nihil nostrum numquam obcaecati qui similique sit, sunt unde vitae? Earum est in maiores molestias porro, quo suscipit vitae? Accusamus accusantium ad adipisci aliquid asperiores cum delectus dolore, enim error esse est ex excepturi illo inventore ipsam itaque iusto modi molestias nihil, numquam perspiciatis placeat quae quia recusandae sapiente sint, suscipit vero voluptate voluptates voluptatum. Blanditiis consequatur eius fugiat iste laboriosam nobis obcaecati omnis quaerat qui ut! Accusantium ad animi autem dolores dolorum error id impedit in incidunt ipsa magnam minima nam nemo nihil nisi nulla odio perferendis porro quas quia quis, quisquam ratione tempora tempore ullam unde vel voluptatum? Cumque delectus dolor doloremque qui repellat repudiandae sit suscipit. A ab accusamus aliquid aspernatur blanditiis, commodi, corporis delectus facere illo iusto libero minima modi mollitia perspiciatis provident quo sint vitae, voluptate! Ab aperiam, aspernatur autem culpa deleniti doloremque exercitationem, fuga molestias mollitia nam officiis praesentium recusandae, sint sit suscipit voluptate voluptatem? Adipisci aspernatur atque aut consequatur corporis debitis deleniti deserunt dignissimos dolor dolore doloremque dolores doloribus eligendi est eveniet facilis incidunt labore maxime modi molestiae nemo nesciunt non ratione sapiente, sed sequi similique sit temporibus tenetur veniam. Ab adipisci aliquam doloremque dolores labore quasi, qui quis repellat repudiandae soluta. Accusamus aliquam amet consequatur delectus dignissimos distinctio dolor dolores earum eius esse est expedita hic impedit iusto laborum libero maxime, nemo, nulla perspiciatis porro quae quod sequi sit. Aut beatae cum cupiditate debitis dolore, doloremque eum excepturi iste nihil provident quidem, ratione reiciendis rerum sed sit ut vel vero! A ad expedita impedit iste omnis perferendis ratione sequi vel voluptas, voluptatum. Aliquid animi delectus doloribus, enim error esse eum ipsa ipsam magnam maiores nisi placeat quae quod repellat repellendus sapiente sed temporibus tenetur vel, velit? Accusamus accusantium, aliquam amet consequatur dicta ea eum itaque quam quidem quod ratione sapiente tempora tempore totam voluptates! Accusamus ad, aliquam consectetur corporis eius expedita illum ipsum molestiae repudiandae saepe.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно подробной информации об анализе-->
<div class="modal fade" tabindex="-1" id="openModalInfoAnalysis">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Результаты обследования №1234 от 10.01.2010</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-muted">Принимал специалист: <a href="" class="text-decoration-none text-danger">Иванов И. И.</a></h5>
                <h5 class="text-muted">Название: Общий анализ крови</h5>
                <h5 class="text-muted">Результаты:</h5>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно диагнозов-->
<div class="modal fade" tabindex="-1" id="openModalDiagnoses">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Мои диагнозы</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover">
                    <thead class="text-white" style="background-color: var(--cyan-color);">
                    <tr>
                        <th>Тип</th>
                        <th>МКБ</th>
                        <th>Описание</th>
                        <th>Врач</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-muted" data-label="Тип:">Основной</td>
                        <td class="text-muted" data-label="МКБ:">021</td>
                        <td class="text-muted" data-label="Описание:">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, repellat!</td>
                        <td class="text-muted" data-label="Врач:">-</td>
                    </tr>
                    <tr>
                        <td class="text-muted" data-label="Тип:">Сопутствующий</td>
                        <td class="text-muted" data-label="МКБ:">023.1</td>
                        <td class="text-muted" data-label="Описание:">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, repellat!</td>
                        <td class="text-muted" data-label="Врач:"> Иванов И. И.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно рекомендаций-->
<div class="modal fade" tabindex="-1" id="openModalRecommendations">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Мои рекомендации</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-centered table-striped table-hover mb-0">
                        <tbody>
                        <tr>
                            <td>
                                <h5 class="my-1" style="color: var(--dark-cyan-color)">Процедура</h5>
                                <span class="text-muted">Бассейн</span>
                            </td>
                            <td>
                                <span class="text-muted">Тип</span> <br>
                                <span class="badge badge-pill text-white" style="background-color: var(--cyan-color)">Дополнительно</span>
                            </td>
                            <td>
                                <span class="text-muted">Повторы</span>
                                <h5>По желанию</h5>
                            </td>
                            <td>
                                <span class="text-muted">Порекомендовал</span>
                                <h5>Иванов И. И.</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 class="my-1" style="color: var(--dark-cyan-color)">Процедура</h5>
                                <span class="text-muted">Массаж</span>
                            </td>
                            <td>
                                <span class="text-muted">Тип</span> <br>
                                <span class="badge badge-pill text-white badge-danger">Обязательно</span>
                            </td>
                            <td>
                                <span class="text-muted">Повторы</span>
                                <h5>5</h5>
                            </td>
                            <td>
                                <span class="text-muted">Порекомендовал</span>
                                <h5>Иванов И. И.</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 class="my-1" style="color: var(--dark-cyan-color)">Самоконтроль</h5>
                                <span class="text-muted">Прогулки по 3000 шагов</span>
                            </td>
                            <td>
                                <span class="text-muted">Тип</span> <br>
                                <span class="badge badge-pill text-white badge-danger">Обязательно</span>
                            </td>
                            <td>
                                <span class="text-muted">Повторы</span>
                                <h5>Ежедневно</h5>
                            </td>
                            <td>
                                <span class="text-muted">Порекомендовал</span>
                                <h5>Иванов И. И.</h5>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<!--Модальное окно лекарств-->
<div class="modal fade" tabindex="-1" id="openModalPills">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Мои лекарства</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover">
                    <thead class="text-white" style="background-color: var(--cyan-color);">
                    <tr>
                        <th>Название</th>
                        <th>Доза</th>
                        <th>Правило приема</th>
                        <th>Повторы</th>
                        <th>Врач</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-muted" data-label="Название:">Диклофенак</td>
                        <td class="text-muted" data-label="Доза:">1/2 таблетки</td>
                        <td class="text-muted" data-label="ПП:">Во время еды</td>
                        <td class="text-muted" data-label="Повторы:">3 раза в день</td>
                        <td class="text-muted" data-label="Врач:">Иванов И. И.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
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

    $(document).ready(function() {
        $('input[type=checkbox]').change(function() {

            if (this.checked) {
                $(this).next().css("text-decoration-line", "line-through");
            } else {
                $(this).next().css("text-decoration-line", "none");
            }

        });
    });

</script>
</html>