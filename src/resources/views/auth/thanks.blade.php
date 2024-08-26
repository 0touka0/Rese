@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-message">
	<p class="thanks-message__text">会員登録ありがとうございます</p>
	<p class="verify-message">{{ $message }}</p>
	<nav class="login-nav">
		<form action="/login" method="get">
			<input type="submit" class="login-nav__btn btn" value="ログインする">
		</form>
	</nav>
</div>
@endsection