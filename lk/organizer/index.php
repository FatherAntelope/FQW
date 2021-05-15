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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
	<script defer src="/js/all.js"></script>

	<link href='/css/fullcalendar/main.css' rel='stylesheet' />
	<script src='/js/fullcalendar/main.js'></script>
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
                <li class="breadcrumb-item active" aria-current="page">Органайзер</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                <div id='calendar'></div>
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

<!-- Добавление события -->
<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ... -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                <button type="button" id="addEventButton" class="btn btn-success">Добавить событие</button>
            </div>
        </div>
    </div>
</div>

<!-- Редактирование события -->
<div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ... -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                <button type="button" id="addEventButton" class="btn btn-success">Добавить событие</button>
            </div>
        </div>
    </div>
</div>

<!--Футер (нижний блок)-->
<?php require $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'ru',
            themeSystem:'bootstrap',
            firstDay: 1,
            navLinks: true,
            selectable: true,
            editable: true,
            weekNumbers: true,
            weekText: 'Н',
            weekNumberFormat: { week: 'short' },
            dateClick: function(info) {
                alert('Date: ' + info.dateStr);
            },

            // footerToolbar: true,
            headerToolbar: {
                start: 'prevYear,nextYear',
                center: 'title',
                end: 'today prev,next dayGridMonth,dayGridWeek,timeGridDay,listWeek',
            },
            buttonIcons: {
                prev: 'left-single-arrow',
                next: 'right-single-arrow',
                prevYear: 'left-double-arrow',
                nextYear: 'right-double-arrow',
            },
            buttonText: {
                today: 'Сегодня',
                month: 'Месяц',
                week: 'Неделя',
                day: 'День',
                list: 'Список',
            },
            events: [
                {
                    title: "example",
                    start: "2020-04-21",
                    end: "2020-04-21",
                }
            ],
            eventDrop: function(info) {
                alert(info.event.title + " was dropped on " + info.event.start.toISOString());
                if (!confirm("Are you sure about this change?")) {
                    info.revert();
                }
            },
            noEventsContent: 'Cобытий нет',
            allDayText: 'На весь день',
        });
        calendar.render();
    });
</script>
<script>
$('#notificationToast').toast('show');
</script>
<script>
function addLeadingZero(number) {
	if (number < 10) {
		return '0' + number;
	}
	return number;
}

function makeDateStr(dateObj) {
	// dd/mm/yyyy
	var day, month, year;
	day = addLeadingZero(dateObj.getDate());
	month = addLeadingZero(dateObj.getMonth());
	year = dateObj.getFullYear();
	return day + '/' + month + '/' + year;
}

function makeTimeStr(dateObj) {
	var hours, minutes;
	if (dateObj.getHours() < 10) {
		hours = '0';
	}
	hours += dateObj.getHours().toString();

	if (dateObj.getMinutes() < 10) {
		minutes = '0';
	}
	minutes += dateObj.getMinutes().toString();
	return hours + ':' + minutes
}

document.addEventListener('DOMContentLoaded', function() {
	var calendarEl = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarEl, {
		locale: 'ru',
		// themeSystem:'bootstrap',
		firstDay: 1,
		navLinks: true,
		// navLinkDayClick: function(date, jsEvent) {
		// 	console.log('day', date.toISOString());
		// 	console.log('coords', jsEvent.pageX, jsEvent.pageY);
		// },
		selectable: true,
		editable: true,
		weekNumbers: true,
		displayEventTime: true,
		weekText: 'Н',
		weekNumberFormat: { week: 'short' },
		dateClick: function(info) {
			var modal = $('#addEventModal');
			modal.find('#addEventModalLabel').text('Добавление события на ' + info.dateStr);
			modal.modal('show');
		},

		footerToolbar: true,
		headerToolbar: {
			start: 'prevYear,nextYear',
			center: 'title',
			end: 'today prev,next dayGridMonth,timeGridWeek,timeGridDay,listWeek',
		},
		slotLabelFormat:
		{
			hour: 'numeric',
			minute: '2-digit',
			omitZeroMinute: false,
		},
		views: {
			timeGridWeek: {
				type: 'timeGrid',
				duration: { days: 7 },
				buttonText: 'Неделя',
			}
		},
		buttonText: {
			today: 'Сегодня',
			month: 'Месяц',
			week: 'Неделя',
			day: 'День',
			list: 'Список',
		},
		events: [
			{
				title: "example",
				description: "Описание события",
				start: "2021-04-21",
				end: "2021-04-21",
			},
		],
		eventClick: function(info) {
			var modal = $('#editEventModal');
			
			var start = info.event.start;
			var end = info.event.end;

			var eventDateDurationStr = makeDateStr(start) + ' (' + makeTimeStr(start) +')';
			if (end != null) {
				eventDateDurationStr += ' - ' + makeDateStr(end);
			};

			modal.find('#editEventModalLabel').text('Редактирование события ' + eventDateDurationStr);
			modal.modal('show');
		},
		eventMouseEnter: function(info) {
			info.el.style.borderColor = 'red';
		},
		eventMouseLeave: function(info) {
			info.el.style.borderColor = 'blue';
		},

		eventDidMount: function(info) {
			$(info.el).tooltip({
				title: info.event.extendedProps.description,
				placement: "top",
				trigger: "hover",
				container: "body"
			});
		},
		eventDrop: function(info) {
			// alert(info.event.title + " was dropped on " + info.event.start.toISOString());
			// if (!confirm("Are you sure about this change?")) {
			// 	info.revert();
			// }
		},
		noEventsContent: 'Cобытий нет',
		allDayText: 'На весь день',
	});
	calendar.render();
});
</script>
</html>