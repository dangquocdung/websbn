<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HinhSlide extends Model
{
  protected $table = 'hinhslide';

    public function nguoidang()
  {
    return $this->belongsTo('App\User','user_id','id');
  }
}
