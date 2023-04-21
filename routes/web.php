<?php

use app\Controllers\UserController;
use bootstrap\Route;

  Route::get('/users/:id/:name',function($id,$name){
    return "usuario con id ".$id." y nombre".$name;
  });
  
  Route::get('/users',[UserController::class,'getAll']);

  Route::get('/cars',function(){
    return "Hola contacto";
  });

  Route::dispatch();