@extends('layouts.admin_master')

@section('title', 'メール配信')

@section('header_title', 'メール配信')

@section('header_nav')
	<ul class="header__nav-list">
		<li class="header__nav-item">
			<a class="header__nav-link" href="{{ route('owners.confirm') }}">戻る</a>
		</li>
	</ul>
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('css/admin/mail_send.css') }}">
@endsection

@section('content')
	@if (session('success'))
		{{ session('success') }}
	@endif
	<form class="mail-form" action="{{ route('mail.send') }}" method="post">
		@csrf
		<div class="mail-form__inner">
			<div class="mail-form__item">
				<label class="mail-form__label" for="sendTo">送信対象</label>
				<select class="mail-form__text" name="recipient" id="sendTo">
					<option value="">選択</option>
					<option value="allOwners">全店舗代表者</option>
					<option value="allUsers">全利用者</option>
				</select>
			</div>
			<div class="mail-form__item">
				<label class="mail-form__label" for="subject">件名</label>
				<input class="mail-form__text" type="text" name="subject" id="subject">
			</div>
			<div class="mail-form__item">
				<label class="mail-form__label" for="message">内容</label>
				<textarea class="mail-form__text" name="message" id="message" cols="30" rows="6"></textarea>
			</div>
			<div class="mail-form__btn">
				<button class="mail-form__btn--submit" type="submit">配信</button>
			</div>
		</div>
	</form>
@endsection
