<?php
namespace Bootstrap;

use bootstrap\Token;

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

  public static function put($uri,$callback)
  {
    $uri=trim($uri,'/');
    self::$routes['PUT'][$uri]=$callback;
  }

  public static function delete($uri,$callback)
  {
    $uri=trim($uri,'/');
    self::$routes['DELETE'][$uri]=$callback;
  }

  public static function dispatch()
  {
    //Se obtiene la URI
    $uri=$_SERVER['REQUEST_URI'];
    $uri=trim($uri,'/');
    $hasParams=strpos($uri,'?');
    if($hasParams){
      $uri=str_split($uri,$hasParams)[0];
    }

    $method=$_SERVER['REQUEST_METHOD'];

    $token= new Token();
    if(!$token->checkToken() && str_starts_with($uri, 'api') && $uri != 'api/login'){
      echo "No authorizado";
      return;
    }
      
    

    //Recorremos todo el arreglo de rutas 
    foreach (self::$routes[$method] as $route => $callback) {

      //Obtener los parámetros de una url
      if(strpos($route,":")){
        $route= preg_replace('#:[\w]+#','([\w]+)',$route);
      }

      //para cada iteración verificamos si alguna de las rutas corresponde a la URI
      if(preg_match("#^$route$#",$uri,$matches)){

        //creamos un array con los parámetros enviados
        $params=array_slice($matches,1);  

        //Verificamos si la función es un método
        if(is_callable($callback)){
          $response=$callback(...$params); //Se obtiene el resultado de la ejecución
        }
        //si no se trata de una función, entonces es array con elementos del controlador y método
        else{
          $controller=new $callback[0];
          $response= $controller->{$callback[1]}(...$params);
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