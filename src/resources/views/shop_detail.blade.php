@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('content')
<div class="shop-detail">
	<div class="shop-header">
		<span><a href="/" class="shop-header__nav"><</a></span>
		<h2>{{ $shop['name'] }}</h2>
	</div>
	<div class="shop-image">
		<img src="{{ $shop['image'] }}" alt="{{ $shop['name'] }}">
	</div>
	<div class="shop-tag">
		<p class="shop-tag__address">#{{ $shop['address']}}</p>
		<p class="shop-tag__category">#{{ $shop['category']}}</p>
	</div>
	<div class="shop-text">
		<p class="shop-text__overview">{{ $shop['overview'] }}</p>
	</div>
</div>
@endsection

@section('reservation-form')
<div class="reservation-form">
	<form action="" method="post">
		@csrf
		<h2>予約</h2>
		<div class="reservation-form__input">
			<input type="date" class="reservation-form__input--date" name="date">
		</div>
		<div class="reservation-form__select">
			<select name="time"></select>
		</div>
		<div class="reservation-form__select">
			<select name="number"></select>
		</div>
	</form>
</div>
@endsection