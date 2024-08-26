@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-form">
	<h3 class="register-form__header">Registration</h3>
	<form action="/register" method="post">
		@csrf
		<div class="register-form__inner">
			<div class="register-form__group">
				<div class="icon-container"><i class="fa-solid fa-user icon"></i></div>
				<div class="register-form__item">
					<input type="text" id="name" class="register-form__group--input" name="name" placeholder="Username">
					<p class="message">
						@error('name')
							{{ $message }}
						@enderror
					</p>
				</div>
			</div>
			<div class="register-form__group">
				<div class="icon-container"><i class="fa-solid fa-envelope icon"></i></div>
				<div class="register-form__item">
					<input type="email" id="email" class="register-form__group--input" name="email" placeholder="Email">
					<p class="message">
						@error('email')
							{{ $message }}
						@enderror
					</p>
				</div>
			</div>
			<div class="register-form__group">
				<div class="icon-container"><i class="fa-solid fa-lock icon"></i></div>
				<div class="register-form__item">
					<input type="password" id="password" class="register-form__group--input" name="password" placeholder="Password">
					<p class="message">
						@error('password')
							{{ $message }}
						@enderror
					</p>
				</div>
			</div>
			<div class="register-form__btn">
				<input type="hidden" name="role" value="1">
				<input type="submit" class="register-form__btn--submit btn" value="登録">
			</div>
		</div>
	</form>
</div>
@endsection