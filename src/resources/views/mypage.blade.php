@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
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
			<div class="modal-nav__list">
				<form class="modal-nav__list--form" action="/logout" method="post">
					@csrf
					<button type="submit" class="modal-nav__btn--submit">Logout</button>
				</form>
			</div>
			<div class="modal-nav__list">
				<form class="modal-nav__list--form" action="/mypage/{{ auth()->user()->id }}" method="get">
					<button type="submit" class="modal-nav__btn--submit">Mypage</button>
				</form>
			</div>
		</nav>
	</div>
</div>
<script>
// ボタン要素を取得
var btn = document.getElementById("openModal");
// モーダル要素を取得
var modal = document.getElementById("myModal");
// 閉じるボタン（×）要素を取得
var span = document.getElementsByClassName("close")[0];
// ボタンがクリックされたときにモーダルを表示
btn.onclick = function() {
  modal.style.display = "block";
}
// 閉じるボタン（×）がクリックされたときにモーダルを非表示
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

@section('content')
<div class=gird-container>
	<div class='user-name'>
		<h1>{{ $user['name'] }}<span class="user-name__text">さん</span></h1>
	</div>
	<div class='reservation-confirm'>
		<h2 class='reservation-confirm__header'>予約状況</h2>
		@foreach ($reservations as $index => $reservation)
		<div class='reservation-card'>
			<div class="reservation-card__heading">
				<div class="reservation-card__heading-item">
					<span class="reservation-card__heading-icon"><i class="fa-regular fa-clock"></i></span>
					<p class="reservation-card__heading-title">予約{{ $index + 1 }}</p>
				</div>
				<a class="reservation-card__heading-icon" href="/softdelete/{{ $reservation->id }}"><i class="fa-regular fa-circle-xmark"></i></a>
			</div>
			<div class="reservation-card__detail">
				<div class="reservation-card__detail-list">
					<p class="reservation-card__detail-label">Shop</p>
					<span>{{ $reservation->shop->name }}</span>
				</div>
				<div class="reservation-card__detail-list">
					<p class="reservation-card__detail-label">Date</p>
					<span>{{ $reservation->reservation_date }}</span>
				</div>
				<div class="reservation-card__detail-list">
					<p class="reservation-card__detail-label">Time</p>
					<span>{{ $reservation->reservation_time }}</span>
				</div>
				<div class="reservation-card__detail-list">
					<p class="reservation-card__detail-label">Number</p>
					<span>{{ $reservation->number }}人</span>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<div class="likes-confirm">
		<h2 class="likes-confirm__header">お気に入り店舗</h2>
		<div class="likes-confirm__lists">
			@foreach($likes as $like)
			<div class="shop-card">
				<div class="shop-card__img">
					<img src="{{ $like->shop->image }}" alt="{{ $like->shop->name }}" width="100%" height="150px">
				</div>
				<div class="shop-card__content">
					<h2 class="shop-card__name">{{ $like->shop->name }}</h2>
					<div class="shop-card__tag">
						<p class="shop-card__tag--address">#{{ $like->shop->address }}</p>
						<p class="shop-card__tag--category">#{{ $like->shop->category }}</p>
					</div>
					<div class="shop-card__nav">
						<form action="/detail/{{ $like->shop->id }}" method="get">
							@csrf
							<button type="submit" class="nav__btn btn">詳しくみる</button>
						</form>
					</div>
					<div class="shop-card__like">
						<form action="/like/{{ $like->shop->id }}" method="post">
							@csrf
							<button type="submit" class="shop-card__like-btn"><i class="fa-solid fa-heart" style="color: red"></i></button>
						</form>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection