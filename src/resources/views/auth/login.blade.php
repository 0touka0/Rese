@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="login-form">
	<h3 class="login-form__header">Login</h3>
	<form action="/login" method="post">
		@csrf
		<div class="login-form__inner">
			<div class="login-form__group">
				<div class="icon-container"><i class="fa-solid fa-envelope icon"></i></div>
				<div class="login-form__item">
					<input type="email" id="email" class="login-form__group--input" name="email" placeholder="Email">
					<p class="message">
						@error('email')
								{{ $message }}
						@enderror
					</p>
				</div>
			</div>
			<div class="login-form__group">
				<div class="icon-container"><i class="fa-solid fa-lock icon"></i></div>
				<div class="login-form__item">
					<input type="password" id="password" class="login-form__group--input" name="password" placeholder="Password">
					<p class="message">
						@error('password')
								{{ $message }}
						@enderror
					</p>
				</div>
			</div>
			<div class="login-form__btn">
				<input type="submit" class="login-form__btn--submit btn" value="ログイン">
			</div>
		</div>
	</form>
</div>
@endsection