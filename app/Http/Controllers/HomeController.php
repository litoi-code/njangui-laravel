<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transfer;
use App\Models\Loan;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index()
    {
        // Calculate total account balance
        $totalAccountBalance = Account::sum('balance');

        // Calculate total transferred amount
        $totalTransferredAmount = Transfer::sum('amount');

        // Calculate total loan repayment
        $totalLoanRepayment = Loan::sum('total_repayment');

        return view('welcome', [
            'totalAccountBalance' => $totalAccountBalance,
            'totalTransferredAmount' => $totalTransferredAmount,
            'totalLoanRepayment' => $totalLoanRepayment,
        ]);
    }
}
