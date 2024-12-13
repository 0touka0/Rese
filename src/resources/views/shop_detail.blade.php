@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('content')
<!-- 店舗詳細 -->
<div class="shop-detail">
    <div class="shop-detail__header">
        <a href="/" class="shop-detail__nav">&lt;</a>
        <h2 class="shop-detail__title">{{ $shop->name }}</h2>
    </div>
    <div class="shop-detail__image">
        <img src="{{ $shop->image }}" alt="{{ $shop->name }}">
    </div>
    <div class="shop-detail__tags">
        <span class="shop-detail__tag">#{{ $shop->address->address }}</span>
        <span class="shop-detail__tag">#{{ $shop->category->category }}</span>
    </div>
    <div class="shop-detail__description">
        <p>{{ $shop->overview }}</p>
    </div>
    @if ($isRated)
        <a class="rating-link" href="/rating/{{ $shop->id }}">口コミを投稿する</a>
    @endif
    @if ($ratings)
        <div class="ratings">
            <div class="rating-title">
                <p class="rating-title__text">全ての口コミ情報</p>
            </div>
            @foreach ($ratings as $rating)
                <nav class="rating-nav">
                    <a class="rating-nav__link" href="/rating/{{ $shop->id }}">口コミを編集</a>
                    <form action="/delete/{{ $rating->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="">
                        <button class="rating-nav__delete">口コミを削除</button>
                    </form>
                </nav>
                <div class="ratings-list">
                    <div class="rating-star">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rating->score)
                                <span class="star filled">&#9733;</span> <!-- 塗りつぶし星 -->
                            @else
                                <span class="star">&#9733;</span> <!-- 空星 -->
                            @endif
                        @endfor
                    </div>
                    <p class="rating-comment">{{ $rating->comment }}</p>
                    @if ($rating->image)
                        <div class="rating-img">
                            <img class="rating-img__image" src="{{ asset('storage/' . $rating->image) }}" alt="評価画像">
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('reservation-form')
<!-- 予約フォーム -->
<div class="reservation">
    <form action="/reservation" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
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
            <button type="submit" class="reservation__btn">予約する</button>
        </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/reservation.js') }}"></script>
@endsection