<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller {

  public function __construct() {
    $this->middleware('auth:api');
  }

  public function index(Request $req) {
    return Post::select('posts.id', 'posts.message', 'users.name')
      ->join('users','posts.user_id', '=', 'users.id')
      ->where('posts.thread_id', $req->thread_id)
      ->take(50)->get()->keyBy('id');
  }

  public function store(Request $req) {
    if ($req->message && $req->thread_id) {
      $post = new Post;
      $post->fill([
        'user_id' => $req->user()->id,
        'thread_id' => $req->thread_id,
        'message' => $req->message
      ])->save();
    }
  }

  public function update($id, Request $req) {
    Post::find($id)->fill($req->all())->save();
  }

  public function destroy($id) {
    Post::destroy($id);
  }
}
