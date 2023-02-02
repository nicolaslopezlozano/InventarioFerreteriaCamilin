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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('/articulos', 'ArticuloController');
});
Route::get('/listar-articulos', 'ArticuloController@listarArticulos')->middleware('auth');

Route::get('/listar-categorias', 'CategoriaController@listarCategorias');
Route::get('/categorias', 'CategoriaController@index');
Route::post('/categorias', 'CategoriaController@store');

Route::delete('/categorias/{id}', 'CategoriaController@destroy');
Route::put('/categorias/{id}', 'CategoriaController@update');
