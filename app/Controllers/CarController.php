<?php
namespace app\Controllers;

use app\Models\Car;
use bootstrap\Request;

class CarController{
  public $request;
  public function __construct()
  {
    $this->request= new Request();
  }

  public function user($id)
  {
    $modelCar= new Car();
    return $modelCar->user($id);
  }
}