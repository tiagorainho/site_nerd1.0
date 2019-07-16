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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('pages','PostsController');

Route::get('/Inventory', 'PostsController@index');
Route::post('/Inventory','PostsController@search');
Route::get('/edit','PostsController@edit');

Route::get('/users','PostsController@index_users');

Route::post('/create-project','ProjectController@store');
Route::resource('projects','ProjectController');
Route::get('/projects', 'ProjectController@index');
Route::post('/projects','ProjectController@search');
Route::get('/create-project','ProjectController@create');

Route::get('/chat','ChatController@index');
Route::post('/chat','ChatController@store');