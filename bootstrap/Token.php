<?php
namespace bootstrap;
require_once '../vendor/autoload.php'; // Load the JWT library

use Exception;
use Firebase\JWT\JWT;
class Token{
  private $request;

  public function __construct()
  {
    $this->request= new Request(); 
  }

  public function generateToken($user)
  {
    $payload=array(
      "id"=>$user['id']
    );
    $jwt=JWT::encode($payload, SECRET_KEY,ALGORITHM);
    return $jwt;
  }
}