@extends('layouts.master')


@section('title')

	Welcome!
@endsection

@section('content')
	@if(Session::has('user_created'))
		<p class="alert bg-success">{!! session('user_created') !!}</p>
	@endif
	@if(Session::has('user_signin'))
		<p class="alert bg-success">{!! session('user_signin') !!}</p>
	@endif
@endsection