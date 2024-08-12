@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
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
				<form class="modal-nav__list--form" action="/logout" method="post">
					@csrf
					<button type="submit" class="modal-nav__btn--submit">Logout</button>
				</form>
			</div>
			<div class="modal-nav__list">
				<form class="modal-nav__list--form" action="/mypage/{{ auth()->user()->id }}" method="get">
					@csrf
					<button type="submit" class="modal-nav__btn--submit">Mypage</button>
				</form>
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
	<p class="thanks-message__text">ご予約ありがとうございます</p>
	<div class="shops-nav btn">
		<a class="shops-nav__link" href="/">戻る</a>
	</div>
</div>
@endsection