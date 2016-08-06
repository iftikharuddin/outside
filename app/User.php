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
	
	public function friendsOfMine(){
		return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
	}
	
	public function friendOf(){
		return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
	}
	
	public function friends(){
		return $this->friendsOfMine()->wherePivot('accepted',true)->get()->merge($this->friendOf()->wherePivot('accepted',true)->get());
	}
	
	public function friendRequests(){
		return $this->friendsOfMine()->wherePivot('accepted', false)->get();
	}
	
	public function friendRequestsPending(){
		return $this->friendOf()->wherePivot('accepted', false)->get();
	}
	
	public function hasFriendRequestPending(User $user){
		return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
	}
	
	public function hasFriendRequestReceived(User $user){
		return (bool) $this->friendRequests()->where('id', $user->id)->count();
	}
	
	public function addFriend(User $user){
		return $this->friendOf()->attach($user->id);
	}
	
	public function acceptFriendRequest(User $user){
		return $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
			'accepted' => true
		]);
	}
	
	public function isFriendsWith(User $user){
		return (bool) $this->friends()->where('id', $user->id)->count();
	}
}
	
	
   