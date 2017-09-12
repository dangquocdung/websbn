<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatCauHoi extends Model
{
  protected $table = 'datcauhoi';

    public function nguoitraloi()
  {
    return $this->belongsTo('App\User','user_id','id');
  }
}
