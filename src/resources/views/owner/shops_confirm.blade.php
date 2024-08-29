@extends('layouts.admin_master')

@section('title', '店舗一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/shops_confirm.css') }}">
@endsection

@section('header_title', '店舗一覧')

@section('header_nav')
<ul class="header__nav-list">
	<li class="header__nav-item">
		<a class="header__nav-link" href="{{ route('reservations') }}">予約一覧</a>
	</li>
	<li class="header__nav-item">
		<a class="header__nav-link" href="{{ route('shop.create') }}">新規作成</a>
	</li>
</ul>
@endsection

@section('content')
<table class="shops-table">
	<tr class="shops-table__tr">
		<th class="shops-table__th">id</th>
		<th class="shops-table__th">店舗名</th>
		<th class="shops-table__th">地域</th>
		<th class="shops-table__th">ジャンル</th>
		<th class="shops-table__th">店舗概要</th>
		<th class="shops-table__th"></th>
	</tr>
	{{-- 以下繰り返し --}}
	@foreach ($shops as $shop)
		<tr class="shops-table__tr">
			<td class="shops-table__td">{{$shop->id}}</td>
			<td class="shops-table__td">{{$shop->name}}</td>
			<td class="shops-table__td">{{$shop->address->address}}</td>
			<td class="shops-table__td">{{$shop->category->category}}</td>
			<td class="shops-table__td">{{$shop->overview}}</td>
			<td class="shops-table__td"><a class="shops-table__td--link" href="{{ route('shop.edit', ['shop_id' => $shop->id]) }}">編集</a></td>
		</tr>
	@endforeach
</table>
@endsection
