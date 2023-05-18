<?php
namespace app\Controllers;

use app\Models\User;
use bootstrap\Request;
use bootstrap\Token;

class AuthController{
  protected $request;
  public function __construct()
  {
    $this->request=new Request();
  }
  public function login()
  {
    $email=$this->request->getFormData()['email'];
    $pass= $this->request->getFormData()['password'];
    $user= new User();
    $userAuth=$user->where('email',$email)->first();
    if($userAuth && $userAuth['password']===$pass){
      $token= new Token();
      $jwt= $token->generateToken($userAuth);
      return ["access_token"=>$jwt];
    }
    else{
      http_response_code(404);
    }
  }

  public function profile()
  {
   $token= new Token();
   $payload = $token->extractId();
   $user = new User();
   return $user->find($payload->id);
  }
}