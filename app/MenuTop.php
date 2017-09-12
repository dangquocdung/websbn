<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuTop extends Model
{
  protected $table = 'menutop';

  public function loaitin()
  {
    return $this->hasMany('App\LoaiTin','menutop_id','id');
  }

  public function tintuc()
  {
    return $this->hasManyThrough('App\TinTuc','App\LoaiTin','menutop_id','loaitin_id','id');
  }
}
