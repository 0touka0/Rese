<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>新規店舗作成</title>
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="stylesheet" href="{{ asset('css/owner/shop_create.css') }}">
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
		<form class="shopCreate-form" action="/newshop/store" method="post">
			@csrf
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
					<button class="shopCreate-form__btn--submit" type="submit">作成</button>
				</div>
			</div>
		</form>
	</main>
</body>
</html>