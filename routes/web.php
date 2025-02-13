<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
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
    Route::resource('customers.accounts', AccountController::class)->except(['index']);
});
