<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\User;

class FriendController extends Controller
{
    public function getIndex(){
		$friends = Auth::user()->friends();
		$requests = Auth::user()->friendRequests();
		return view('friends.index', compact('friends','requests'));
	}
	
	public function getAdd($username){
		$user = User::where('username', $username)->first();
		
		if(!$user){
			return redirect('/friends')->with('info', 'User could not be found');
		}
		if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){
			return redirect('/friends')->with('info', 'Friend Request Already Pending.');
		}
		if(Auth::user()->isFriendsWith($user)){
			return redirect('/friends')->with('info', 'You are already friends.');
		}
		
		Auth::user()->addFriend($user);
		
		return redirect('/friends')->with('info', 'Friend Request Sent.');
		
	}
}
