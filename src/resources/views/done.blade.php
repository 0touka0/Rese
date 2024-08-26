@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="thanks-message">
	<p class="thanks-message__text">ご予約ありがとうございます</p>
	<div class="shops-nav btn">
		<a class="shops-nav__link" href="/">戻る</a>
	</div>
</div>
@endsection