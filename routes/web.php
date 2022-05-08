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

Route::post('/web/contactsend','HomeController@ContactSend');

Route::get('/Courses','CourseController@CoursePage');
Route::get('/Policy','PolicyController@PolicyPage');
Route::get('/Projects','ProjectController@ProjectPage');
Route::get('/Terms','TermsController@TermPage');

Route::get('/Contact','ContactController@ContactPage');
