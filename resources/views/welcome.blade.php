@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')
    @include('includes.messages')
    <div class="row">
        <div class="col-md-6">
            <h3>Sign Up</h3>
            <form action="{{ url('signup') }}" method="post">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Your E-Mail</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email') }}">
                </div>
                <div class="form-group {{ $errors->has('user_name') ? 'has-error' : '' }}">
                    <label for="first_name">User Name</label>
                    <input class="form-control" type="text" name="user_name" id="user_name" value="{{ Request::old('user_name') }}">
                </div>
                
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="{{ Request::old('password') }}">
                </div>
                
                <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="password">First Name</label>
                    <input class="form-control" type="text" name="first_name" id="first_name" value="{{ Request::old('first_name') }}">
                </div>
                
                 <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="password">Last Name</label>
                    <input class="form-control" type="text" name="last_name" id="last_name" value="{{ Request::old('last_name') }}">
                </div>
                
                <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                    <label for="password">Location</label>
                    <input class="form-control" type="text" name="location" id="location" value="{{ Request::old('location') }}">
                </div>
              
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
        <div class="col-md-6">
            <h3>Sign In</h3>
            <form action="{{ url('signin') }}" method="post">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Your E-Mail</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email') }}">
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="{{ Request::old('password') }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>
@endsection