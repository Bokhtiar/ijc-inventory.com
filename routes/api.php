<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskReportController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::controller(AuthController::class)->group(function () {
//     Route::post('login', 'login');
//     Route::post('register', 'register');
//     Route::post('logout', 'logout');
//     Route::post('refresh', 'refresh');
// });

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);

Route::group(['middleware' =>  'AdminApiMiddleware', 'prefix' => 'admin'], function () {
    /** company */
    Route::resource('company', CompanyController::class)->only([
        'index', 'store', 'show', 'update', 'destroy',
    ]);

    /** task */
    Route::resource('task', TaskController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);
    Route::put('task/status/{id}', [TaskController::class, 'status']);

    /** report */
    Route::get('/task/report/{filter}', [TaskReportController::class, 'report']);
}); 