<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
  public function user() {
    return $this->belongsTo('App\User');
  }
  public function posts() {
    return $this->hasMany('App\Post');
  }

  protected $fillable = ['owner_id', 'title', 'description'];
}
