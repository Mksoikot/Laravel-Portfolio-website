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

Route::get('/','HomeController@HomeIndex')->middleware('loginCheck');
Route::get('/visitor','visitorController@VisitorIndex')->middleware('loginCheck');

// Admin Panel Service managment
Route::get('/service','ServiceController@ServiceIndex')->middleware('loginCheck');
Route::get('/admin/getServiceData','ServiceController@getServiceData')->middleware('loginCheck');
Route::post('/admin/ServiceDelete','ServiceController@ServiceDelete')->middleware('loginCheck');
Route::post('/admin/ServiceDetails','ServiceController@getServiceDetails')->middleware('loginCheck');
Route::post('/admin/ServiceUpdate','ServiceController@ServiceUpdate')->middleware('loginCheck');
Route::post('/admin/ServiceAdd','ServiceController@ServiceAdd')->middleware('loginCheck');



//  Admin Panel Courses managment

Route::get('/courses','coursesController@CoursesIndex')->middleware('loginCheck');
Route::get('/admin/CourseData','coursesController@getCourseData')->middleware('loginCheck');
Route::post('/admin/CourseDetails','coursesController@getCouresDetails')->middleware('loginCheck');
Route::post('/admin/CourseDelete','coursesController@CourseDelete')->middleware('loginCheck');
Route::post('/admin/CourseUpdate','coursesController@CourseUpdate')->middleware('loginCheck');
Route::post('/admin/CourseAdd','coursesController@CourseAdd')->middleware('loginCheck');

//  Admin Panel Project managment

Route::get('/project','projectController@PorjectIndex')->middleware('loginCheck');
Route::get('/admin/projectData','projectController@getProjectData')->middleware('loginCheck');
Route::post('/admin/projectDetails','projectController@getProjectDetails')->middleware('loginCheck');
Route::post('/admin/projectDelete','projectController@ProjectDelete')->middleware('loginCheck');
Route::post('/admin/projectUpdate','projectController@ProjectUpdate')->middleware('loginCheck');
Route::post('/admin/projectAdd','projectController@ProjectAdd')->middleware('loginCheck');

//  Admin Panel Contact managment

Route::get('/contact','contactController@ContactIndex')->middleware('loginCheck');
Route::get('/admin/contactData','contactController@getContactData')->middleware('loginCheck');
Route::post('/admin/contactDelete','contactController@ContactDelete')->middleware('loginCheck');

// Admin Panel Review managment
Route::get('/review','ReviewController@ReviewIndex')->middleware('loginCheck');
Route::get('/admin/getreviewData','ReviewController@getReviewData')->middleware('loginCheck');
Route::post('/admin/ReviewDelete','ReviewController@ReviewDelete')->middleware('loginCheck');
Route::post('/admin/ReviewDetails','ReviewController@getReviewDetails')->middleware('loginCheck');
Route::post('/admin/ReviewUpdate','ReviewController@ReviewUpdate')->middleware('loginCheck');
Route::post('/admin/ReviewAdd','ReviewController@ReviewAdd')->middleware('loginCheck');

// Admin Login managment
Route::get('/Login','LoginController@LoginIndex');
Route::post('/onLogin', 'LoginController@onLogin');
Route::get('/Logout','LoginController@onLogout');

