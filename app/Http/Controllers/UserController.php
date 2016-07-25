<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
	
    public function postSignUp(Request $request){
		$this->validate($request, [
            'email' => 'required|email|unique:users',
            'first_name' => 'required|max:120',
            'password' => 'required|min:4'
        ]);
		
		$user = $request->all();
		$user['password'] = bcrypt($request->password);
		User::create($user);
		Session::flash('user_created','The user has been Created');
		return redirect('dashboard');
	}
	
	public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
			$user = "Welcome ".Auth::user()->first_name;
			Session::flash('user_signin', $user);
            return redirect('dashboard');
        }
        return redirect()->back();
    }
	
    
}
