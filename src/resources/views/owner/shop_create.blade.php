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
<span class="success-message">
	@if (session('success'))
		{{ session('success') }}
	@endif
</span>
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