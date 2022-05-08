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
Route::post('/admin/ServiceAdd','ServiceController@ServiceAdd');



//  Admin Panel Courses managment

Route::get('/courses','coursesController@CoursesIndex');
Route::get('/admin/CourseData','coursesController@getCourseData');
Route::post('/admin/CourseDetails','coursesController@getCouresDetails');
Route::post('/admin/CourseDelete','coursesController@CourseDelete');
Route::post('/admin/CourseUpdate','coursesController@CourseUpdate');
Route::post('/admin/CourseAdd','coursesController@CourseAdd');

//  Admin Panel Project managment

Route::get('/project','projectController@PorjectIndex');
Route::get('/admin/projectData','projectController@getProjectData');
Route::post('/admin/projectDetails','projectController@getProjectDetails');
Route::post('/admin/projectDelete','projectController@ProjectDelete');
Route::post('/admin/projectUpdate','projectController@ProjectUpdate');
Route::post('/admin/projectAdd','projectController@ProjectAdd');

//  Admin Panel Contact managment

Route::get('/contact','contactController@ContactIndex');
Route::get('/admin/contactData','contactController@getContactData');
Route::post('/admin/contactDelete','contactController@ContactDelete');

// Admin Panel Review managment
Route::get('/review','ReviewController@ReviewIndex');
Route::get('/admin/getreviewData','ReviewController@getReviewData');
Route::post('/admin/ReviewDelete','ReviewController@ReviewDelete');
Route::post('/admin/ReviewDetails','ReviewController@getReviewDetails');
Route::post('/admin/ReviewUpdate','ReviewController@ReviewUpdate');
Route::post('/admin/ReviewAdd','ReviewController@ReviewAdd');

