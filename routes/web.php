<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//use \App\Http\Controllers\UserController;

//Listado de Usuarios
//route::get('/','UserController@list');
route::get("/",[\App\Http\Controllers\UserController::class,'list']);

//Formulario Usuarios
route::get("/form",[\App\Http\Controllers\UserController::class,'userform'])->name("usuarios.userform");

//Guardar Usuarios
route::post("/save",[\App\Http\Controllers\UserController::class,'save']);

//Eliminar usuario
route::delete("/delete/{id}",[\App\Http\Controllers\UserController::class,'delete'])->name('delete');

//Formulario para editar usuarios
route::get("/editform/{id}",[\App\Http\Controllers\UserController::class,'editform'])->name('editform');

//Edicion de usuarios
route::patch("/edit/{id}",[\App\Http\Controllers\UserController::class,'edit'])->name("edit");