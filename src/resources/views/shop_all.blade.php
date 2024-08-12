@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_all.css')}}">
@endsection

{{-- モーダルウィンドウ --}}
@section('header-script')
<div id="headerModal" class="modal">
	<div class="modal-content">
		<div class="close-btn">
			<span class="headerModal-close">&times;</span>
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
var headerBtn   = document.getElementById("header-openModal");
var headerModal = document.getElementById("headerModal");
var headerClose = document.getElementsByClassName("headerModal-close")[0];

headerBtn.onclick = function() {
  headerModal.style.display = "block";
}
headerClose.onclick = function() {
  headerModal.style.display = "none";
}
window.onclick = function(event) {
	if (event.target == headerModal) {
		headerModal.style.display = "none";
	}
}
</script>
@endsection

{{-- 検索フォーム --}}
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

{{-- 店舗一覧 --}}
@section('content')
<div class="shop-lists">
	@foreach ($shops as $shop)
	<div class="shop-card">
		<div class="shop-card__img">
			<img src="{{ $shop['image'] }}" alt="{{ $shop['name'] }}" width="100%" height="150px">
		</div>
		<div class="shop-card__content">
			<h2 class="shop-card__name">{{ $shop['name'] }}</h2>
			@if ($shop->ratings->isNotEmpty())
				<div class="rating" data-rating="{{ $shop->ratings->avg('score') }}" data-modal-id="ratingModal{{ $shop->id }}"></div>
			@else
				<div class="rating" data-rating="No rating"></div>
			@endif
			{{-- 評価モーダル --}}
			<div id="ratingModal{{ $shop->id }}" class="modal">
				<div class="modal-content">
					<div class="rating-header">
						<h2 class="rating-header__info">レビュー:<span class="rating-header__shop-name">{{ $shop['name'] }}</span></h2>
						<div class="rating-header__content">
							<div class="rating-icon" data-rating="{{ $shop->ratings->avg('score') }}"></div>
							<p class="aveRating">{{ $shop->ratings->avg('score') }}/5</p>
						</div>
					</div>
					<span class="ratingModal-close">&times;</span>
					<div class="rating-list">
						@foreach ($shop->ratings as $rating)
						<div class="rating-card">
							<div class="rating-card__user-name">
								<p>{{ $rating->user->name }}</p>
							</div>
							<div class="rating-card__rating">
								<div class="rating-icon" data-rating="{{ $rating->score }}"></div>
							</div>
							<span class="rating-card__date">{{ $rating->created_at->format('Y年m月d日') }}にレビュー済み</span>
							<div class="rating-card__text">
								<span class="rating-card__comment">{{ $rating->comment }}</span>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<script>
				document.addEventListener('DOMContentLoaded', function () {
					// 星の評価をレンダリングする関数
					function renderStars(rating, element) {
						element.innerHTML = '';
						const fullStars = Math.floor(rating);
						const hasHalfStar = rating % 1 >= 0.5;
						for (let i = 1; i <= 5; i++) {
							if (i <= fullStars) {
								element.innerHTML += '<i class="fas fa-star"></i>';
							} else if (i === fullStars + 1 && hasHalfStar) {
								element.innerHTML += '<i class="fas fa-star-half-alt"></i>';
							}	else {
								element.innerHTML += '<i class="far fa-star"></i>';
							}
						}
					}

					// 評価アイコンの表示
					function initializeRatings() {
						const ratingElements = document.querySelectorAll('.rating');
						ratingElements.forEach(function (ratingElement) {
							const rating = parseFloat(ratingElement.getAttribute('data-rating'));
							renderStars(rating, ratingElement);
						});

						const ratingIcons = document.querySelectorAll('.rating-icon');
						ratingIcons.forEach(function (ratingIcon) {
							const rating = parseFloat(ratingIcon.getAttribute('data-rating'));
							renderStars(rating, ratingIcon);
						});
					}

					// 評価モーダルの表示
					function initializeModal() {
						const ratingModal = document.getElementById('ratingModal');
						const ratingClose = document.querySelector('.ratingModal-close');

						const ratingElements = document.querySelectorAll('.rating');
						ratingElements.forEach(function (ratingElement) {
							ratingElement.addEventListener('click', function () {
								const modalId = ratingElement.dataset.modalId; // 店舗IDをデータ属性から取得
								const ratingModal = document.getElementById(modalId); // 対応するモーダルを取得
								if (ratingModal) {
									ratingModal.style.display = 'block';
								}
							});
						});

						// モーダルを閉じるイベント
						const ratingCloseElements = document.querySelectorAll('.ratingModal-close');
            ratingCloseElements.forEach(function (ratingClose) {
							ratingClose.addEventListener('click', function() {
								const modals = document.querySelectorAll('.modal');
								modals.forEach(function (modal) {
									modal.style.display = 'none';
								});
							});
            });

						// モーダルの外側をクリックしたときに閉じる
						window.addEventListener('click', function(event) {
							const modals = document.querySelectorAll('.modal');
							modals.forEach(function (modal) {
								if (event.target == modal) {
									modal.style.display = 'none';
								}
							});
						});
					}

					// 初期化関数を実行
					initializeRatings();
					initializeModal();
				});
			</script>
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

