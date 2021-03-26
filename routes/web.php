<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::group(['prefix' => 'courses', 'as' => 'courses.' ], function() {
    Route::get('/', 'CourseController@index')->name('index');
    Route::post('/search', 'CourseController@search')->name('search');
});


Route::group(['prefix' => 'teacher', 'as' => 'teacher.', 'middleware' => ['teacher']], function() {
    Route::get('/', 'TeacherController@index')->name('index');

    /**
     * COURSE ROUTES
     */
    Route::get('/courses', 'TeacherController@courses')->name('courses');
    Route::get('/courses/create', 'TeacherController@createCourse')
        ->name('courses.create');

    /**
     * UNIT ROUTES
     */
    Route::get('/units', 'TeacherController@units')->name('units');
    Route::get('/units/create', 'TeacherController@createUnit')
        ->name('units.create');
    Route::get('/units/store', 'TeacherController@storeUnit')
        ->name('units.store');
});




/*Route::get('/phpinfo', function () {
    phpinfo();
});*/
