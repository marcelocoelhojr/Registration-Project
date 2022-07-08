<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;

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
    return view('home');
});

Route::get('/teste', function () {
    return view('tables.tableOne');
});

Route::get('/home', function () {
    return view('home');
});


Route::get('/newCourse', function () {
    return view('newCourse');
});


Route::get('/userRegistration', function () {
    return view('userRegistration');
});

Route::get('/userRegistration', function () {
    return view('userRegistration');
});

Route::controller(CourseController::class)->group(function () {
    Route::get('/listCourses', 'getCourses');
    Route::post('/create/course', 'create');
});

Route::controller(UserController::class)->group(function () {
    Route::post('/create/user', 'create');
});

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/registrations', 'getForm');
    Route::post('/create/registration', 'create');
    Route::post('/update/registration', 'update');
    Route::delete('/delete/registration/{id}', 'delete');
    Route::get('/listRegistrations', 'getRegistrations');
});


