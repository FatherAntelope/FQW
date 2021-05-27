<!--

-->

<!--Модальное окно поддержки-->
<div class="modal fade" id="openModalSendMessageSupport">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="color: var(--cyan-color)">Задайте вопрос</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="querySendMsgSupport">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style="color: var(--yellow-color)">Ваше имя</label>
                                <input type="text" class="form-control" name="user_name" value="<?php echo ($whose_user === 0) ? "" : $user_data['name'] ?>" <?php echo ($whose_user === 0) ? "" : "disabled"?> required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style="color: var(--yellow-color)">Ваша почта</label>
                                <input type="email" class="form-control" name="user_email" value="<?php echo ($whose_user === 0) ? "" : $user_data['email'] ?>" <?php echo ($whose_user === 0) ? "" : "disabled"?> required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label style="color: var(--yellow-color)">Тема сообщения</label>
                                <input type="text" class="form-control" name="user_message_subject" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label style="color: var(--yellow-color)">Сообщение</label>
                                <textarea class="form-control" name="user_message" required></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="alert alert-success animate slideIn" role="alert" style="font-size: 12px" id="alertSuccessSendMsgSupport" hidden>
                        Ваше сообщение отправлено службе поддержки. Ответ придет на указанную почту в течение нескольких дней
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info text-white mr-1" style="background-color: var(--cyan-color)" form="querySendMsgSupport">
                    <i class="fas fa-envelope mr-1"></i> Отправить
                </button>
            </div>
        </div>
    </div>
</div>

<!--Футер (нижний блок)-->
<footer style="background-color: var(--cyan-color)">
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <?php if($whose_user === 0) { ?>
                <div class="row align-items-center">
                    <div class="col-lg-10">
                        <h3 class="mb-2" style="color: var(--yellow-color)">
                            Быстрый запуск
                        </h3>
                        <p class="lead mb-0 text-white opacity-8">
                            Увеличьте качество лечения в санатории, предоставляющем вам свои услуги уже сейчас
                        </p>
                    </div>
                    <div class="col-lg-2 text-lg-right mt-4 mt-lg-0">
                        <a href="/auth.php" class="btn btn-warning btn-icon my-2 text-secondary" style="background-color: var(--yellow-color)">
                            Приступить
                        </a>
                    </div>
                </div>

                <hr style="border-top: 3px solid var(--yellow-color);">
                <?php } ?>


                <div class="row">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <a href="/" class="text-decoration-none">
                            <div class="d-flex">
                                <img src="/images/logo-mini.png" alt="" height="40">
                                <div class="ml-2 d-flex justify-content-center flex-column">
                                    <h5 class="text-uppercase mb-0 pb-0" style=" font-family: 'PT Serif', serif; font-family: 'Source Serif Pro', serif; color: var(--yellow-color)"><? echo web_name_header; ?></h5>
                                    <span class="text-white" style="font-size: 12px; font-family: 'PT Serif', serif; font-family: 'Source Serif Pro', serif;"><? echo web_name_span; ?></span>
                                </div>
                            </div>
                        </a>
                        <p class="mt-2 text-white opacity-8 pr-lg-4">
                            Медицинская информационная система для повышения эффективности процесса рекреации в санатории, мобильности и оперативности информационной поддержки
                        </p>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="tel:<?php echo contact_number; ?>" aria-haspopup="true">
                                    <h4><i class="fas fa-phone mr-1"></i> <?php echo contact_number; ?></h4>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:<?php echo email_info; ?>" aria-haspopup="true">
                                    <i class="fas fa-envelope-open-text mr-1"></i>
                                    <?php echo email_info; ?>
                                </a>
                            </li>
                            <li>
                                <a href="https://yandex.ru/maps/geo/ufa/53105309/?ll=56.037733%2C54.730300&source=wizbiz_new_map_single&z=9.92" aria-haspopup="true">
                                    <i class="fas fa-map-marked-alt mr-1"></i>
                                    <?php echo contact_address; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 ml-lg-auto mb-5 mb-lg-0">
                        <h6 class="heading mb-3" style="font-weight: 700 ;color: var(--yellow-color)">Аккаунт</h6>
                        <?php if($whose_user === 0) { ?>
                            <ul class="list-unstyled link-none">
                                <li>
                                    <a href="/auth.php">Авторизация</a>
                                </li>
                            </ul>
                        <?php } elseif ($whose_user === 1) {  ?>
                            <ul class="list-unstyled link-none">
                                <li>
                                    <a href="/lk/">Профиль</a>
                                </li>
                                <li>
                                    <a href="#">Чат</a>
                                </li>
                                <li>
                                    <a href="#">Новости</a>
                                </li>
                                <li>
                                    <a href="#">Питание</a>
                                </li>
                                <li>
                                    <a href="/lk/services/editor.php?selected=specializations">Услуги</a>
                                </li>
                                <li>
                                    <a href="/lk/users/">Пользователи</a>
                                </li>
                                <li>
                                    <a href="#">Анкетирование</a>
                                </li>
                                <li>
                                    <a href="#">FAQ's</a>
                                </li>
                                <li>
                                    <a href="/lk/settings/">Настройки</a>
                                </li>
                            </ul>
                        <?php } elseif ($whose_user === 2) { ?>
                            <ul class="list-unstyled link-none">
                                <li>
                                    <a href="/lk/">Профиль</a>
                                </li>
                                <li>
                                    <a href="#">Чат</a>
                                </li>
                                <li>
                                    <a href="/lk/medcard/">Медицинская карта</a>
                                </li>
                                <li>
                                    <a href="#">Дневник самонаблюдения</a>
                                </li>
                                <li>
                                    <a href="/lk/services/">Услуги</a>
                                </li>
                                <li>
                                    <a href="#">Органайзер</a>
                                </li>
                                <li>
                                    <a href="/lk/settings/">Настройки</a>
                                </li>
                            </ul>
                        <?php } elseif ($whose_user === 3) { ?>
                            <ul class="list-unstyled link-none">
                                <li>
                                    <a href="/lk/">Профиль</a>
                                </li>
                                <li>
                                    <a href="#">Чат</a>
                                </li>
                                <li>
                                    <a href="/lk/patients/">Пациенты</a>
                                </li>
                                <li>
                                    <a href="#">Органайзер</a>
                                </li>
                                <li>
                                    <a href="/lk/settings/">Настройки</a>
                                </li>
                            </ul>
                        <?php } ?>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                        <h6 class="heading mb-3" style="font-weight: 700 ;color: var(--yellow-color)">Санаторий</h6>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="/news.php">Новости</a>
                            </li>
                            <li>
                                <a href="#">Галерея</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                        <h6 class="heading mb-3" style="font-weight: 700 ;color: var(--yellow-color)">Помощь</h6>
                        <ul class="list-unstyled link-none">
                            <li>
                                <a href="/FAQ/">FAQ</a>
                            </li>
                            <li>
                                <a href="#" data-toggle="modal" data-target="#openModalSendMessageSupport">Поддержка</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <hr style="border-top: 3px solid var(--yellow-color);">

                <div class="row justify-content-center align-items-center">
                    <div class="text-white">
                        <p>©2021 <? echo web_name_header; ?>. Все права защищены</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>
<script>
    $("#querySendMsgSupport").submit(function () {
        $.ajax({
            url: "/queries/sendMsgSupport.php",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                $("#querySendMsgSupport").attr("hidden", "hidden");
                $("#alertSuccessSendMsgSupport").removeAttr("hidden");
            },
            error: function () {
            }
        });
        return false;
    });
</script>