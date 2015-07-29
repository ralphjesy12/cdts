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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'Auth\AuthController@getLogin');
// Authentication routes...
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@authenticate');
Route::get('/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');

// Page View Routes
Route::get('/home', 'StaticsController@home');
Route::get('/training', 'StaticsController@training');
Route::get('/training/browser/{type}', 'StaticsController@browser');
Route::get('/assessment', 'StaticsController@assessment');
Route::get('/assessment/interactive', 'StaticsController@interactive');
Route::get('/assessment/exams/{type}', 'StaticsController@exams');
Route::get('/assessment/exams/{id}/edit', 'StaticsController@examsedit');
Route::get('/assessment/exams/{id}/{q}', 'StaticsController@qa');

// Storage File
Route::get('/module/view', 'StaticsController@ViewModule');

// Form routes
Route::post('/form/saveExam', 'FormsController@saveExam');
Route::post('/form/saveQuestion', 'FormsController@saveQuestion');