<?php

use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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
    Route::get('/dashboard', [app\Http\Controllers\User\UserDashboardController::class, 'index'])->name('dashboard');
});

/* Admin auth routes */
Route::group(["as" => 'admin.', "prefix" => 'admin', "middleware" => ['auth', 'admin']], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');

    /* billing */
    Route::get('/billing/list', [App\Http\Controllers\Admin\BillingController::class, 'index'])->name('billing.list');
    Route::get('/billing/trash/list', [App\Http\Controllers\Admin\BillingController::class, 'trash_list'])->name('billing.trash.list');
    Route::get('/billing-ways-service/{id}', [App\Http\Controllers\Admin\BillingController::class, 'bllling_ways_service']);
    Route::get('/billing/edit/{id}', [App\Http\Controllers\Admin\BillingController::class, 'edit'])->name('billing.edit');
    Route::get('/billing/show/{id}', [App\Http\Controllers\Admin\BillingController::class, 'show'])->name('billing.show');
    Route::get('/billing/pdf/{id}', [App\Http\Controllers\Admin\BillingController::class, 'pdfDownload'])->name('billing.pdf');
    Route::get('/billing/create', [App\Http\Controllers\Admin\BillingController::class, 'create'])->name('billing.create');
    Route::post('/billing/store', [App\Http\Controllers\Admin\BillingController::class, 'store'])->name('billing.store');
    Route::post('/billing/update/{id}', [App\Http\Controllers\Admin\BillingController::class, 'update'])->name('billing.update');
    Route::delete('/billing/destroy/{id}', [App\Http\Controllers\Admin\BillingController::class, 'destroy'])->name('billing.destroy');
    Route::get('/billing/print/{id}', [App\Http\Controllers\Admin\BillingController::class, 'print'])->name('billing.print');
    Route::get('/billing/trash/{id}', [App\Http\Controllers\Admin\BillingController::class, 'status'])->name('billing.trash');
    Route::post('/export-bill', [BillingController::class,'exportBills'])->name('export-bill');

    /** profile section */
    Route::get('/profile/edit', [App\Http\Controllers\Admin\AdminDashboardController::class, 'profile_edit'])->name('profile.edit');
    Route::post('password-change', [App\Http\Controllers\Admin\AdminDashboardController::class, 'password_change'])->name('password-change');
    
    Route::get('/logout', [App\Http\Controllers\Admin\AdminDashboardController::class, 'logout'])->name('logout');
});


Route::resource('role', RoleController::class);
Route::get('role/status/{role_id}', [RoleController::class, 'status'])->name('role.status');

/**role  */
Route::resource('permission', PermissionController::class);