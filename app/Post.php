<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function thread() {
        return $this->belongsTo('App\Thread');
    }

    protected $fillable = ['user_id', 'thread_id', 'message'];
}
