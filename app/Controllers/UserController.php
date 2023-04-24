<?php
namespace app\Controllers;

use app\Models\User;
use bootstrap\Request;

class UserController{
  public $request;
  public function __construct()
  {
    $this->request= new Request();
  }
  public function getAll()
  {
    $modelUser=new User();

    return $modelUser->all();
  }
}