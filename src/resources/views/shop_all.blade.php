@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_all.css')}}">
@endsection

@section('seach-form')
<form action="" method="post">検索</form>
@endsection

@section('content')
<div class="shop-lists">
	<div class="shop-card">
		<div class="shop-card__img">
			<img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="仙人" width="100%" height="150px">
		</div>
		<div class="shop-card__content">
			<h2 class="shop-card__name">仙人</h2>
			<div class="shop-card__tag">
				<p class="shop-card__tag--address">#東京都</p>
				<p class="shop-card__tag--category">#寿司</p>
			</div>
			<div class="shop-card__nav">
				<form action="" method="get">
					@csrf
					<input type="hidden" name="id" value="">
					<button type="submit" class="nav__btn btn">詳しくみる</button>
				</form>
			</div>
			<div class="shop-card__like"><i class="fa-solid fa-heart"></i></div>
		</div>
	</div>
</div>
<form class="form" action="/logout" method="post">
	@csrf
	<button class="header-nav__button">ログアウト</button>
</form>
@endsection

