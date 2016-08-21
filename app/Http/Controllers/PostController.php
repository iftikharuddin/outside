<?php
namespace App\Http\Controllers;
use App\Like;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class PostController extends Controller
{
    public function getDashboard()
    {
		//if(Auth::check()){
		//	$posts = Post::notReply()->orderBy('created_at', 'desc')->get();
		//	return view('timeline.index', compact('posts'));
		//}
		
		if(Auth::check()){
			$posts = Post::notReply()->where(function($query){
				return $query->where('user_id', Auth::user()
				->id)->orWhereIn('user_id', Auth::user()->friends()->lists('id'));	
				})->with('replies')
				->orderBy('created_at', 'desc')
				->get();
			return view('timeline.index', compact('posts'));
		}
		return view('welcome');
        
    }
    public function postCreatePost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $post = new Post();
        $post->body = $request->body;
        $message = 'There was an error';
        if ($request->user()->posts()->save($post)) {
            $message = 'Post successfully created!';
        }
        return redirect('/')->with(['message' => $message]);
    }
	
	public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $post = Post::find($request['postId']);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->update();
        return response()->json(['new_body' => $post->body], 200);
    }
	
	public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->delete();
        return redirect('/')->with(['message' => 'Successfully deleted!']);
    }
	
	public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }
	public function postReply(Request $request, $statusId){
		$this->validate($request, [
			"reply-{$statusId}" => 'required|max:1000',
		],
		[
			'required' => 'The reply body is required'
		]
		);
		
		$post = Post::notReply()->find($statusId);
		if(!$post){
			return redirect('/');
		}
		
		if(!Auth::user()->isFriendsWith($post->user) && Auth::user()->id !== $post->user->id){
			return redirect('/');
		}
		
		$reply = Post::create([
			'body' => $request->input("reply-{$statusId}")
		]);
		
		$reply->user()->associate(Auth::user());
		
		$post->replies()->save($reply);
		return redirect()->back();
	}
}