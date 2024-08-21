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
		@if (session('success'))
			{{ session('success') }}
		@endif
		<form class="mail-form" action="{{ route('sendMail') }}" method="post">
			@csrf
			<div class="mail-form__inner">
				<div class="mail-form__item">
					<label class="mail-form__label" for="sendTo">送信対象</label>
					<select class="mail-form__text" name="recipient" id="sendTo">
						<option value="">選択</option>
						<option value="allOwners">全店舗代表者</option>
						<option value="allUsers">全利用者</option>
					</select>
				</div>
				<div class="mail-form__item">
					<label class="mail-form__label" for="subject">件名</label>
					<input class="mail-form__text" type="text" name="subject" id="subject">
				</div>
				<div class="mail-form__item">
					<label class="mail-form__label" for="message">内容</label>
					<textarea class="mail-form__text" name="message" id="message" cols="30" rows="6"></textarea>
				</div>
				<div class="mail-form__btn">
					<button class="mail-form__btn--submit" type="submit">配信</button>
				</div>
			</div>
		</form>
	</main>
</body>
</html>