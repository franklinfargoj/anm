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
Route::group(['middleware'=>'auth'], function (){

    Route::get('/', 'TargetdataController@index')->name('dashboard');
    Route::post('import-file', 'TargetdataController@importFile')->name('import.file');
    Route::get('/get-anm-target-data', 'TargetdataController@fetchTargetData');
    Route::get('/fetch-process-data/{id}', 'ProcessedFileController@fetchProcessData');
    Route::get('processedfile/{id}','ProcessedFileController@index')->name('processedfile');

    // Route::get('/home', 'TargetdataController@homePage')->name('home');
    //Route::get('/home', 'HomeController@index')->name('home');
    //Route::post('register', 'Controller@importFile')->name('register');
    //Route::get('login', 'LoginController@login')->name('login');
    // Route::get('/', function () { return view('fileupload'); });
});

Route::get('weblink/{id}','WeblinkController@index')->name('weblink');
Auth::routes();