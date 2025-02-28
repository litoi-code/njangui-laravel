<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Fund;
use App\Models\Loan;
use App\Models\Transaction;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $members = Member::where('name', 'LIKE', "%{$query}%")->get();
        $funds = Fund::where('name', 'LIKE', "%{$query}%")->get();
        $loans = Loan::where('principal', 'LIKE', "%{$query}%")->get();
        $transactions = Transaction::where('amount', 'LIKE', "%{$query}%")->get();

        return response()->json([
            'members' => $members,
            'funds' => $funds,
            'loans' => $loans,
            'transactions' => $transactions
        ]);
    }
}
