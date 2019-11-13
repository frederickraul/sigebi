<?php

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

Route::get('/', function () {
    return view('welcome');
});

/*Recursos*/
Route::resource('/libros','LibrosController');
Route::resource('/alumnos','AlumnosController');
Route::resource('/profesores','ProfesoresController');
Route::resource('/prestamos','PrestamosController');

Route::get('/libros/import/csv', 'Api\ApiBooksController@import');
Route::get('books-data', 'Api\ApiBooksController@booksList');
Route::get('alumnos-data', 'Api\ApiAlumnosController@list');
Route::get('profesores-data', 'Api\ApiProfesoresController@list');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/category1/import/csv', 'HomeController@category1Import');
Route::get('/category2/import/csv', 'HomeController@category2Import');
Route::get('/category3/import/csv', 'HomeController@category3Import');

