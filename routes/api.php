<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('/autores','Api\ApiAuthorsController');
Route::resource('/libros','LibrosController');
Route::resource('/alumnos','Api\ApiAlumnosController');
Route::resource('/profesores','Api\ApiProfesoresController');

/*
*CATALOGOS
*/

//Categorias
Route::get('/categorias/nivel1','Api\ApiCategoriasController@nivel1');
Route::get('/categorias/nivel2/{id}','Api\ApiCategoriasController@nivel2');
Route::get('/categorias/nivel3/{id}','Api\ApiCategoriasController@nivel3');



