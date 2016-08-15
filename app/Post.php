<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = 'posts';
	protected $fillable = ['body'];
    public function user(){
		return $this->belongsTo('App\User');
	}
	
	public function likes(){
		return $this->hasMany('App\Like');
	}
	
	public function scopeNotReply($query){
		return $query->whereNull('parent_id');
	}
	
	public function replies(){
		return $this->hasMany('App\Post', 'parent_id');
	}
}
