<?php
namespace app\Controllers;

class ViewController{
  public function index()
  {
    return $this->view('index');
  }

  public function view($view)
  {
    $view=str_replace(".","/",$view);
    if(file_exists("../resources/views/{$view}.html")){
      ob_start();
      include "../resources/views/{$view}.html";
      $content=ob_get_clean();
      return $content;
    }
    else{
      return "La vista no existe";
    }
  }
}