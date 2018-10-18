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

Route::get('/authors', array('as'=>'ajax.pagination','uses'=>'ShopController@getAuthors'));
Route::get('/books', array('as'=>'ajax.pagination','uses'=>'ShopController@getBooks'));


Route::post('/send/{book}', 'ShopController@sendMail');

