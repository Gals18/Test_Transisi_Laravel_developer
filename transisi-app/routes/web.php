<?php

use App\Http\Controllers\web\CompanyController;
use App\Http\Controllers\web\EmployeeController; // Tambahkan ini
use App\Http\Controllers\web\EmployeesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Route untuk Management Companies
    Route::resource('companies', CompanyController::class);
    
    // Route untuk Management Employees
    Route::resource('employees', EmployeesController::class);
});