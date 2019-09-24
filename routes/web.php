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

/*Books*/
Route::resource('/libros','BooksController');
Route::get('/libros/import/csv', 'BooksController@import');
Route::get('books-data', 'BooksController@booksList')->name('books.data');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/category1/import/csv', 'HomeController@category1Import');
Route::get('/category2/import/csv', 'HomeController@category2Import');
Route::get('/category3/import/csv', 'HomeController@category3Import');

