<?php

use App\Http\Controllers\web\CompanyController;
use App\Http\Controllers\web\EmployeeController; // Tambahkan ini
use App\Http\Controllers\web\EmployeesController;
use App\Models\companies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Route untuk Management Companies
    Route::resource('companies', CompanyController::class);
    Route::get('employees/export', [EmployeesController::class, 'export'])->name('employees.export');
    Route::post('employees/import', [EmployeesController::class, 'import'])->name('employees.import');
    Route::get('employees/import-view',[EmployeesController::class,'importfile'])->name('employees.upload-import');
    // Route untuk Management Employees
    Route::resource('employees', EmployeesController::class);


    Route::get('/api/companies', [CompanyController::class, 'getApi'])->name('companies.api');
});
