<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>店舗一覧</title>
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="stylesheet" href="{{ asset('css/owner/shops_confirm.css') }}">
</head>
<body>
	<header>
		<h3 class="header__title">店舗一覧</h3>
		<nav class="header__nav">
			<ul class="header__nav-list">
				<li class="header__nav-item">
					<a class="header__nav-item--link" href="">予約一覧</a>
				</li>
				<li class="header__nav-item">
					<a class="header__nav-item--link" href="/newshop">新規作成</a>
				</li>
			</ul>
		</nav>
	</header>
	<main>
		<table class="shops-table">
			<tr class="shops-table__tr">
				<th class="shops-table__th">id</th>
				<th class="shops-table__th">店舗名</th>
				<th class="shops-table__th">地域</th>
				<th class="shops-table__th">ジャンル</th>
				<th class="shops-table__th">店舗概要</th>
				<th class="shops-table__th"></th>
			</tr>
			{{-- 以下繰り返し --}}
			@foreach ($shops as $shop)
				<tr class="shops-table__tr">
					<td class="shops-table__td">{{$shop->id}}</td>
					<td class="shops-table__td">{{$shop->name}}</td>
					<td class="shops-table__td">{{$shop->address}}</td>
					<td class="shops-table__td">{{$shop->category}}</td>
					<td class="shops-table__td">{{$shop->overview}}</td>
					<td class="shops-table__td"><a class="shops-table__td--link" href="/shopedit{{$shop->id}}">編集</a></td>
				</tr>
			@endforeach
		</table>
	</main>
</body>
</html>