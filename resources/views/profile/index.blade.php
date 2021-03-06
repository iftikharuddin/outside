@extends('layouts.master')

@section('title')
    Profile
@endsection

@section('content')
	<div class="row">
		
		<div class="col-lg-5">
			<!-- User information and status -->
			@include('includes.userblock')
		</div>
		<div class="col-lg-4 col-lg-offset-3">
			@if(Auth::user()->hasFriendRequestPending($user))
				<p>Waiting For {{ $user->username }} to accept your request.</p>
			@elseif(Auth::user()->hasFriendRequestReceived($user))
				<a href="{{ url('friends/accept', $user->username) }}" class="btn btn-primary">Accept Friend Request</a>
			@elseif(Auth::user()->isFriendsWith($user))
				<p>You and {{ $user->username }} are friends</p>
			@elseif(Auth::user()->id !== $user->id)
				<a href="{{ url('friends/add', $user->username )}}" class="btn btn-primary"> Add as Friend</a>
			@endif
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