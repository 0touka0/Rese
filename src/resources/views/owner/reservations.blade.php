<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>予約一覧</title>
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="stylesheet" href="{{ asset('css/owner/reservations.css') }}">
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
	<div class="reservations">
		<div class="reservations-daily">
			<a class="reservations-daily__icon" href="{{ route('reservations', ['date' => $date->format('Y-m-d'), 'action' => 'previous']) }}"><</a>
			<span class="reservations-daily__date">{{ $formattedDate }}</span>
			<a class="reservations-daily__icon" href="{{ route('reservations', ['date' => $date->format('Y-m-d'), 'action' => 'next']) }}">></a>
		</div>
		<table class="reservations-table">
			<tr class="reservations-table__tr">
				<th class="reservations-table__th">予約者名</th>
				<th class="reservations-table__th">時間</th>
				<th class="reservations-table__th">人数</th>
				<th class="reservations-table__th">店舗名</th>
			</tr>
			@foreach ($reservations as $reservation)
			<tr class="reservations-table__tr">
				<td class="reservations-table__td">{{$reservation->user->name}}</td>
				<td class="reservations-table__td">{{ \Carbon\Carbon::parse($reservation->datetime)->format('H:i') }}</td>
				<td class="reservations-table__td">{{$reservation->number}}人</td>
				<td class="reservations-table__td">{{$reservation->shop->name}}</td>
			</tr>
			@endforeach
		</table>
	</div>
	</main>
</body>
</html>