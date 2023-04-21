<?php
namespace Bootstrap;
class Route{
  private static $routes=[];

  public static function get($uri, $callback)
  {
    $uri=trim($uri,'/');
    self::$routes['GET'][$uri]=$callback;
  }

  public static function post($uri,$callback)
  {
    $uri=trim($uri,'/');
    self::$routes['POST'][$uri]=$callback;
  }

  public static function dispatch()
  {
    //Se obtiene la URI
    $uri=$_SERVER['REQUEST_URI'];
    $uri=trim($uri,'/');
    $method=$_SERVER['REQUEST_METHOD'];
    //Recorremos todo el arreglo de rutas 
    foreach (self::$routes[$method] as $route => $callback) {
      //para cada iteración verificamos si alguna de las rutas corresponde a la URI
      if(preg_match("#^$route$#",$uri,$matches)){
        //Verificamos si la función es un método
        if(is_callable($callback)){
          $response=$callback(); //Se obtiene el resultado de la ejecución
        }
        //Si se trata de un array o objeto, utilizaremos json_encode
        if(is_array($response) || is_object($response)){
          header('Content-Type: application/json');
          echo json_encode($response);
        }
        else{
          echo $response;
        }
        return;
      }

    }
    echo '404:Route not found';
  }
}