<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>店舗詳細</title>
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="stylesheet" href="{{ asset('css/owner/shops_edit.css') }}">
</head>
<body>
	<header>
		<nav class="header__nav">
			<ul class="header__nav-list">
				<li class="header__nav-item">
					<a class="header__nav-item--link" href="/shopsconfirm">戻る</a>
				</li>
			</ul>
		</nav>
	</header>
	<main>
		<form class="shopCreate-form" action="/newshop/put" method="post">
			@csrf
			@method('PUT')
			<div class="shopCreate-form__inner">
				<div class="shopCreate-form__item">
					<label class="shopCreate-form__label" for="shopName">店名</label>
					<input class="shopCreate-form__text" type="text" name="name" id="shopName">
				</div>
				<div class="shopCreate-form__item">
					<label class="shopCreate-form__label" for="address">地域</label>
					<input class="shopCreate-form__text" type="text"name="address" id="address">
				</div>
				<div class="shopCreate-form__item">
					<label class="shopCreate-form__label" for="category">ジャンル</label>
					<input class="shopCreate-form__text" type="text" name="category" id="category">
				</div>
				<div class="shopCreate-form__item">
					<label class="shopCreate-form__label" for="overview">店舗概要</label>
					<textarea class="shopCreate-form__text" name="overview" id="overview" cols="30" rows="6"></textarea>
				</div>
				<div class="shopCreate-form__btn">
					<button class="shopCreate-form__btn--submit" type="submit">編集</button>
				</div>
			</div>
		</form>
	</main>
</body>
</html>