<?php
namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
	
	protected $fillable = [
	   'email',
	   'first_name',
	   'password',
	   'image'
   	];
	
    public function posts(){
        return $this->hasMany('App\Post');
    }
	
    public function likes(){
		return $this->hasMany('App\Like');
	}
}
	
	
   