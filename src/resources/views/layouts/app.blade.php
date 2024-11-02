<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Rese</title>
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="stylesheet" href="{{ asset('css/layouts/common.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	@yield('css')
</head>
<body>
	<header class="header">
		<div class="header-logo">
			<button id="modal-open"><i class="fa-solid fa-bars-staggered"></i></button>
			<h1 class="header-title">Rese</h1>
		</div>
		@yield('search-form')
		<div id="header-modal" class="modal">
			<div class="modal__content">
				<p class="header-modal__close">&times;</p>
				<nav class="header-modal__nav">
					<ul class="header-modal__list">
						<li class="header-modal__item">
							<a class="header-modal__link" href="/">Home</a>
						</li>
						@if (auth()->check())
							<li class="header-modal__item">
								<form class="header-modal__form" action="/logout" method="post">
									@csrf
									<button type="submit" class="header-modal__btn">Logout</button>
								</form>
							</li>
							<li class="header-modal__item">
								<form class="header-modal__form" action="/mypage/{{ auth()->user()->id }}" method="get">
									@csrf
									<button type="submit" class="header-modal__btn">Mypage</button>
								</form>
							</li>
						@else
							<li class="header-modal__item">
								<a class="header-modal__link" href="/register">Registration</a>
							</li>
							<li class="header-modal__item">
								<a class="header-modal__link" href="/login">Login</a>
							</li>
						@endif
					</ul>
				</nav>
			</div>
			<script src="{{ asset('js/headerModal.js') }}"></script>
		</div>
	</header>
	<main class="main">
		@yield('content')
	</main>
	@yield('reservation-form')
	@yield('scripts')
</body>
</html>