@extends('layouts.admin_master')

@section('title', '店舗代表者作成')

@section('header_title', '店舗代表者作成')

@section('header_nav')
	<a class="header__nav-link" href="{{ route('owners.confirm') }}">代表者一覧</a>
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('css/admin/owner_create.css') }}">
@endsection

@section('content')
	@if (session('message'))
	<p class="success-message">
		{{ session('message') }}
	</p>
	@endif
	<form class="owner-form" action="/register" method="post">
		@csrf
		<div class="owner-form__inner">
			<div class="owner-form__lists">
				<label class="owner-form__lists-label" for="name">氏名</label>
				<input class="owner-form__lists-input" id="name" type="text" name="name">
				<p class="error-message">
					@error('name')
						{{ $message }}
					@enderror
				</p>
			</div>
			<div class="owner-form__lists">
				<label class="owner-form__lists-label" for="email">メールアドレス</label>
				<input class="owner-form__lists-input" id="email" type="email" name="email">
				<p class="error-message">
					@error('email')
						{{ $message }}
					@enderror
				</p>
			</div>
			<div class="owner-form__lists">
				<label class="owner-form__lists-label" for="password">パスワード</label>
				<input class="owner-form__lists-input" id="password" type="password" name="password">
				<p class="error-message">
					@error('password')
						{{ $message }}
					@enderror
				</p>
			</div>
			<div class="owner-form__btn">
				<input type="hidden" name="role" value="2">
				<button class="owner-form__btn--submit" type="submit">送信</button>
			</div>
		</div>
	</form>
@endsection
