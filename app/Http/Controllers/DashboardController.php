<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Fund;
use App\Models\Loan;

class DashboardController extends Controller
{
    public function index()
    {
        $total_members = Member::count();
        $total_funds = Fund::sum('balance');
        $total_loans = Loan::sum('amount');

        return view('home', compact('total_members', 'total_funds', 'total_loans'));
    }
}
