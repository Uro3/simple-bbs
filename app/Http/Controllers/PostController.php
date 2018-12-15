<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller {

  public function __construct() {
    $this->middleware('auth');
  }

  public function index() {
    return Post::take(50)->get()->keyBy('id');
  }

  public function store(Request $req) {
    if ($req->name && $req->message) {
      $post = new Post;
      $post->fill($req->all())->save();
    }
  }

  public function update($id, Request $req) {
    Post::find($id)->fill($req->all())->save();
  }

  public function destroy($id) {
    Post::destroy($id);
  }
}
