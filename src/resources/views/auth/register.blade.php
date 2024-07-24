@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

{{-- モーダルウィンドウ --}}
@section('script')
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
// ボタン要素を取得
var btn = document.getElementById("openModal");
// モーダル要素を取得
var modal = document.getElementById("myModal");
// 閉じるボタン（×）要素を取得
var span = document.getElementsByClassName("close")[0];
// ボタンがクリックされたときにモーダルを表示
btn.onclick = function() {
  modal.style.display = "block";
}
// 閉じるボタン（×）がクリックされたときにモーダルを非表示
span.onclick = function() {
  modal.style.display = "none";
}
// モーダルの外側をクリックされたときにモーダルを非表示
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}
</script>
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
				<input type="submit" class="register-form__btn--submit btn" value="登録">
			</div>
		</div>
	</form>
</div>
@endsection