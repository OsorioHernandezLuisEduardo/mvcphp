<?php
namespace app\Models;

class User extends Model
{
  protected $table='users';

  public function cars($id)
  {
    return $this->hasMany('cars',$id);
  }

  public function roles($id)
  {
    return $this->belongsToMany('roles',$id);
  }
}
