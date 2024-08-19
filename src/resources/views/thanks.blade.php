@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
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
<div class="thanks-message">
	<p class="thanks-message__text">会員登録ありがとうございます</p>
	<div class="login-nav">
		<form action="/login" method="get">
			<input type="submit" class="login-nav__btn btn" value="ログインする">
		</form>
	</div>
</div>
@endsection