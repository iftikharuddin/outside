@if(Session::has('user_created'))
	<p class="alert bg-success">{!! session('user_created') !!}</p>
@endif
@if(Session::has('user_signin'))
	<p class="alert bg-success">{!! session('user_signin') !!}</p>
@endif
	
@if(count($errors) > 0)
    <div class="row">
        <div class="col-md-4 col-md-offset-4 error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if(Session::has('message'))
    <div class="row">
        <div class="col-md-4 col-md-offset-4 success">
            {{Session::get('message')}}
        </div>
    </div>
@endif