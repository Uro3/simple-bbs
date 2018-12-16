<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignUpController extends Controller {

  protected function validator(array $data) {
    return Validator::make($data, [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6|confirmed',
    ]);
  }

  protected function create(array $data) {
    return User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]);
  }

  public function store(Request $request) {
    $validator = $this->validator($request->all());
    if ($validator->fails()) {
      $this->throwValidationException(
        $request, $validator
      );
    }
    $this->create($request->all());
    return 'done';
  }
}
