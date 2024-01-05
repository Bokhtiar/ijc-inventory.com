<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/* Web auth routes */

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Web Routes */
Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware('auth');

/* Admin auth routes */
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    /* billing */
    Route::get('/billing/list', [App\Http\Controllers\BillingController::class, 'index'])->name('billing.list');
    Route::get('/billing/trash/list', [App\Http\Controllers\BillingController::class, 'trash_list'])->name('billing.trash.list');
    Route::get('/billing-ways-service/{id}', [App\Http\Controllers\BillingController::class, 'bllling_ways_service']);
    Route::get('/billing/edit/{id}', [App\Http\Controllers\BillingController::class, 'edit'])->name('billing.edit');
    Route::get('/billing/show/{id}', [App\Http\Controllers\BillingController::class, 'show'])->name('billing.show');
    Route::get('/billing/pdf/{id}', [App\Http\Controllers\BillingController::class, 'pdfDownload'])->name('billing.pdf');
    Route::get('/billing/create', [App\Http\Controllers\BillingController::class, 'create'])->name('billing.create');
    Route::post('/billing/store', [App\Http\Controllers\BillingController::class, 'store'])->name('billing.store');
    Route::post('/billing/update/{id}', [App\Http\Controllers\BillingController::class, 'update'])->name('billing.update');
    Route::delete('/billing/destroy/{id}', [App\Http\Controllers\BillingController::class, 'destroy'])->name('billing.destroy');
    Route::get('/billing/print/{id}', [App\Http\Controllers\BillingController::class, 'print'])->name('billing.print');
    Route::get('/billing/trash/{id}', [App\Http\Controllers\BillingController::class, 'status'])->name('billing.trash');
    Route::post('/export-bill', [BillingController::class,'exportBills'])->name('export-bill');

    /** profile section */
    Route::get('/profile/edit', [App\Http\Controllers\DashboardController::class, 'profile_edit'])->name('profile.edit');
    Route::post('password-change', [App\Http\Controllers\DashboardController::class, 'password_change'])->name('password-change');
    
    Route::get('/logout', [App\Http\Controllers\DashboardController::class, 'logout'])->name('logout');



Route::resource('role', RoleController::class);
Route::get('role/status/{role_id}', [RoleController::class, 'status'])->name('role.status');

/**role  */
Route::resource('permission', PermissionController::class);