<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

class FriendController extends Controller
{
    public function getIndex(){
		$friends = Auth::user()->friends();
		return view('friends.index', compact('friends'));
	}
}
