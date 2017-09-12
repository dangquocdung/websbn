<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
  protected $table = 'tintuc';

  public function loaitin()
  {
    return $this->belongsTo('App\LoaiTin','loaitin_id','id');
  }

  public function nguoidang()
  {
    return $this->belongsTo('App\User','user_id','id');
  }
}
