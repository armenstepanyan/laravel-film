<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', function(){
    return view('main');
});

Route::get('/api/init', 'MainController@index');

Route::get('/api/get-tags', 'MainController@getTags');
Route::post('/api/save-tag', 'MainController@saveTag');
Route::post('/api/delete-tag', 'MainController@deleteTag');


Route::get('/api/film/{id}', 'FilmController@get');
Route::post('/api/film', 'FilmController@create');
Route::post('/api/film/delete', 'FilmController@delete');
Route::post('/api/film/{id}', 'FilmController@update');


//Route::get('/test', 'MainController@test');