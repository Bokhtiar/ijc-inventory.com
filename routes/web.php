<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/* Web auth routes */
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Web Routes */
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth');

/* User auth routes */
Route::group(["as" => 'user.', "prefix" => 'user', "middleware" => ['auth', 'user']], function () {
    Route::get('/dashboard', [app\Http\Controllers\User\UserDashboardControllerr::class, 'index'])->name('dashboard');
});

/* Admin auth routes */
Route::group(["as" => 'admin.', "prefix" => 'admin', "middleware" => ['auth', 'admin']], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');

    /* billing */
    Route::get('/billing/list', [App\Http\Controllers\Admin\BillingController::class, 'index'])->name('billing.list');
    Route::get('/billing/show/{id}', [App\Http\Controllers\Admin\BillingController::class, 'show'])->name('billing.show');
    Route::get('/billing/pdf/{id}', [App\Http\Controllers\Admin\BillingController::class, 'pdfDownload'])->name('billing.pdf');
    Route::get('/billing/create', [App\Http\Controllers\Admin\BillingController::class, 'create'])->name('billing.create');
    Route::post('/billing/store', [App\Http\Controllers\Admin\BillingController::class, 'store'])->name('billing.store');
    
    
    Route::get('/logout', [App\Http\Controllers\Admin\AdminDashboardController::class, 'logout'])->name('logout');
});

