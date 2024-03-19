<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

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
    
    Route::resource('company', CompanyController::class)->only([
        'index', 'store', 'show', 'update', 'destroy',
    ]);

    Route::resource('task', TaskController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);
    Route::put('task/status/{id}', [TaskController::class, 'status']);
}); 