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
		</div>
	</div>

@endsection