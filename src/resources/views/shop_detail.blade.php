@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
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
<div class="shop-detail">
	<div class="shop-header">
		<p><a href="/" class="shop-header__nav"><</a></p>
		<h2 class="shop-header__title">{{ $shop['name'] }}</h2>
	</div>
	<div class="shop-image">
		<img src="{{ $shop['image'] }}" alt="{{ $shop['name'] }}">
	</div>
	<div class="shop-tag">
		<p class="shop-tag__address">#{{ $shop['address']}}</p>
		<p class="shop-tag__category">#{{ $shop['category']}}</p>
	</div>
	<div class="shop-text">
		<p class="shop-text__overview">{{ $shop['overview'] }}</p>
	</div>
</div>
@endsection

@section('reservation-form')
<div class="reservation-form">
	<form action="/reservation" method="post">
		@csrf
		<div class="reservation-form__inner">
			<h2>予約</h2>
			<div class="reservation-form__input">
				<input type="date" class="reservation-form__input--date" name="date" id="reservation-date">
			</div>
			<div class="reservation-form__select">
				<select name="time" id="reservation-time">
					<option value="17:00">17:00</option>
					<option value="17:30">17:30</option>
					<option value="18:00">18:00</option>
					<option value="18:30">18:30</option>
					<option value="19:00">19:00</option>
					<option value="19:30">19:30</option>
					<option value="20:00">20:00</option>
					<option value="20:30">20:30</option>
					<option value="21:00">21:00</option>
					<option value="21:30">21:30</option>
				</select>
			</div>
			<div class="reservation-form__select">
				<select name="number" id="reservation-number">
					<option value="1">1人</option>
					<option value="2">2人</option>
					<option value="3">3人</option>
					<option value="4">4人</option>
					<option value="5">5人</option>
					<option value="6">6人</option>
				</select>
			</div>
			<div class="confirm-text">
				<div class="confirm-text__item">
					<p class="confirm-text__item--p">Shop</p><span class="confirm-text__item--span">{{ $shop['name'] }}</span>
				</div>
				<div class="confirm-text__item">
					<p class="confirm-text__item--p">Date</p><span class="confirm-text__item--span" id="selected-date"></span>
				</div>
				<div class="confirm-text__item">
					<p class="confirm-text__item--p">Time</p><span class="confirm-text__item--span" id="selected-time"></span>
				</div>
				<div class="confirm-text__item">
					<p class="confirm-text__item--p">Number</p><span class="confirm-text__item--span" id="selected-number"></span>
				</div>
			</div>
		</div>
		<div class="reservation-form__btn">
			<input type="hidden" name="user_id" value="{{ $user['id'] }}">
			<input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
			<button type="submit"	class="reservation-form__btn--submit">予約する</button>
		</div>
	</form>
</div>

<script>
	document.addEventListener('DOMContentLoaded', (event) => {
		// フォームデータの取得
		const dateInput = document.getElementById('reservation-date');
		const timeSelect = document.getElementById('reservation-time');
		const numberSelect = document.getElementById('reservation-number');

		// 表示するデータ
		const selectedDate = document.getElementById('selected-date');
		const selectedTime = document.getElementById('selected-time');
		const selectedNumber = document.getElementById('selected-number');

		// 今日の日付を取得してフォーマットする
		const today = new Date();
		const year = today.getFullYear();
		const month = String(today.getMonth() + 1).padStart(2, '0');
		const day = String(today.getDate()).padStart(2, '0');
		const formattedDate = `${year}-${month}-${day}`;

		// input要素の初期値に今日の日付を設定する
		dateInput.value = formattedDate;
		// input要素の最小値に今日の日付を設定する
		dateInput.min = formattedDate;

		// 初期値を表示する
		selectedDate.textContent = dateInput.value;
		selectedTime.textContent = timeSelect.value;
		selectedNumber.textContent = numberSelect.options[numberSelect.selectedIndex].text;

		// イベントリスナーの追加
		dateInput.addEventListener('change', () => {
			selectedDate.textContent = dateInput.value;
		});

		timeSelect.addEventListener('change', () => {
			selectedTime.textContent = timeSelect.value;
		});

		numberSelect.addEventListener('change', () => {
			selectedNumber.textContent = numberSelect.options[numberSelect.selectedIndex].text;
		});
	});
</script>
@endsection