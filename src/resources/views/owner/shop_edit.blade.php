@extends('layouts.admin_master')

@section('title', '店舗詳細')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/shop_edit.css') }}">
@endsection

@section('header_title', $shop->name)

@section('header_nav')
<ul class="header__nav-list">
	<li class="header__nav-item">
		<a class="header__nav-link" href="{{ route('shops.confirm') }}">戻る</a>
	</li>
</ul>
@endsection

@section('content')
<form class="shopEdit-form" action="{{ route('shop.put', ['shop_id' => $shop->id]) }}" method="post">
	@csrf
	@method('PUT')
	<div class="shopEdit-form__inner">
		<div class="shopEdit-form__item">
			<label class="shopEdit-form__label" for="shopName">店名</label>
			<input class="shopEdit-form__text" type="text" name="name" id="shopName" value="{{ $shop->name }}">
			<span class="error-message">
				@error('name')
					{{ $message }}
				@enderror
			</span>
		</div>
		<div class="shopEdit-form__item">
			<label class="shopEdit-form__label" for="address">地域</label>
			<input class="shopEdit-form__text" type="text" name="address" id="address" value="{{ $shop->address->address }}">
			<span class="error-message">
				@error('address')
					{{ $message }}
				@enderror
			</span>
		</div>
		<div class="shopEdit-form__item">
			<label class="shopEdit-form__label" for="category">ジャンル</label>
			<input class="shopEdit-form__text" type="text" name="category" id="category" value="{{ $shop->category->category }}">
			<span class="error-message">
				@error('category')
				{{ $message }}
				@enderror
			</span>
		</div>
		<div class="shopEdit-form__item">
			<label class="shopEdit-form__label" for="overview">店舗概要</label>
			<textarea class="shopEdit-form__text" name="overview" id="overview" cols="30" rows="6">{{ $shop->overview }}</textarea>
			<span class="error-message">
				@error('overview')
				{{ $message }}
				@enderror
			</span>
		</div>
		<div class="shopEdit-form__btn">
			<button class="shopEdit-form__btn--submit" type="submit">編集</button>
		</div>
	</div>
</form>
@endsection
