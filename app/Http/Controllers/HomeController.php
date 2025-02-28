<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Fund;
use App\Models\Contribution;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch total counts and sums
        $totalMembers = Member::count();
        $totalFunds = Fund::count();
        $totalContributions = Contribution::sum('amount');

        return view('home', compact('totalMembers', 'totalFunds', 'totalContributions'));
    }
}