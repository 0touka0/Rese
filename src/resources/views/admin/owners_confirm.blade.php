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
	<form action="{{ route('csv.import') }}" method="POST" enctype="multipart/form-data" class="upload-form">
		@csrf
		@if ($errors->has('csv'))
			<div class="error-message">
				{{ $errors->first('csv') }}
			</div>
		@endif
		<label for="csv" class="custom-file-label">
			<span id="file-label-text">店舗情報CSVファイルを選択：</span>
			<span id="file-name">未選択</span>
		</label>
		<input type="file" name="csv" id="csv" accept=".csv" class="custom-file-input">
		<button type="submit" class="custom-submit-button">インポート</button>
	</form>
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

@section('scripts')
	<script src="{{ asset('js/csvInput.js') }}"></script>
@endsection
