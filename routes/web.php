<?php

use app\Controllers\AuthController;
use app\Controllers\UserController;
use bootstrap\Route;
  Route::post('/api/login',[AuthController::class,'login']);
  Route::get('/api/users/:id/:name',function($id,$name){
    return "usuario con id ".$id." y nombre".$name;
  });
  Route::get('/api/users/:id',[UserController::class,'findById']);
  Route::get('/api/users',[UserController::class,'getAll']);
  Route::post('/api/users',[UserController::class,'create']);
  Route::put('/api/users/:id',[UserController::class,'update']);
  Route::delete('/api/users/:id',[UserController::class,'delete']);

  Route::get('/api/cars',function(){
    return "Hola contacto";
  });

  Route::dispatch();