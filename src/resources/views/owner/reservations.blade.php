@extends('layouts.admin_master')

@section('title', '予約一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/reservations.css') }}">
@endsection

@section('header_nav')
<ul class="header__nav-list">
	<li class="header__nav-item">
		<a class="header__nav-link" href="{{ route('shops.confirm') }}">戻る</a>
	</li>
</ul>
@endsection

@section('content')
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
@endsection
