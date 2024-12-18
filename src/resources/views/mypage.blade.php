@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class=grid-container>
	<h1 class='user-name'>{{ $user['name'] }}<span class="user-name__text">さん</span></h1>
	<!-- 予約状況 -->
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
						<input type="hidden" name="user_id" value="{{ $reservation->user_id }}">
						<div class="reservation-card__detail-list">
							<p class="reservation-card__detail-label">Date</p>
							<input type="date" name="date" value="{{ $reservation->reservation_date }}" id="reservation-date-{{ $reservation->id }}" class="reservation-card__detail-input auto-save" data-id="{{ $reservation->id }}">
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
							<button type="submit" class="reservation-detail__btn--submit" style="display: none;">変更を保存</button>
						</div>
					</form>
					<button type="button" class="show-rating-form-btn" data-reservation-id="{{ $reservation->id }}" style="display: none;">評価する</button>
					<div class="reservation-card__payment-link-wrapper">
						<a href="{{ $reservation->shop->payment_url }}" class="reservation-card__payment-link" data-reservation-datetime="{{ $reservation->datetime }}">先に支払う</a>
					</div>
				</div>
			</div>
		@endforeach
	</div>

	<!-- お気に入り店舗 -->
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
						<div class="rating" data-rating="{{ $like->shop->ratings->avg('score') }}" data-modal-id="ratingModal{{ $like->shop->id }}"></div>
					@else
						<div class="rating" data-rating="No rating"></div>
					@endif
					<div class="shop-card__tag">
						<p class="shop-card__tag--address">#{{ $like->shop->address->address }}</p>
						<p class="shop-card__tag--category">#{{ $like->shop->category->category }}</p>
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

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/reservationCard.js') }}"></script>
@endsection