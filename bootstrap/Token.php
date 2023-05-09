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
  
  private function getToken()
  {
    $Header = $this->request->getheaders();
    $token=$Header['Authorization'];
    return $token;
  }

  public function checkToken()
  {
    $token=$this->getToken();
    if(!$token)
      return false;
    try {
      JWT::decode($token, SECRET_KEY, array(ALGORITHM));
      return true;
    } catch (Exception $e) {
      // Handle invalid JWT
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }
}