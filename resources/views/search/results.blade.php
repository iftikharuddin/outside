@extends('layouts.master')

@section('title')
    Search
@endsection

@section('content')
	<h3>You Search For "{!! Request::input('query') !!}"</h3><hr>
	@if(!$users)
		<p>No results found for your searched query.</p>
	@else
	<div class="row">
		<div class="col-lg-12">
			@foreach($users as $user)
				@include('includes.userblock')
			@endforeach
		</div>
	</div>
	@endif
@endsection
