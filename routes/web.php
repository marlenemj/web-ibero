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

/*
Route::get('/', ['App\Http\Controllers\TaskController', 'index']); 
*/

Route::resource('/tareas', 'App\Http\Controllers\TaskController');
Route::resource('/proyectos', 'App\Http\Controllers\ProjectController');

Route::post('/completar-tarea/{id}',[
	'uses' => 'App\Http\Controllers\TaskController@changeStatus',
	'as' => 'completar.tarea'
]);