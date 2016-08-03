<div class="media">
	<a class="pull-left" href="{{ url('user', $user->username) }}">
		<img class="media-object" alt="{{ $user->getNameOrUsername() }}" src="{{ $user->getAvatarUrl() }}">
	</a>
	<div class="media-body">
		<h4 class="media-heading"><a href="{{ url('user', $user->username) }}">{{ $user->getNameOrUsername() }}</a></h4>
		@if($user->location)
			<p>{{ $user->location }}</p>
		@endif
	</div>
</div>