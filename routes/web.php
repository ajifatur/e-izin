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

// Member
Route::group(['middleware' => ['member']], function() {
    // Logout
	Route::post('/member/logout', 'LoginController@logout')->name('member.logout');

	// Dashboard
    Route::get('/member', 'DashboardController@index')->name('member.dashboard');

	// Absent
	Route::get('/member/absent/{id}', 'AbsentController@create')->name('member.absent');
	Route::post('/member/absent/store', 'AbsentController@store')->name('member.absent.store');
});

// Guest
Route::group(['middleware' => ['guest']], function() {
    // Home
    Route::get('/', function () {
        return redirect()->route('auth.login');
    });

    // Login
    Route::get('/login', 'LoginController@show')->name('auth.login');
    Route::post('/login', 'LoginController@authenticate')->name('auth.post-login');
});