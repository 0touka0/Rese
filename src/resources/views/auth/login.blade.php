@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

{{-- モーダルウィンドウ --}}
@section('header-script')
<div id="myModal" class="modal">
	<div class="modal-content">
		<div class="close-btn">
			<span class="close">&times;</span>
		</div>
		<nav class="modal-nav">
			<div class="modal-nav__list">
				<a class="modal-nav__list--link" href="/">Home</a>
			</div>
			<div class="modal-nav__list">
				<a class="modal-nav__list--link" href="/register">Registration</a>
			</div>
			<div class="modal-nav__list">
				<a class="modal-nav__list--link" href="/login">Login</a>
			</div>
		</nav>
	</div>
</div>
<script>
var btn = document.getElementById("header-openModal");
var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}
</script>
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