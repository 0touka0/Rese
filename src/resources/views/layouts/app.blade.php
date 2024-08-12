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
		<div class="header__logo">
			<button id="header-openModal"><i class="fa-solid fa-bars-staggered"></i></button>
			@yield('header-script')
			<h1 class="header__title">Rese</h1>
		</div>
		@yield('search-form')
	</header>
	<div class="content">
		@yield('content')
	</div>
	@yield('reservation-form')
</body>
</html>