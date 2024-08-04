@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_all.css')}}">
@endsection

{{-- モーダルウィンドウ --}}
@section('script')
<div id="myModal" class="modal">
	<div class="modal-content">
		<div class="close-btn">
			<span class="close">&times;</span>
		</div>
		<nav class="modal-nav">
			<div class="modal-nav__list">
				<a class="modal-nav__list--link" href="/">Home</a>
			</div>
			@if (auth()->check())
				<div class="modal-nav__list">
					<form class="modal-nav__list--form" action="/logout" method="post">
						@csrf
						<button type="submit" class="modal-nav__btn--submit">Logout</button>
					</form>
				</div>
				<div class="modal-nav__list">
					<form class="modal-nav__list--form" action="/mypage/{{ auth()->user()->id }}" method="get">
						@csrf
						<button type="submit" class="modal-nav__btn--submit">Mypage</button>
					</form>
				</div>
			@else
				<div class="modal-nav__list">
					<a class="modal-nav__list--link" href="/register">Registration</a>
				</div>
				<div class="modal-nav__list">
					<a class="modal-nav__list--link" href="/login">Login</a>
				</div>
			@endif
		</nav>
	</div>
</div>
<script>
var btn = document.getElementById("openModal");
var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
// モーダルの外側をクリックされたときにモーダルを非表示
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}
</script>
@endsection

@section('search-form')
<div class="search-form">
	<form class="search-form__inner" action="/search" method="get">
		@csrf
		<div class="search-form__select">
			<select class="search-form__select-box" name="address">
				<option value="">All area</option>
				<option value="東京都">東京都</option>
				<option value="大阪府">大阪府</option>
				<option value="福岡県">福岡県</option>
			</select>
		</div>
		<div class="search-form__select">
			<select class="search-form__select-box" name="category">
				<option value="">All genre</option>
				<option value="寿司">寿司</option>
				<option value="焼肉">焼肉</option>
				<option value="居酒屋">居酒屋</option>
				<option value="イタリアン">イタリアン</option>
				<option value="ラーメン">ラーメン</option>
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
				<p class="shop-card__tag--address">#{{ $shop['address'] }}</p>
				<p class="shop-card__tag--category">#{{ $shop['category'] }}</p>
			</div>
			<div class="shop-card__nav">
				<form action="/detail/{{ $shop['id'] }}" method="get">
					@csrf
					<button type="submit" class="nav__btn btn">詳しくみる</button>
				</form>
			</div>
			<div class="shop-card__like">
				<form action="/like/{{ $shop['id'] }}" method="post">
					@csrf
					<button type="submit" class="shop-card__like-btn"><i class="fa-solid fa-heart" style="color: {{ $likedShops[$shop->id] ? 'red' : 'grey' }}"></i></button>
				</form>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection

