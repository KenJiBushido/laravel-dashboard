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

// Route::get('/a', function () {
//     return view('aaaaaaaa');
// });

// Route::get('/', 'TestController@long');

Auth::routes();

Route::get('/home', 'MainController@index')->name('home.input')->middleware('auth');
Route::post('/home', 'MainController@insert')->name('home.insert');
Route::get('/searchbetween', 'MainController@searchBetween')->name('home.sbtwn');
Route::patch('/update/{id}', 'MainController@update')->name('home.update');
Route::delete('/delete/{id}', 'MainController@delete')->name('home.delete');
Route::get('export', 'MainController@export')->name('member.export');
Route::post('import', 'MainController@memberImport')->name('member.import');
Route::get('pdf', 'PDFController@memberExpdf')->name('member.expdf');
Route::post('/importexcel', 'ImportController@import')->name('member.im');

Route::get('/result', 'SumController@result');

Route::get('/what', 'WhatController@alldb');

