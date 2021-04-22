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

	<link href='/css/fullcalendar/main.css' rel='stylesheet' />
	<script src='/js/fullcalendar/main.js'></script>
	<title>HeartBlaze</title>
</head>

<body>
<!--Меню для авторизованного пользователя-->
<nav class="navbar fixed-top navbar-expand-sm navbar-light p-0" style="background: var(--cyan-color);">
	<div class="container">
<!--Бургер-кнопка для развертывания панели навигации в мобильном формате-->
		<button class="navbar-toggler ml-3" data-toggle="collapse" data-target="#offcanvas" style="background: var(--yellow-color)">
			<i class="fas fa-bars" style="color: #fff"></i>
		</button>

<!--Иконка бренда (мини) в мобильном формате-->
		<a class="navbar-brand" id="logo-small" href="#">
			<img src="/images/logo-mini.png" alt="" height="40">
		</a>

<!--Иконка бренда (мини) в широком формате-->
		<a class="navbar-brand" id="logo-big" href="#">
			<img src="/images/logo.png" alt="" height="40">
		</a>

<!--Содержимое меню-->
		<ul class="nav">
<!--Раздел новостей-->
			<li>
				<a class="nav-link arrow-none notify-icon" href="#">
					<i class="bi bi-newspaper"></i>
				</a>
			</li>
<!--Раздел уведомлений-->
			<li class="dropdown">
<!--Кнопка для развертывания выпадающего меню с уведомлениями-->
				<a class="nav-link arrow-none notify-icon" href="#" id="dropdown-notify" data-toggle="dropdown">
					<i class="bi bi-bell-fill"></i>
					<span class="notify-icon-dot">
						<i class="bi bi-circle-fill" style="color: var(--red--color)"></i>
					</span>
				</a>
<!--Выпадающее меню с уведомлениями-->
				<div class="dropdown-menu dropdown-menu-right animate slideIn m-0"
					 style="min-width: 30rem;" aria-labelledby="dropdown-notify">
					<div class="dropdown-header">
						<h6 style="position: relative">
							<span class="float-right">
								<a href="#" class="text-danger text-decoration-none">
									<small>Очистить</small>
								</a>
							</span>
							<span>Уведомления</span>
						</h6>
					</div>
					<hr class="m-0">
					<div class="notifications-scrollbar">
<!--Список уведомлений-->
						<div class="notifications">
							<div class="notification">
								<div class="notification-icon">
									<i class="bi bi-credit-card-2-back-fill" style="color: #fff; background-color: var(--dark-cyan-color)"></i>
								</div>
								<div class="content">
									<a class="header stretched-link" href="#">"Тип уведомления"</a>
									<div class="text">"Описание уведомления"</div>
									<div class="actions">
										<p>"10.10.2000"</p>
									</div>
								</div>
							</div>
							<div class="notification">
								<div class="notification-icon">
									<i class="bi bi-credit-card-2-back-fill" style="color: #fff; background-color: var(--dark-cyan-color)"></i>
								</div>
								<div class="content">
									<a class="header stretched-link" href="#">"Тип уведомления"</a>
									<div class="text">"Описание уведомления"</div>
									<div class="actions">
										<p>"10.10.2000"</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>
<!--Раздел пользовательской панели-->
			<li class="dropdown">
<!--Кнопка развертывания выпадающего меню со списком управления пользовательской панелью-->
				<a class="nav-link arrow-none nav-user" href="#" id="dropdown-menu-user" data-toggle="dropdown">
					<span class="account-user-avatar">
						<img src="/images/user.png" alt="user-image" class="rounded-circle" height="40">
					</span>
					<span>
						<span class="account-user-name">"Имя Фамилия"</span>
						<span class="account-role">"Роль"</span>
					</span>
				</a>
<!--Выпадающее меню со списком управления пользовательской панелью-->
				<div class="dropdown-menu dropdown-menu-right animate slideIn" style="margin: 0" aria-labelledby="dropdown-menu-user">
					<a class="dropdown-item" href="#" style="color: var(--dark-cyan-color)">
						<i class="fas fa-id-card mr-2"></i>
						Профиль
					</a>
					<a class="dropdown-item" href="#" style="color: var(--dark-cyan-color)">
						<i class="fas fa-cog mr-2"></i>
						Настройки
					</a>
					<a class="dropdown-item" href="#" style="color: var(--dark-cyan-color)">
						<i class="fas fa-door-open mr-2"></i>
						Выйти
					</a>
				</div>
			</li>
		</ul>
	</div>
</nav>

<!--Панель навигации по модулям пользователя-->
<div class="topnav shadow-lg fixed-top" style="top: 3.7rem">
	<div class="container">
		<nav class="navbar navbar-expand-lg topnav-menu">
			<div class="collapse navbar-collapse justify-content-center" id="offcanvas">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="#" class="nav-link link-navbar" aria-haspopup="true">
							<i class="fas fa-id-card mr-1"></i>
							Профиль
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link link-navbar disabled" aria-haspopup="true">
							<i class="fas fa-comments mr-1"></i>
							Чат
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link link-navbar" aria-haspopup="true">
							<i class="fas fa-book-medical mr-1"></i>
							Медицинская карта
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link link-navbar" aria-haspopup="true">
							<i class="fas fa-heartbeat mr-1"></i>
							Дневник самонаблюдения
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link link-navbar" aria-haspopup="true">
							<i class="fas fa-procedures mr-1"></i>
							Услуги
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link link-navbar" aria-haspopup="true">
							<i class="fas fa-calendar-alt mr-1"></i>
							Органайзер
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>



<div class="page-content">
	<div class="container pt-3 pb-3">
		<div id='calendar'></div>
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
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" id="addEventButton" class="btn btn-primary">Добавить событие</button>
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
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" id="addEventButton" class="btn btn-primary">Добавить событие</button>
			</div>
 		</div>
	</div>
</div>

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