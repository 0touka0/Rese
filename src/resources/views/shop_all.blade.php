@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_all.css')}}">
@endsection

@section('search-sort-form')
<div class="search-sort-container">
	<!-- ソート選択 -->
	<div class="sort-dropdown">
		<div class="sort-selected-option">
			{{ $sortType === null ? '並べ替え：評価高/低' : ($sortType === 'random' ? 'ランダム' : ($sortType === 'high_rating' ? '評価が高い順' : '評価が低い順')) }}
		</div>
		<ul class="sort-options-list">
			<li class="sort-option" data-value="random">ランダム</li>
			<li class="sort-option" data-value="high_rating">評価が高い順</li>
			<li class="sort-option" data-value="low_rating">評価が低い順</li>
		</ul>
	</div>

	<!-- セレクト値を送信するための隠しフィールド -->
	<form id="sort-form" method="GET" action="/">
		<input type="hidden" name="sort" id="hidden-sort" value="">
		<input type="hidden" name="address" value="{{ request('address') }}">
		<input type="hidden" name="category" value="{{ request('category') }}">
		<input type="hidden" name="keyword" value="{{ request('keyword') }}">
	</form>

	<!-- 検索フォーム -->
	<div class="search-form">
		<form class="search-form__inner" action="/" method="get">
			<input type="hidden" name="sort" value="{{ request('sort') }}">
			<div class="search-form__select">
				<select class="search-form__select-box" name="address">
					<option value="">All area</option>
					<option value="東京都" {{ request('address') === '東京都' ? 'selected' : '' }}>東京都</option>
					<option value="大阪府" {{ request('address') === '大阪府' ? 'selected' : '' }}>大阪府</option>
					<option value="福岡県" {{ request('address') === '福岡県' ? 'selected' : '' }}>福岡県</option>
				</select>
			</div>
			<div class="search-form__select">
				<select class="search-form__select-box" name="category">
					<option value="">All genre</option>
					<option value="寿司" {{ request('category') === '寿司' ? 'selected' : '' }}>寿司</option>
					<option value="焼肉" {{ request('category') === '焼肉' ? 'selected' : '' }}>焼肉</option>
					<option value="居酒屋" {{ request('category') === '居酒屋' ? 'selected' : '' }}>居酒屋</option>
					<option value="イタリアン" {{ request('category') === 'イタリアン' ? 'selected' : '' }}>イタリアン</option>
					<option value="ラーメン" {{ request('category') === 'ラーメン' ? 'selected' : '' }}>ラーメン</option>
				</select>
			</div>
			<div class="search-form__input">
				<input class="search-form__input--text" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search ...">
			</div>
		</form>
	</div>
</div>
@endsection

<!-- 店舗一覧 -->
@section('content')
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
	@endforeach
</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/sort.js') }}"></script>
	<script src="{{ asset('js/ratingAvgStars.js') }}"></script>
@endsection
