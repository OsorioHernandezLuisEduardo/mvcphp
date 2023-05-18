<?php
namespace app\Controllers;

use app\Models\Role;
use bootstrap\Request;

class RoleController{
  public $request;
  public function __construct()
  {
    $this->request= new Request();
  }

  public function users($id)
  {
    $modelRole= new Role();
    return $modelRole->users($id);
  }
}