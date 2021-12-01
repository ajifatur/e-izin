<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', 'UserController@index')->name('api.user.index');
Route::get('/office', 'OfficeController@index')->name('api.office.index');
Route::get('/position', 'PositionController@index')->name('api.position.index');
Route::get('/work-hour', 'WorkHourController@index')->name('api.work-hour.index');
Route::get('/salary-category', 'SalaryCategoryController@index')->name('api.salary-category.index');
