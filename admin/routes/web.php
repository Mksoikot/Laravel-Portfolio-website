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

Route::get('/','HomeController@HomeIndex');
Route::get('/visitor','visitorController@VisitorIndex');

// Admin Panel Service managment
Route::get('/service','ServiceController@ServiceIndex');
Route::get('/admin/getServiceData','ServiceController@getServiceData');
Route::post('/admin/ServiceDelete','ServiceController@ServiceDelete');
Route::post('/admin/ServiceDetails','ServiceController@getServiceDetails');
Route::post('/admin/ServiceUpdate','ServiceController@ServiceUpdate');