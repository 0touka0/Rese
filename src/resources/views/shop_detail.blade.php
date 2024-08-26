@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('content')
<div class="shop-detail">
  <div class="shop-detail__header">
    <p><a href="/" class="shop-detail__nav"><</a></p>
    <h2 class="shop-detail__title">{{ $shop->name }}</h2>
  </div>
  <div class="shop-detail__image">
    <img src="{{ $shop->image }}" alt="{{ $shop->name }}">
  </div>
  <div class="shop-detail__tags">
    <p class="shop-detail__tag--address">#{{ $shop->address->address }}</p>
    <p class="shop-detail__tag--category">#{{ $shop->category->category }}</p>
  </div>
  <div class="shop-detail__description">
    <p>{{ $shop->overview }}</p>
  </div>
</div>
@endsection

@section('reservation-form')
<div class="reservation">
  <form action="/reservation" method="post">
    @csrf
    <div class="reservation__form">
      <div class="reservation__form-inner">
        <h2>予約</h2>
        <div class="reservation__form-group">
          <input type="date" class="reservation__input--date" name="date" id="reservation-date">
        </div>
        <div class="reservation__form-group">
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
        <div class="reservation__form-group">
          <select name="number" id="reservation-number">
            <option value="1">1人</option>
            <option value="2">2人</option>
            <option value="3">3人</option>
            <option value="4">4人</option>
            <option value="5">5人</option>
            <option value="6">6人</option>
          </select>
        </div>
        <div class="reservation__confirm">
          <div class="reservation__confirm-item">
            <p class="reservation__confirm-label">Shop</p>
            <span class="reservation__confirm-value">{{ $shop->name }}</span>
          </div>
          <div class="reservation__confirm-item">
            <p class="reservation__confirm-label">Date</p>
            <span class="reservation__confirm-value" id="selected-date"></span>
          </div>
          <div class="reservation__confirm-item">
            <p class="reservation__confirm-label">Time</p>
            <span class="reservation__confirm-value" id="selected-time"></span>
          </div>
          <div class="reservation__confirm-item">
            <p class="reservation__confirm-label">Number</p>
            <span class="reservation__confirm-value" id="selected-number"></span>
          </div>
        </div>
        <div class="reservation__error">
          @error('time')
            {{ $message }}
          @enderror
        </div>
      </div>
      <div class="reservation__submit">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        <button type="submit" class="reservation__btn">予約する</button>
      </div>
    </form>
  </div>
  <script src="{{ asset('js/reservation.js') }}"></script>
</div>
@endsection