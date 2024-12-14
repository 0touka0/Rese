@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_all.css')}}">
@endsection

<!-- 検索フォーム -->
@section('search-form')
<!-- ソート選択 -->
<div class="sort-controls">
    <form method="GET" action="/">
        <select name="sort" id="sort-select" onchange="handleSortChange()">
			<option value="">並べ替え：評価高/低</option>
            <option value="random" {{ $sortType === 'random' ? 'selected' : '' }}>ランダム</option>
            <option value="high_rating" {{ $sortType === 'high_rating' ? 'selected' : '' }}>評価が高い順</option>
            <option value="low_rating" {{ $sortType === 'low_rating' ? 'selected' : '' }}>評価が低い順</option>
        </select>
    </form>
</div>
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

<!-- 店舗一覧 -->
@section('content')
<p class="verify-message">
	@if (session('message'))
		{{ session('message') }}
	@endif
</p>
<div class="shop-lists">
	@foreach ($shops as $shop)
	<div class="shop-card">
		<div class="shop-card__img">
			<img src="{{ $shop['image'] }}" alt="{{ $shop['name'] }}">
		</div>
		<div class="shop-card__content">
			<h2 class="shop-card__name">{{ $shop['name'] }}</h2>
			@if ($shop->ratings->isNotEmpty())
				<div class="rating" data-rating="{{ $shop->ratings->avg('score') }}" data-modal-id="ratingModal{{ $shop->id }}"></div>
			@else
				<div class="rating" data-rating="No rating"></div>
			@endif
			<div class="shop-card__tags">
				<span class="shop-card__tag">#{{ $shop->address->address }}</span>
				<span class="shop-card__tag">#{{ $shop->category->category }}</span>
			</div>
			<div class="shop-card__actions">
				<form action="/detail/{{ $shop->id }}" method="get">
					@csrf
					<button type="submit" class="btn shop-card__btn">詳しくみる</button>
				</form>
				<form action="/like/{{ $shop->id }}" method="post">
					@csrf
					<button type="submit" class="shop-card__like-btn {{ $likedShops[$shop->id] ? 'shop-card__liked' : 'shop-card__not-liked' }}">
						<i class="fa-solid fa-heart"></i>
					</button>
				</form>
			</div>
		</div>
	</div>

	<!-- 評価モーダル -->
	<div id="ratingModal{{ $shop->id }}" class="modal">
    <div class="modal__content">
			<div class="rating-modal__header">
				<h2 class="rating-modal__title">レビュー: <span class="modal__shop-name">{{ $shop['name'] }}</span></h2>
				<div class="rating-modal__summary">
					<div class="rating__icon" data-rating="{{ $shop->ratings->avg('score') }}"></div>
					<p class="rating-modal__average">{{ $shop->ratings->avg('score') }}/5</p>
				</div>
				<span class="rating-modal__close">&times;</span>
			</div>
			<div class="rating-modal__body">
				@foreach ($shop->ratings as $rating)
					<div class="review-card">
						<p class="review-card__user-name">{{ $rating->user->name }}</p>
						<div class="review-card__rating">
							<div class="rating__icon" data-rating="{{ $rating->score }}"></div>
						</div>
						<span class="review-card__date">{{ $rating->created_at->format('Y年m月d日') }}にレビュー済み</span>
						<p class="review-card__comment">{{ $rating->comment }}</p>
					</div>
				@endforeach
			</div>
    </div>
	</div>
	@endforeach
</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/sort.js') }}"></script>
	<script src="{{ asset('js/ratingModal.js') }}"></script>
@endsection
