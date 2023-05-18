<?php
namespace app\Models;

class Role extends Model
{
  protected $table='roles';

  public function users($id)
  {
    return $this->belongsToMany('users',$id);
  }
}