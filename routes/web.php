<?php
  use bootstrap\Route;

  Route::get('/users',function(){
    return "Hola mundo";
  });
  Route::get('/cars',function(){
    return "Hola contacto";
  });

  Route::dispatch();