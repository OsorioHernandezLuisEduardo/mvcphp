<?php
namespace app\Controllers;

use bootstrap\Request;

class UserController{
  public $request;
  public function __construct()
  {
    $this->request= new Request();
  }
  public function getAll()
  {
    $params= $this->request->getQuery();
    return $params;
    return "retornar una array de usuarios";
  }
}