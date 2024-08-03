<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\AppointmentStatusController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\DashboardStatController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::middleware('auth')->group(function(){

Route::get('/api/stats/appointments',[DashboardStatController::class,'appointments']);
Route::get('/api/users',[UserController::class,'index']);
Route::post('/api/users',[UserController::class,'store']);
// Route::post('/api/users/search',[UserController::class,'search']);
// Route::get('/api/users/search', [UserController::class, 'search']);
Route::put('/api/users/{user}',[UserController::class,'update']);
Route::delete('/api/users/{user}',[UserController::class,'destroy']);
Route::delete('/api/users',[UserController::class,'bulkDelete']);
Route::patch('/api/users/{user}/change-role',[UserController::class,'changeRole']);

Route::get('/api/appointment-status',[AppointmentStatusController::class,'getStatusWithCount']);
Route::get('/api/appointments',[AppointmentController::class,'index']);
Route::post('/api/appointments/create',[AppointmentController::class,'store']);
Route::get('/api/appointments/{appointment}/edit',[AppointmentController::class,'edit']);
Route::put('/api/appointments/{appointment}/edit',[AppointmentController::class,'update']);
Route::delete('/api/appointments/{appointment}',[AppointmentController::class,'destroy']);



Route::get('/api/clients',[ClientController::class,'index']);

});



Route::get('{view}',ApplicationController::class)->where('view','(.*)')->middleware('auth');




