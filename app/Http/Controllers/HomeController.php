<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch Savings and Investment accounts with their balances
        $savingsAccounts = Account::where('type', 'Savings')->get();
        $investmentAccounts = Account::where('type', 'Investment')->get();

        return view('welcome', [
            'savingsAccounts' => $savingsAccounts,
            'investmentAccounts' => $investmentAccounts,
        ]);
    }
}