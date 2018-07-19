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

    Route::get('get-mos', 'MosController@index'); //okay
    Route::post('mos','MosController@importRankings')->name('mos'); //okay
    Route::get('rankingdetails/{id}', 'MosController@ajaxMoic')->name('rankingdetails'); //okay
    Route::get('export_mos','MosController@export_mos')->name('export_mos'); //okay
    Route::get('ajax-moic', 'MosController@fetchRankingData'); //okay

    Route::get('rank/{id}', 'MosController@rank_details')->name('rank');

    Route::get('excelimport/{id}', 'ProcessedFileController@export')->name('excel_import');
    Route::get('/ajax/{district}', 'TargetdataController@getBlocks');

});

Route::get('/moic/report/{link}', 'MosController@showReport')->name('moic_report');
Route::get('weblink/{id}','WeblinkController@index')->name('weblink');
Route::get('download-image','WeblinkController@downloadImage')->name('download-link');
Auth::routes();