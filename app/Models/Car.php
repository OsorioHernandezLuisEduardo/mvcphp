<?php
namespace app\Models;

class Car extends Model
{
  protected $table='cars';

  public function user($id)
  {
    return $this->belongsTo('users','users_id',$id);
  }
}
