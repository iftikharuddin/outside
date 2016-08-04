@extends('layouts.master')

@section('title')
    Search
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-5">
			<!-- User information and status -->
			@include('includes.userblock')
		</div>
		<div class="col-lg-4 col-lg-offset-3">
			<!-- Friend , Friend request -->
			<h4>{{ $user->username }}'s friends.</h4>
			@if(!$user->friends()->count())
				<p>{{ $user->username }} has no friends.</p>
			@else
				@foreach($user->friends() as $user)
					@include('includes.userblock')
				@endforeach
			@endif
		</div>
	</div>

@endsection