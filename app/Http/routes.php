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
Route::get('/logout', 'FormsController@getLogout');

// Registration routes...
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');

// Page View Routes
Route::get('/home', 'StaticsController@home');
Route::get('/training', 'StaticsController@training');
Route::get('/training/browser/{type}', 'StaticsController@browser');
Route::post('/training/browser/{type}', 'StaticsController@browserupload');
Route::get('/assessment', 'StaticsController@assessment');
Route::get('/assessment/interactive/{id}', 'StaticsController@interactive');
Route::get('/assessment/interactivepractice/{id}', 'StaticsController@interactivepractice');
Route::get('/assessment/interactive/{id}/result', 'StaticsController@interactiveResult');
Route::get('/assessment/interactivepractice/{id}/result', 'StaticsController@interactiveResultPractice');
Route::get('/assessment/exams/{type}', 'StaticsController@exams');
Route::get('/assessment/exams/{id}/edit', 'StaticsController@examsedit');
Route::get('/assessment/exams/{id}/delete', 'StaticsController@examsdelete');
Route::get('/assessment/exams/{id}/{q}', 'StaticsController@qa');
Route::get('/assessment/question/{id}/{q}/delete', 'StaticsController@qadelete');
Route::get('/account', 'StaticsController@account');
Route::get('/account/manage', 'StaticsController@accountmanage');
Route::get('/activity', 'StaticsController@activity');

Route::get('/reports', 'StaticsController@reports');
Route::get('/reports/view', 'StaticsController@reportsview');

// Storage File
Route::get('/module/view', 'StaticsController@ViewModule');

// Form routes
Route::post('/form/saveExam', 'FormsController@saveExam');
Route::post('/form/saveExamInteractive', 'FormsController@saveExamInteractive');
Route::post('/form/saveQuestion', 'FormsController@saveQuestion');
Route::post('/form/saveAnswer', 'FormsController@saveAnswer');
Route::post('/form/saveAnswerInteractive', 'FormsController@saveAnswerInteractive');
Route::post('/form/saveAnswerInteractivePractice', 'FormsController@saveAnswerInteractivePractice');
Route::post('/form/createuser', 'FormsController@createuser');
Route::post('/form/removeuser', 'FormsController@removeuser');
Route::post('/form/getuserdata', 'FormsController@getuserdata');
Route::post('/form/edituser', 'FormsController@edituser');
Route::post('/form/editprofile', 'FormsController@editprofile');
Route::post('/ajax/AuthenticateSupervisor', 'FormsController@ajaxAuthenticateSupervisor');
Route::post('/form/updateprofilepic', 'FormsController@updateprofilepic');
Route::post('/form/addEvent', 'FormsController@addEvent');
Route::get('/form/getEvents', 'FormsController@getEvents');
