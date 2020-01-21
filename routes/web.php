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

Auth::routes();
Route::middleware('auth:web')->group(function(){

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('getcharts', 'HomeController@getCharts');
    Route::resource('/children', 'ChildrenController');
    Route::resource('/teachers', 'TeacherController');
    Route::resource('/guardians', 'GuardianController');
    Route::resource('/users', 'UserController');
    Route::resource('/groups', 'GroupController');


    Route::post('child/guardian', 'ChildrenController@AddGuardianToChild');
    Route::get('child/guardian/{child_id}/{guardian_id}', 'ChildrenController@removeGuardian');
    Route::get('childstat/charts', 'HomeController@charts');
    Route::post('filter-children', 'ChildrenController@filter_children');
    Route::post('search-children', 'ChildrenController@search_child');
    Route::get('change-password', 'UserController@show_password');
    Route::post('change-password', 'UserController@change_password')->name('change.password');
    
    Route::get('attendance', 'AttendanceController@index');
    Route::post('attendance', 'AttendanceController@record');
    Route::get('reports', 'ReportsController@index');

    Route::prefix('reports')->group(function(){
        Route::get('/', 'ReportsController@index');
        Route::post('/by-class', 'ReportsController@getByClass');
        Route::post('/by-age', 'ReportsController@getByAgeGroup');
        Route::post('/by-month', 'ReportsController@getAttendanceByMonth');

    });



    //  Logout
   Route::get('logout', 'HomeController@logout')->name('logout');
    
});