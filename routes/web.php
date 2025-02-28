<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\TransactionController;

// Penalty payment route


// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Members Routes
Route::resource('members', MemberController::class);
Route::get('/members/{member}', [MemberController::class, 'show'])->name('members.show');

Route::post('/penalties/{penalty}/pay', [PenaltyController::class, 'pay'])->name('penalties.pay');
// Funds Routes
Route::resource('funds', FundController::class);

// Contributions Routes
Route::resource('contributions', ContributionController::class);

// Loans Routes
Route::resource('loans', LoanController::class);
// Loan repayment route
Route::post('/loans/{loan}/repay', [LoanController::class, 'repay'])->name('loans.repay');

// Penalties Routes
Route::resource('penalties', PenaltyController::class);

// Transactions Routes
Route::resource('transactions', TransactionController::class);