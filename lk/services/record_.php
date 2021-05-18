<?php
$whose_user = 2;
$weeks = [ "Mon"=> "Пн" , "Tue" => "Вт" , "Wed" => "Ср" , "Thu" => "Чт" , "Fri" => "Пт" , "Sat" => "Сб",  "Sun" =>"Вс"];
$days_num = 7; //количество
$time_start = "8:00"; //время старта
$time_span = 15; //минуты
$count_records = 10; //количество
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
    <link rel="stylesheet" href="/css/record.css">

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
                <li class="breadcrumb-item active" aria-current="page">Запись к ...</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                <!--Контент-->
                <div class="card-body__table" id="card-body__table">
                    
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


<div class="popup popup_record" id="popup_record">
    <form class="popup__container">
        <div class="popup_record__name" style="color: var(--dark-cyan-color);">Регистрация записи на услугу</div>
        <div class="popup_record__doctor" id="popup_record__doctor"></div>
        <div class="popup_record__content">
            <div class="popup_record__row">
                <div class="popup_record__ceil">Специальность</div>
                <div class="popup_record__ceil" id="popup__field__special"></div>
            </div>
            <div class="popup_record__row">
                <div class="popup_record__ceil">Врач</div>
                <div class="popup_record__ceil" id="popup__field__doctor"></div>
            </div>
            <div class="popup_record__row">
                <div class="popup_record__ceil">Мед. организация</div>
                <div class="popup_record__ceil" id="popup__field__organization"></div>
            </div>
            <div class="popup_record__row">
                <div class="popup_record__ceil">Адрес</div>
                <div class="popup_record__ceil" id="popup__field__adress"></div>
            </div>
            <div class="popup_record__row">
                <div class="popup_record__ceil">Дата и время</div>
                <div class="popup_record__ceil" id="popup__field__time"></div>
            </div>
            <div class="popup_record__row">
                <div class="popup_record__ceil">Примечание врача</div>
                <div class="popup_record__ceil" id="popup__field__note"></div>
            </div>
            <div class="popup_record__row">
                <div class="popup_record__ceil">Когда напомнить</div>
                <select class="popup_record__select">
                    <option value="За сутки">За сутки</option>
                    <option value="За сутки">За сутки</option>
                    <option value="За сутки">За сутки</option>
                    <option value="За сутки">За сутки</option>
                </select>
            </div>
            <div class="popup_record__row">
                <div class="popup_record__ceil">Напоминание</div>
                <div class="popup_record__ceil">
                    <label class="popup_record__label">
                        <input type="checkbox">
                        <span> по эл. почте</span>
                    </label>
                    <label class="popup_record__label">
                        <input type="checkbox">
                        <span> по СМС</span>
                    </label>
                    <label class="popup_record__label">
                        <input type="checkbox">
                        <span> в мобильном приложении </span>
                    </label>
                </div>
            </div>
            <div class="popup_record__rules">
                <label class="popup_record__rules__label">
                    <input type="checkbox" require>
                    <span>Согласен с правилами</span>
                </label>
                <div class="popup_record__rules__text">Если не
                    сможете посетить врача в выбранное время, пожалуйста,
                    отмените прием
                </div>
            </div>
            <div class="popup_record__buttons">
                <button type="submit" class="btn btn-info text-white mr-1" style="background-color: var(--cyan-color); margin-right: 20px;">
                    <i class="fas fa-envelope mr-1"></i> Подтвердить
                </button>
                <button type="button" class="btn btn-info mr-1" style="background-color: white">
                    Отменить
                </button>
            </div>
            <div class="popup_record__attention">
                Нажимая "Подтвердить", я принимаю условия <a href="/">пользовательское соглашение, положения о защите персональных данных</a> и даю свое согласие на обработку персональных данных</a>
            </div>
        </div>
</div>

<!--Футер (нижний блок)-->
<?php require $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</body>
<script>
    $('#notificationToast').toast('show');
</script>
<script>
    document.addEventListener('DOMContentLoaded',  () => {
        const DATENOW = new Date();
        console.log(DATENOW.getDate())
        const FROMAPI = {
            <?php for($i = 0; $i < $days_num; $i++) {?>
            '<?php echo date("d.m", time() + 86400 * $i)." ".$weeks[date("D", time() + 86400 * ($i))]; ?> ' : [
                <?php
                //past, busy, empty
                for($j = 0; $j < $count_records; $j++) { ?>
                {
                    time: '<? echo date("H:i", strtotime('+'.$time_span * $j.' min', strtotime($time_start))); ?>',
                    flag: 'busy',
                    id: '1',
                },
                <?php } ?>
            ],
            <? } ?>
        }
        for(let key in FROMAPI){
            const TABLE = document.getElementById('card-body__table')
            if(FROMAPI.hasOwnProperty(key)){
                //создаем элемент столбца
                let row = document.createElement('div')
                row.classList.add('card-body__row')

                //создаем элемент главной ячейки
                let ceilHead = document.createElement('div')
                ceilHead.classList.add('card-body__ceil');
                ceilHead.classList.add('head');
                ceilHead.innerHTML = key

                //вставляем ячейку в столбец
                row.append(ceilHead)

                //вставляем столбец на страницу
                TABLE.append(row)

                FROMAPI[key].forEach(element => {
                    let ceil = document.createElement('div')
                    ceil.classList.add('card-body__ceil');

                    if(element.flag && element.flag != ''){
                        ceil.classList.add(element.flag)
                    }
                    if(element.time && element.time != ''){
                        ceil.innerHTML = element.time
                    }
                    if(element.id && element.id != ''){
                        ceil.id = element.id
                    }
                    row.append(ceil)

                })
            }
        }

        document.addEventListener('click', (event) => {
            if(event.target.classList.contains('card-body__ceil')){
                const POPUPOBJ = {
                    'Услуга':'Запись к врачу',
                    'Специальность': 'Специальность',
                    'Врач': 'Врач',
                    'Мед. организация': 'Мед. организация',
                    'Адрес': 'Адрес',
                    'Дата и время': 'Дата и время',
                    'Примечание врача': 'Примечание врача',
                }

                let popup = document.getElementById('popup_record')
                document.getElementById('popup_record__doctor').innerText = POPUPOBJ['Услуга']
                document.getElementById('popup__field__special').innerText = POPUPOBJ['Специальность']
                document.getElementById('popup__field__doctor').innerText = POPUPOBJ['Врач']
                document.getElementById('popup__field__organization').innerText = POPUPOBJ['Мед. организация']
                document.getElementById('popup__field__adress').innerText = POPUPOBJ['Адрес']
                document.getElementById('popup__field__time').innerText = POPUPOBJ['Дата и время']
                document.getElementById('popup__field__note').innerText = POPUPOBJ['Примечание врача']

                popup.classList.add('active')
            }
        })

        // let close = document.getElementsByClassName('popup__exit')
        // Array.from(close).forEach(element => {
        //     element.addEventListener('click', function(){
        //         element.closest('.popup').classList.remove('active')
        //     })
        // })
    })

</script>
</html>