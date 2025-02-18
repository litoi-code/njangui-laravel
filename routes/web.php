<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\LoanController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('accounts', AccountController::class);
Route::resource('transfers', TransferController::class);
Route::resource('loans', LoanController::class);

