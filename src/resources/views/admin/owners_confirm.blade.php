@extends('layouts.admin_master')

@section('title', '店舗代表者一覧')

@section('header_title', '店舗代表者一覧')

@section('header_nav')
	<ul class="header__nav-list">
		<li class="header__nav-item">
			<a class="header__nav-link" href="{{ route('mail.create') }}">メール配信</a>
		</li>
		<li class="header__nav-item">
			<a class="header__nav-link" href="{{ route('owner.create') }}">新規作成</a>
		</li>
	</ul>
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('css/admin/owners_confirm.css') }}">
@endsection

@section('content')
	<table class="owners-table">
		<tr class="owners-table__tr">
			<th class="owners-table__th">id</th>
			<th class="owners-table__th">代表者名</th>
			<th class="owners-table__th">店舗名一覧</th>
			<th class="owners-table__th">登録日</th>
		</tr>
		{{-- 以下繰り返し --}}
		@foreach ($shops as $shop)
			<tr class="owners-table__tr">
				<td class="owners-table__td">{{ $shop->id }}</td>
				<td class="owners-table__td">{{ $shop->user->name}}</td>
				<td class="owners-table__td">{{ $shop->name }}</td>
				<td class="owners-table__td">{{ $shop->created_at->format('Y年 n月 j日') }}</td>
			</tr>
		@endforeach
	</table>
@endsection
