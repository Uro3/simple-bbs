<?php

Auth::routes();

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
