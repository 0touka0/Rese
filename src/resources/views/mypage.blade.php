@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
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
<div class=grid-container>
	<div class='user-name'>
		<h1>{{ $user['name'] }}<span class="user-name__text">さん</span></h1>
	</div>
	{{-- 予約状況 --}}
	<div class='reservation-confirm'>
		<h2 class='reservation-confirm__header'>予約状況</h2>
		<div class="message">
			@error('time')
				{{ $message }}
			@enderror
			@if (session('message'))
				{{ session('message') }}
			@endif
		</div>
		@foreach ($reservations as $index => $reservation)
			<div class='reservation-card' data-datetime="{{ $reservation->datetime }} " data-index="{{ $index + 1 }}">
				<div class="reservation-card__heading">
					<div class="reservation-card__heading-item">
						<span class="reservation-card__heading-icon"><i class="fa-regular fa-clock"></i></span>
						<p class="reservation-card__heading-title">予約{{ $index + 1 }}</p>
					</div>
					<a class="reservation-card__heading-icon" href="/softdelete/{{ $reservation->id }}"><i class="fa-regular fa-circle-xmark"></i></a>
				</div>
				<div class="reservation-card__detail">
					<div class="reservation-card__detail-list">
						<p class="reservation-card__detail-label">Shop</p>
						<span>{{ $reservation->shop->name }}</span>
					</div>
					<form id="reservation-form-{{ $reservation->id }}" action="/reservation/{{ $reservation->id }}" method="post">
						@csrf
						@method('PUT')
						<div class="reservation-card__detail-list">
							<p class="reservation-card__detail-label">Date</p>
							<input type="date" name="date" value="{{ $reservation->reservation_date }}" id="reservation-date-{{ $reservation->id }}" class="reservation-card__detail-input auto-save" data-id="{{ $reservation->id }}">
							<script>
								document.addEventListener('DOMContentLoaded', function() {
									// Dateを指定
									var dateInput = document.getElementById('reservation-date-{{ $reservation->id }}');
									// 上記をクリックした際カレンダーを表示
									dateInput.addEventListener('click', function() {
										this.showPicker();
									});
								});
							</script>
						</div>
						<div class="reservation-card__detail-list">
							<p class="reservation-card__detail-label">Time</p>
							<select name="time" class="reservation-card__detail-select auto-save" data-id="{{ $reservation->id }}">
								<option class="select-option" value="17:00" {{ $reservation->reservation_time == '17:00:00' ? 'selected' : '' }}>17:00</option>
								<option class="select-option" value="17:30" {{ $reservation->reservation_time == '17:30:00' ? 'selected' : '' }}>17:30</option>
								<option class="select-option" value="18:00" {{ $reservation->reservation_time == '18:00:00' ? 'selected' : '' }}>18:00</option>
								<option class="select-option" value="18:30" {{ $reservation->reservation_time == '18:30:00' ? 'selected' : '' }}>18:30</option>
								<option class="select-option" value="19:00" {{ $reservation->reservation_time == '19:00:00' ? 'selected' : '' }}>19:00</option>
								<option class="select-option" value="19:30" {{ $reservation->reservation_time == '19:30:00' ? 'selected' : '' }}>19:30</option>
								<option class="select-option" value="20:00" {{ $reservation->reservation_time == '20:00:00' ? 'selected' : '' }}>20:00</option>
								<option class="select-option" value="20:30" {{ $reservation->reservation_time == '20:30:00' ? 'selected' : '' }}>20:30</option>
								<option class="select-option" value="21:00" {{ $reservation->reservation_time == '21:00:00' ? 'selected' : '' }}>21:00</option>
								<option class="select-option" value="21:30" {{ $reservation->reservation_time == '21:30:00' ? 'selected' : '' }}>21:30</option>
							</select>
						</div>
						<div class="reservation-card__detail-list">
							<p class="reservation-card__detail-label">Number</p>
							<select name="number" class="reservation-card__detail-select auto-save" data-id="{{ $reservation->id }}">
								<option class="select-option" value="1" {{ $reservation->number == 1 ? 'selected' : '' }}>1人</option>
								<option class="select-option" value="2" {{ $reservation->number == 2 ? 'selected' : '' }}>2人</option>
								<option class="select-option" value="3" {{ $reservation->number == 3 ? 'selected' : '' }}>3人</option>
								<option class="select-option" value="4" {{ $reservation->number == 4 ? 'selected' : '' }}>4人</option>
								<option class="select-option" value="5" {{ $reservation->number == 5 ? 'selected' : '' }}>5人</option>
								<option class="select-option" value="6" {{ $reservation->number == 6 ? 'selected' : '' }}>6人</option>
							</select>
						</div>
						<div class="reservation-detail__btn">
							<input type="hidden" name="user_id" value="{{ $reservation->user_id }}">
							<button type="submit" class="reservation-detail__btn--submit" style="display: none;">変更を保存</button>
						</div>
					</form>
				</div>
				{{-- 評価フォームは表示用にクローンする --}}
				<div class="rating-form" style="display: none;">
					<form action="/rating" method="post">
						@csrf
						<input type="hidden" name="user_id" value="{{ $reservation->user_id }}">
						<input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
						<div class="rating-form__score">
							<label for="score" class="rating-label">{{ $reservation->shop->name }}評価:</label>
							<select name="score" id="score" required>
								@for ($i = 1; $i <= 5; $i++)
									<option value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
						<div class="rating-form__comment">
							<label for="comment" class="rating-label rating-label__comment">コメント:</label>
							<textarea name="comment" id="comment" rows="3" maxlength="255" class="rating-label__comment--textarea"></textarea>
						</div>
						<button type="submit" class="rating-form__btn">送信</button>
					</form>
				</div>
			</div>
		@endforeach
	</div>
{{-- 評価フォーム表示、予約情報変更ボタン --}}
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			// 評価フォーム表示条件
			$('.reservation-card').each(function() {
				var reservationCard = $(this);
				var datetime = reservationCard.data('datetime');
				var datetimeDate = new Date(datetime);
				var now = new Date();
				var oneHourLater = new Date(datetimeDate.getTime() + 60 * 60 * 1000);

				if (now >= oneHourLater) {
					showOverlay(reservationCard);
				} else {
					var timeRemaining = oneHourLater - now;
					setTimeout(function() {
						showOverlay(reservationCard);
					}, timeRemaining);
				}
			});
			// 評価フォーム表示機能
			function showOverlay(reservationCard) {
				var overlay = $('<div class="overlay"></div>');
				var overlayContent = $('<div class="overlay-content"></div>');
				var closeButton = $('<button class="close-button">閉じる</button>');

				closeButton.on('click', function() {
					overlay.remove();
				});

				overlayContent.append(closeButton);
				overlayContent.append(reservationCard.find('.rating-form').clone().show());
				overlay.append(overlayContent);
				reservationCard.append(overlay);
			}

			// 予約情報変更ボタンを表示
			$('.auto-save').on('input change', function() {
				var reservationId = $(this).data('id');
				$('#reservation-form-' + reservationId + ' .reservation-detail__btn--submit').show();
			});
		});
	</script>
{{-- お気に入り店舗 --}}
	<div class="likes-confirm">
		<h2 class="likes-confirm__header">お気に入り店舗</h2>
		<div class="likes-confirm__lists">
			@foreach($likes as $like)
			<div class="shop-card">
				<div class="shop-card__img">
					<img src="{{ $like->shop->image }}" alt="{{ $like->shop->name }}" width="100%" height="150px">
				</div>
				<div class="shop-card__content">
					<h2 class="shop-card__name">{{ $like->shop->name }}</h2>
					@if ($like->shop->ratings->isNotEmpty())
						<div class="rating" data-rating="{{ $like->shop->ratings->first()->score }}"></div>
					@else
						<div class="rating" data-rating="No rating"></div>
					@endif
					<script>
						document.addEventListener('DOMContentLoaded', function () {
							const ratingElements = document.querySelectorAll('.rating');
							ratingElements.forEach(function (ratingElement) {
								const rating = parseFloat(ratingElement.getAttribute('data-rating'));
								renderStars(rating, ratingElement);
							});

							function renderStars(rating, element) {
								element.innerHTML = '';
								const fullStars = Math.floor(rating);
								for (let i = 1; i <= 5; i++) {
									if (i <= fullStars) {
										element.innerHTML += '<i class="fas fa-star"></i>';
									} else {
										element.innerHTML += '<i class="far fa-star"></i>';
									}
								}
							}
						});
					</script>
					<div class="shop-card__tag">
						<p class="shop-card__tag--address">#{{ $like->shop->address }}</p>
						<p class="shop-card__tag--category">#{{ $like->shop->category }}</p>
					</div>
					<div class="shop-card__nav">
						<form action="/detail/{{ $like->shop->id }}" method="get">
							@csrf
							<button type="submit" class="nav__btn btn">詳しくみる</button>
						</form>
					</div>
					<div class="shop-card__like">
						<form action="/like/{{ $like->shop->id }}" method="post">
							@csrf
							<button type="submit" class="shop-card__like-btn"><i class="fa-solid fa-heart" style="color: red"></i></button>
						</form>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection