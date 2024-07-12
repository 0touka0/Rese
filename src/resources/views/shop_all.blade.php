@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_all.css')}}">
@endsection

@section('search-form')
<div class="search-form">
	<form class="search-form__inner" action="/search" method="get">
		@csrf
		<div class="search-form__select">
			<select class="search-form__select-box" name="address">
				<option value="">All area</option>
				@foreach ($shopTags as $tag)
				<option value="{{ $tag['address'] }}">{{ $tag['address'] }}</option>
				@endforeach
			</select>
		</div>
		<div class="search-form__select">
			<select class="search-form__select-box" name="category">
				<option value="all">All genre</option>
				@foreach ($shopTags as $tag)
				<option value="{{ $tag['category'] }}">{{ $tag['category'] }}</option>
				@endforeach
			</select>
		</div>
		<div class="search-form__input">
			<input class="search-form__input--text" type="text" name="keyword" placeholder="Search ...">
		</div>
	</form>
</div>
@endsection

@section('content')
<div class="shop-lists">
	@foreach ($shops as $shop)
	<div class="shop-card">
		<div class="shop-card__img">
			<img src="{{ $shop['image'] }}" alt="{{ $shop['name'] }}" width="100%" height="150px">
		</div>
		<div class="shop-card__content">
			<h2 class="shop-card__name">{{ $shop['name'] }}</h2>
			<div class="shop-card__tag">
				<p class="shop-card__tag--address">#{{ $shop['address']}}</p>
				<p class="shop-card__tag--category">#{{ $shop['category']}}</p>
			</div>
			<div class="shop-card__nav">
				<form action="/detail" method="get">
					@csrf
					<input type="hidden" name="id" value="{{ $shop['id'] }}">
					<button type="submit" class="nav__btn btn">詳しくみる</button>
				</form>
			</div>
			<div class="shop-card__like"><i class="fa-solid fa-heart"></i></div>
		</div>
	</div>
	@endforeach
</div>
<form class="form" action="/logout" method="post">
	@csrf
	<button class="header-nav__button">ログアウト</button>
</form>
@endsection

