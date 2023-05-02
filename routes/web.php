<?php

use app\Controllers\AuthController;
use app\Controllers\UserController;
use bootstrap\Route;
  Route::post('/login',[AuthController::class,'login']);
  Route::get('/users/:id/:name',function($id,$name){
    return "usuario con id ".$id." y nombre".$name;
  });
  Route::get('/users/:id',[UserController::class,'findById']);
  Route::get('/users',[UserController::class,'getAll']);
  Route::post('/users',[UserController::class,'create']);
  Route::put('/users/:id',[UserController::class,'update']);
  Route::delete('/users/:id',[UserController::class,'delete']);

  Route::get('/cars',function(){
    return "Hola contacto";
  });

  Route::dispatch();