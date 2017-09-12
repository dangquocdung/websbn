<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_C2 extends Model
{
  protected $table = 'menu_cap_2';

  public function menu_cap_1()
  {
    return $this->belongsTo('App\Menu_C1','menu_cap_1_id','id');
  }
}
