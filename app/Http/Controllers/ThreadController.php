<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;

class ThreadController extends Controller
{
  public function __construct() {
    $this->middleware('auth:api');
  }

  public function index() {
    return Thread::take(50)->get();
  }

  public function store(Request $req) {
    if ($req->title) {
      $thread = new Thread;
      $done = $thread->fill([
        'owner_id' => $req->user()->id,
        'title' => $req->title,
        'description' => $req->description
      ])->save();
      if ($done) {
        return $thread->id;
      } else {
        return false;
      }
    }
  }

  public function show($id) {
    return Thread::find($id);
  }

}
