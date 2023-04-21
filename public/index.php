<?php

  $uri=$_SERVER['REQUEST_URI'];
  //Verificación de uri
  if($uri==='/users'){
    //operaciones a realizar
    $result=[
      [
        "id"=>"1",
        "name"=>"Luis",
        "last_name"=>"Osorio"
      ],
      [
        "id"=>"2",
        "name"=>"Eduardo",
        "last_name"=>"Hernandez"
      ],
      [
        "id"=>"3",
        "name"=>"Juan",
        "last_name"=>"Osorio"
      ]
      ];
  }

  if($uri==='/cars'){
    $result=[
      [
        "id"=>"1",
        "placa"=>"ABC-1234",
        "modelo"=>"Tsuru",
        "marca" =>"Nissan"
      ],
      [
        "id"=>"2",
        "placa"=>"ABC-1234",
        "modelo"=>"Tsuru",
        "marca" =>"Nissan"
      ],
      [
        "id"=>"3",
        "placa"=>"ABC-1234",
        "modelo"=>"Tsuru",
        "marca" =>"Nissan"
      ]
      ];
  }
  echo json_encode($result);