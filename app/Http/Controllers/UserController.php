<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller {
  public function __construct() {
    $this->middleware('auth:api');
  }

  public function index(Request $req) {
    return $req->user();
  }
}
