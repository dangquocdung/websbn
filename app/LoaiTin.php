<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
  protected $table = 'loaitin';

  public function tintuc()
  {
    return $this->hasMany('App\TinTuc','loaitin_id','id');
  }

  public function vanban()
  {
    return $this->hasMany('App\VanBan','loaitin_id','id');
  }

  public function menutop()
  {
    return $this->belongsTo('App\MenuTop','menutop_id','id');
  }
}
