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



/*
|--------------------------------------------------------------------------
| SIGEES ROUTES
|--------------------------------------------------------------------------
|
*/


Route::resource('/mensaje'		,'MensajesController');

Route::resource('/clases'		,'ClasesController');
Route::resource('/aulas'		,'AulasController');
Route::resource('/temas'		,'TemasController');
Route::resource('/actividades'		,'ActividadesController');
Route::resource('/cuestionarios','CuestionariosController');
Route::resource('/examenes'		,'ExamenesController');


//Posiblemente API
Route::resource('/preguntas','PreguntasController');
Route::resource('/imagenes','ImagenesController');
Route::resource('/enlaces','EnlacesController');
Route::resource('/elementoscompartidos','ElementosCompartidosController');





/*************************
*	CATALOGOS
*************************/

//Periodos
Route::resource('/catalogos/periodos','PeriodosController');
//Materias
Route::resource('/catalogos/asignaturas','AsignaturasController');
//Grupos
Route::resource('/catalogos/grupos','GruposController');


Route::get('/', 'HomeController@index');
Route::get('/sendNotification', 'HomeController@sendNotification');



/*
|--------------------------------------------------------------------------
| Alumnos SIGEDI ROUTES 
|--------------------------------------------------------------------------
|
*/


Route::get('/a', 						  'alumnos\HomeController@index');
Route::get('/a/registro',				  'alumnos\AuthController@register');
Route::resource('/a/clases', 			  'alumnos\ClasesController');
Route::resource('/a/actividades', 		  'alumnos\ActividadesController', ['as' => 'alumnos']);
Route::resource('/a/trabajos', 			  'alumnos\TrabajosController');
Route::resource('/a/examen', 			  'alumnos\ExamenController');
Route::resource('/a/alumno', 			  'alumnos\AlumnoController');
Route::get('/a/juegosdidacticos/memoria', 'HomeController@memoria');





/*
|--------------------------------------------------------------------------
| API SIGEDI ROUTES 
|--------------------------------------------------------------------------
|
*/

Route::get('asignaturas-data', 'Api\AsignaturasController@list');
Route::get('periodos-data', 'Api\PeriodosController@list');
Route::get('grupos-data', 'Api\GruposController@list');



/*Recursos*/
Route::resource('/libros','LibrosController');
Route::resource('/alumnos','AlumnosController');
Route::resource('/profesores','ProfesoresController');
Route::get('/prestamos/historial', 'PrestamosController@record');
Route::resource('/prestamos','PrestamosController');


/*Catalogos*/
Route::resource('/autores','AutoresController');

Route::get('/libros/import/csv', 'Api\ApiBooksController@import');
Route::get('books-data', 'Api\ApiBooksController@booksList');
Route::get('alumnos-data', 'Api\ApiAlumnosController@list');
Route::get('profesores-data', 'Api\ApiProfesoresController@list');
Route::get('prestamos-data', 'Api\ApiPrestamosController@index');
Route::get('prestamos-record', 'Api\ApiPrestamosController@record');

Auth::routes();

Route::get('/category1/import/csv', 'HomeController@category1Import');
Route::get('/category2/import/csv', 'HomeController@category2Import');
Route::get('/category3/import/csv', 'HomeController@category3Import');
Route::get('/alumnos/import/csv', 'AlumnosController@import');
Route::get('/alumnos/verify/data', 'AlumnosController@verify');






//post 
Route::resource('post', 'PostController');


