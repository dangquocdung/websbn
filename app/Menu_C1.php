<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_C1 extends Model
{
  protected $table = 'menu_cap_1';

  public function menu_cap_2()
  {
    return $this->hasMany('App\Menu_C2','menu_cap_1_id','id');
  }
}
