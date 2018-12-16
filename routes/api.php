<?php

use Illuminate\Http\Request;

Route::apiResources([
  'posts' => 'PostController',
  'users' => 'UserController',
  'threads' => 'ThreadController',
  'signup' => 'SignUpController'
]);
