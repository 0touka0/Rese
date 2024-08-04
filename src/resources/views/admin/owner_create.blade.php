<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>店舗代表者作成</title>
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="stylesheet" href="{{ asset('css/admin/owner_create.css') }}">
</head>
<body>
	<header>
		<h3 class="header__title">店舗代表者作成</h3>
		<nav class="header__nav">
			<ul class="header__nav-list">
				<li class="header__nav-item">
					<a class="header__nav-item--link" href="/login">ログイン</a>
				</li>
			</ul>
		</nav>
	</header>
	<main>
		@if (session('message'))
		<p class="success-message">
			{{ session('message') }}
		</p>
		@endif
		<form class="owner-form" action="/register" method="post">
			@csrf
			<div class="owner-form__inner">
				<div class="owner-form__lists">
					<label class="owner-form__lists-label" for="name">氏名</label>
					<input class="owner-form__lists-input" id="name" type="text" name="name">
					<p class="error-message" >
						@error('name')
							{{ $message }}
						@enderror
					</p>
				</div>
				<div class="owner-form__lists">
					<label class="owner-form__lists-label" for="email">メールアドレス</label>
					<input class="owner-form__lists-input" id="email" type="email" name="email">
					<p class="error-message">
						@error('email')
							{{ $message }}
						@enderror
					</p>
				</div>
				<div class="owner-form__lists">
					<label class="owner-form__lists-label" for="password">パスワード</label>
					<input class="owner-form__lists-input" id="password" type="password" name="password">
					<p class="error-message">
						@error('password')
							{{ $message }}
						@enderror
					</p>
				</div>
				<div class="owner-form__btn">
					<input type="hidden" name="role" value="2">
					<button class="owner-form__btn--submit" type="submit">送信</button>
				</div>
			</div>
		</form>
	</main>
</body>
</html>