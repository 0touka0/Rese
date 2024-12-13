@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/rating.css') }}">
@endsection

@section('content')
<div class="grid-container-left">
	<div class="left-content">
		<p class="rating-title">今回のご利用はいかがでしたか？</p>
		<!-- 店舗カード -->
		<div class="shop-card">
			<div class="shop-card__img">
				<img src="{{ $shop->image }}" alt="{{ $shop->name }}">
			</div>
			<div class="shop-card__content">
				<h2 class="shop-card__name">{{ $shop->name }}</h2>
				<div class="rating" data-rating="No rating"></div>
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
	</div>
</div>

<div class="grid-container-right">
	<div class="right-content">
		@if (session('message'))
			<div class="message">
				{{ session('message') }}
			</div>
		@endif
		<!-- 評価フォーム -->
		<div class="rating-form">
			<form action="{{ $rating ? '/ratingCreate/' . $rating->id : '/ratingCreate' }}" method="post" enctype="multipart/form-data">
				@csrf
				@if ($rating)
					@method('PUT') <!-- 更新の場合はPUTメソッド -->
				@endif
				<input type="hidden" name="shop_id" value="{{ $shop->id }}">

				<!-- 評価数 -->
				<div class="rating-form__score">
					<label for="star-rating" class="rating-form__label">体験を評価してください</label>
					<div id="star-rating" class="star-rating" data-rating="{{ $rating->score ?? 0 }}">
						@for ($i = 1; $i <= 5; $i++)
							<!-- 星の状態を動的に切り替え -->
							<span class="star {{ $rating && $i <= $rating->score ? 'filled' : '' }}" data-value="{{ $i }}">&#9733;</span>
						@endfor
					</div>
					<input type="hidden" name="score" id="score" value="{{ $rating->score ?? 0 }}" required>
					@error('score')
						<div class="message">{{ $message }}</div>
					@enderror
				</div>

				<!-- 評価コメント -->
				<div class="rating-form__comment">
					<label for="comment" class="rating-form__label">口コミを投稿</label>
					<textarea id="comment" name="comment" rows="7" maxlength="400" class="rating-form__comment-textarea" placeholder="カジュアルな夜のお出かけにおすすめのスポット">{{ $rating->comment ?? '' }}</textarea>
					<div class="count">
						<span id="current-count" class="current-count">0</span>/<span id="max-count">400（最大文字数）</span>
					</div>
					@error('comment')
						<div class="message">{{ $message }}</div>
					@enderror
				</div>

				<!-- 評価画像 -->
				<div class="rating-form__image">
					<label for="image-upload" class="rating-form__label">画像の追加</label>
					<div id="image-input" class="rating-form__image-input">
						<img
							class="image-input__image"
							src=""
							data-existing-src="{{ optional($rating)->image ? asset('storage/' . $rating->image) : '' }}"
							alt="レビュー画像"
						>
						<p class="image-input__large-text">クリックして写真を追加</p>
						<p class="image-input__small-text">またはドラッグアンドドロップ</p>
						<input type="file" name="image" id="image-upload" accept=".jpeg, .jpg, .png" hidden>
					</div>
					<p id="error-message" class="message"></p>
					@error('image')
						<div class="message">{{ $message }}</div>
					@enderror
				</div>
				<div class="rating-form__btn">
					<button type="submit" class="rating-form__btn--submit">口コミを投稿</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/ratingImage.js') }}"></script>
<script src="{{ asset('js/ratingSelectView.js') }}"></script>
<script src="{{ asset('js/textCount.js') }}"></script>
@endsection