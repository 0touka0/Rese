@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
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
<div class="thanks-message">
	<p class="thanks-message__text">ご予約ありがとうございます</p>
	<div class="shops-nav btn">
		<a class="shops-nav__link" href="/">戻る</a>
	</div>
</div>
@endsection