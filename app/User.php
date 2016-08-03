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
	
	public function getName(){
		if($this->first_name && $this->last_name){
			return "{$this->first_name} {$this->last_name}";
		}
		if($this->first_name){
			return $this->first_name;
		}
		return null;
	}
	public function getNameOrUsername(){
		return $this->getName() ?: $this->username;
	}
	
	public function getAvatarUrl(){
		return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=40";
	}
}
	
	
   