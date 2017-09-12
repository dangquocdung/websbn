<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VanBan extends Model
{
  protected $table = 'vanban2';

  public function nguoidang()
  {
    return $this->belongsTo('App\User','user_id','id');
  }

  public function loaivb()
  {
    return $this->belongsTo('App\LoaiVB','loaivb_id','id');
  }

  public function menuvb()
  {
    return $this->belongsTo('App\MenuVB','menuvb_id','id');
  }
}
