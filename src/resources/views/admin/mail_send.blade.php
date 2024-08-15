<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>メール配信</title>
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="stylesheet" href="{{ asset('css/admin/mail_send.css') }}">
</head>
<body>
	<header>
		<h3 class="header__title">メール配信</h3>
		<nav class="header__nav">
			<ul class="header__nav-list">
				<li class="header__nav-item">
					<a class="header__nav-item--link" href="/owners">戻る</a>
				</li>
			</ul>
		</nav>
	</header>
	<main>
		<form class="mail-form" action="" method="post">
			<div class="mail-form__inner">
				<div class="mail-form__item">
					<label class="mail-form__label" for="sendTo">送信対象</label>
					<select class="mail-form__text" name="name" id="sendTo">
						<option value=""></option>
						<option value="">全体</option>
					</select>
				</div>
				<div class="mail-form__item">
					<label class="mail-form__label" for="subject">件名</label>
					<input class="mail-form__text" type="text" id="subject">
				</div>
				<div class="mail-form__item">
					<label class="mail-form__label" for="contents">内容</label>
					<textarea class="mail-form__text" name="contents" id="contents" cols="30" rows="6"></textarea>
				</div>
				<div class="mail-form__btn">
					<button class="mail-form__btn--submit" type="submit">配信</button>
				</div>
			</div>
		</form>
	</main>
</body>
</html>