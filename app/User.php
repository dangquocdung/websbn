<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function can_post(){
      $level = $this->level;

      if ($level > 1){
        return true;
      }

      return false;
    }

    public function is_tbbt(){
      $level = $this->level;

      if ($level == 3){
        return true;
      }

      return false;
    }

    public function is_admin(){
      $level = $this->level;

      if ($level == 15){
        return true;
      }

      return false;
    }

    public function is_activated(){

      $activated = $this->is_activated;

      if ($activated == 1){
        return true;
      }

      return false;

    }

    public function posts(){
      return $this->hasMany('App\TinTuc','user_id');
    }
}
