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
    Route::resource('/children', 'ChildrenController');
    Route::resource('/teachers', 'TeacherController');
    Route::resource('/guardians', 'GuardianController');
    Route::resource('/users', 'UserController');

    Route::post('child/guardian', 'ChildrenController@AddGuardianToChild');
    Route::get('child/guardian/{$child_id}/{$guardian_id}', 'ChildrenController@removeGuardian');

    
    //  Logout
   Route::get('logout', 'HomeController@logout')->name('logout');
    
});