<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiVB extends Model
{
  protected $table = 'loaivb';

  public function vanban()
  {
    return $this->hasMany('App\VanBan','loaivb_id','id');
  }
}
