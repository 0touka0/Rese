@extends('layouts.admin_master')

@section('title', '新規店舗作成')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/shop_create.css') }}">
@endsection

@section('header_nav')
<ul class="header__nav-list">
	<li class="header__nav-item">
		<a class="header__nav-link" href="{{ route('shops.confirm') }}">戻る</a>
	</li>
</ul>
@endsection

@section('content')
@if (session('success'))
	<div class="success-message">
		{{ session('success') }}
	</div>
@endif
@if ($errors->has('csv'))
	<div class="error-message csv-error">
		{{ $errors->first('csv') }}
	</div>
@endif
<form action="{{ route('csv.import') }}" method="POST" enctype="multipart/form-data" class="csvImport-form">
    @csrf
    <div class="csvImport-form__item">
        <label for="csv" class="csvImport-form__label">
            <span class="csvImport-form__label-text">店舗情報CSVファイルを選択：</span>
            <span id="file-name" class="csvImport-form__file-name">未選択</span>
        </label>
        <input type="file" name="csv" id="csv" accept=".csv" class="csvImport-form__input">
    </div>
    <div class="csvImport-form__btn">
        <button type="submit" class="csvImport-form__btn--submit">インポート</button>
    </div>
</form>
<form class="shopCreate-form" action="{{ route('shop.store') }}" method="post" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="owner_id" value="{{ auth()->user()->id }}">
	<div class="shopCreate-form__inner">
		<div class="shopCreate-form__item">
			<label class="shopCreate-form__label" for="shopName">店名</label>
			<input class="shopCreate-form__text" type="text" name="name" id="shopName">
			<span class="error-message">
				@error('name')
					{{ $message }}
				@enderror
			</span>
		</div>
		<div class="shopCreate-form__item">
			<label class="shopCreate-form__label" for="image">店舗画像</label>
			<input class="shopCreate-form__img" type="file" name="image" id="image" >
			<span class="error-message">
				@error('image')
					{{ $message }}
				@enderror
			</span>
		</div>
		<div class="shopCreate-form__item">
			<label class="shopCreate-form__label" for="address">地域</label>
			<input class="shopCreate-form__text" type="text"name="address" id="address">
			<span class="error-message">
				@error('address')
					{{ $message }}
				@enderror
			</span>
		</div>
		<div class="shopCreate-form__item">
			<label class="shopCreate-form__label" for="category">ジャンル</label>
			<input class="shopCreate-form__text" type="text" name="category" id="category">
			<span class="error-message">
				@error('category')
				{{ $message }}
				@enderror
			</span>
		</div>
		<div class="shopCreate-form__item">
			<label class="shopCreate-form__label" for="overview">店舗概要</label>
			<textarea class="shopCreate-form__text" name="overview" id="overview" cols="30" rows="6"></textarea>
			<span class="error-message">
				@error('overview')
				{{ $message }}
				@enderror
			</span>
		</div>
		<div class="shopCreate-form__btn">
			<button class="shopCreate-form__btn--submit" type="submit">作成</button>
		</div>
	</div>
</form>
@endsection

@section('scripts')
	<script src="{{ asset('js/csvInput.js') }}"></script>
@endsection