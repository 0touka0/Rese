<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="stylesheet" href="{{ asset('css/layouts/admin_common.css') }}">
	@yield('css')
</head>
<body>
	<header class="header">
		<h1 class="header__title">@yield('header_title')</h1>
		<nav class="header__nav">
			@yield('header_nav')
		</nav>
	</header>
	<main class="main">
		@yield('content')
	</main>

	@yield('scripts')
</body>
</html>