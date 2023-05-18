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
    $name= $this->request->getFormData()['name']; 
    $email= $this->request->getFormData()['email']; 
    $password=$this->request->getFormData()['password']; 

    $modelUser=new User();
    return $modelUser->create([
      'name'=>$name,
      'email'=>$email,
      'password'=>$password
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
  public function delete($id)
  {
    $modelUser= new User();
    return $modelUser->delete($id);
  }

  public function cars($id)
  {
    $modelUser= new User();
    return $modelUser->cars($id);
  }

  public function roles($id)
  {
    $modelUser= new User();
    return $modelUser->roles($id);
  }
}