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
  public function findById($id)
  {
    $modelUser=new User();

    return $modelUser->find($id);
  }
  public function create()
  {
    $modelUser=new User();
    return $modelUser->create([
      'name'=>'luis',
      'email'=>'osorio@osher',
      'password'=>'luis1234'
    ]);
  }
  public function update($id)
  {
    $modelUser=new User();
    return $modelUser->update($id,[
      'name'=>'luis pedro',
      'email'=>'osorio@osher',
      'password'=>'luis1234'
    ]);
  }
}