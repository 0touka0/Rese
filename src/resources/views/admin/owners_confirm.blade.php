<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>店舗代表者一覧</title>
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="stylesheet" href="{{ asset('css/admin/owners_confirm.css') }}">
</head>
<body>
	<header>
		<h3 class="header__title">店舗代表者一覧</h3>
		<nav class="header__nav">
			<ul class="header__nav-list">
				<li class="header__nav-item">
					<a class="header__nav-item--link" href="/mail">メール配信</a>
				</li>
				<li class="header__nav-item">
					<a class="header__nav-item--link" href="/admin">新規作成</a>
				</li>
			</ul>
		</nav>
	</header>
	<main>
		<table class="owners-table">
			<tr class="owners-table__tr">
				<th class="owners-table__th">id</th>
				<th class="owners-table__th">代表者名</th>
				<th class="owners-table__th">店舗名一覧</th>
				<th class="owners-table__th">登録日</th>
			</tr>
			{{-- 以下繰り返し --}}
			@foreach ($shops as $shop)
				<tr class="owners-table__tr">
					<td class="owners-table__td">{{ $shop->id }}</td>
					<td class="owners-table__td">{{ $shop->user->name}}</td>
					<td class="owners-table__td">{{ $shop->name }}</td>
					<td class="owners-table__td">{{ $shop->created_at->format('Y年 n月 j日') }}</td>
				</tr>
			@endforeach
		</table>
	</main>
</body>
</html>