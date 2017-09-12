<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoClip extends Model
{
  protected $table = 'videoclip';

    public function nguoidang()
  {
    return $this->belongsTo('App\User','user_id','id');
  }
}
