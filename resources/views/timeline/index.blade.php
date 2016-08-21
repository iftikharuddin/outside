@extends('layouts.master')

@section('content')
    @include('includes.messages')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What do you have to say?</h3></header>
            <form action="{{ url('createpost') }}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What other people say...</h3></header>
                @foreach($posts as $post)
				
                <article class="post media" data-postid="{{ $post->id }}">
                    <a class="pull-left" href="{{ url('user', $post->user->username) }}">
						<img class="media-object" alt="" src="{{ $post->user->getAvatarUrl() }}">
					</a>
					<div class="media-body">
                      <h4 class="media-heading"><a href="{{ url('user', $post->user->username) }}"> {{ $post->user->username }}</a></h4>
						<p>{{ $post->body }}</p>
						<ul class="list-inline">
							<li>{{ $post->created_at->diffForHumans() }}</li>
							<li><a href="#">Like</a></li>
							<li>10 likes</li>
						</ul>
						@foreach($post->replies as $reply)
							
							<div class="media">
								<a class="pull-left" href="#">
									<img class="media-object" alt="" src="{{ $reply->user->getAvatarUrl() }}">
								</a>
								<div class="media-body">
								<h5 class="media-heading"> {{ $reply->user->username }} </h4>
									<p>{{ $reply->body }}</p>
									<ul class="list-inline">
										<li>{{ $reply->created_at->diffForHumans() }}</li>
										<li><a href="#">Like</a></li>
										<li>10 likes</li>
									</ul>
								</div>
							</div>
						@endforeach
						
					</div>
				
					<form role="form" action="{{ url('createpost',  $post->id )}}" method="post">
							<div class="form-group{{ $errors->has("reply-{$post->id}") ? ' has-error': '' }}">
								<textarea name="reply-{{ $post->id }}" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
								@if($errors->has("reply-{$post->id}"))
									<span class="help-block">{{ $errors->first("reply-{$post->id}") }} </span>
								@endif
							</div>
							<input type="submit" value="Reply" class="btn btn-default btn-sm">
							<input type="hidden" name="_token" value="{{ Session::token() }}">
					</form>
					
                </article>
				
          		@endforeach
				
        </div>
		
    </section>
    
	<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit the Post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ url('edit') }}';
        var urlLike = '{{ url('like') }}';
    </script>
@endsection