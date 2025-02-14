<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FixedDepositController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('branches.employees', EmployeeController::class)->except(['index']);
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::resource('customers.accounts', AccountController::class)->except(['index']);
    Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
    Route::resource('loans', LoanController::class)->only(['index', 'show']);
    Route::get('/loans/{loan}/update-status/{status}', [LoanController::class, 'updateStatus'])->name('loans.update-status');
    Route::get('/fixed-deposits', [FixedDepositController::class, 'index'])->name('fixed-deposits.index');
});
