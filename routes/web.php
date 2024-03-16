<?php

use App\Http\Controllers\Admin\BillingController;
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
    Route::get('/billing/show/{id}', [App\Http\Controllers\Admin\BillingController::class, 'show'])->name('billing.show');
    Route::get('/billing/pdf/{id}', [App\Http\Controllers\Admin\BillingController::class, 'pdfDownload'])->name('billing.pdf');
    Route::get('/billing/create', [App\Http\Controllers\Admin\BillingController::class, 'create'])->name('billing.create');
    Route::post('/billing/store', [App\Http\Controllers\Admin\BillingController::class, 'store'])->name('billing.store');
    Route::delete('/billing/destroy/{id}', [App\Http\Controllers\Admin\BillingController::class, 'destroy'])->name('billing.destroy');
    Route::get('/billing/print/{id}', [App\Http\Controllers\Admin\BillingController::class, 'print'])->name('billing.print');
    Route::get('/billing/trash/{id}', [App\Http\Controllers\Admin\BillingController::class, 'status'])->name('billing.trash');
    Route::get('/billing/edit/{id}', [App\Http\Controllers\Admin\BillingController::class, 'edit'])->name('billing.edit');
    Route::post('/billing/update/{id}', [App\Http\Controllers\Admin\BillingController::class, 'update'])->name('billing.update');
    Route::get('/billing-ways-service/{id}', [App\Http\Controllers\Admin\BillingController::class, 'bllling_ways_service']);
    Route::get('/billing/restore/{id}', [App\Http\Controllers\Admin\BillingController::class, 'restore'])->name('billing.restore');
    Route::get('/billing/softDeleteData', [App\Http\Controllers\Admin\BillingController::class, 'softDeleteData'])->name('billing.softDeleteData');
    Route::get('/billing/show/softDelete/{id}', [App\Http\Controllers\Admin\BillingController::class, 'softDeleteDataShow'])->name('billing.show.softDelete');
    Route::delete('/billing/soft-destroy/{id}', [App\Http\Controllers\Admin\BillingController::class, 'softDataRestore'])->name('billing.soft-destroy');

    // employee
    Route::get('/employee/list', [App\Http\Controllers\Admin\EmployeeController::class, 'index'])->name('employee.list');
    Route::get('/employee/create', [App\Http\Controllers\Admin\EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee/store', [App\Http\Controllers\Admin\EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/edit/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/employee/update/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/destroy/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::get('/employee/show/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'show'])->name('employee.show');
    Route::get('/employee/softdeleteData', [App\Http\Controllers\Admin\EmployeeController::class, 'softDeleteList'])->name('employee.softdeleteData');
    Route::delete('/employee/soft-destroy/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'softDataRestore'])->name('employee.soft-destroy');

    //filter
    Route::get('/filter', [App\Http\Controllers\Admin\FilterController::class, 'index'])->name('filter');
    Route::post('/filter/company_name', [App\Http\Controllers\Admin\FilterController::class, 'companyfilter'])->name('filter.company_name');
    Route::post('/filter/between-date', [App\Http\Controllers\Admin\FilterController::class, 'betweenDate'])->name('filter.between-date');

    //download bill
     Route::post('/downloadBill/compnay_name_ways', [App\Http\Controllers\Admin\FilterController::class, 'donwloadCompnayWays'])->name('downloadBill.compnay_name_ways');
    
    // export bill
    Route::post('/export-bill', [BillingController::class, 'exportBills'])->name('export-bill');
    Route::get('/logout', [App\Http\Controllers\Admin\AdminDashboardController::class, 'logout'])->name('logout');
});
