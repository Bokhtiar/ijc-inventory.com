<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/* Web auth routes */
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard']);

/* Web Routes */
// Route::get('/', function () {
//     return redirect()->route('dashboard');
// })->middleware('auth');


Route::group(['middleware' => ['auth', 'permission']], function () {

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
Route::post('/export-bill', [BillingController::class, 'exportBills'])->name('export-bill');

/** profile section */
Route::get('/profile/edit', [App\Http\Controllers\UserController::class, 'profile_edit'])->name('profile.edit');
Route::post('password-change', [App\Http\Controllers\UserController::class, 'password_change'])->name('password-change');
Route::put('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/logout', [App\Http\Controllers\DashboardController::class, 'logout'])->name('logout');

/** employe customer permission */
Route::resource('employee', EmployeeController::class);
Route::resource('customer', CustomerController::class);
Route::get('autocomplete/customer/search', [CustomerController::class, 'customerSearch']);
Route::resource('role', RoleController::class);
Route::get('role/status/{role_id}', [RoleController::class, 'status'])->name('role.status');
Route::resource('permission', PermissionController::class);
 
/** report */
Route::get('report/{type}', [ReportController::class, 'report'])->name('report.index');
Route::post('report-filter', [ReportController::class, 'reportFilter'])->name('report-filter');
Route::get('report/download/filter/{start_date}/{end_date}', [ReportController::class, 'reportFilterDownload'])->name('report.download.filter');


Route::get('report/download/{type}', [ReportController::class, 'reportDownload'])->name('report.download');
});