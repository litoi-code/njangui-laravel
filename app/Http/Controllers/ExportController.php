<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Contribution;
use App\Models\Loan;
use App\Models\Penalty;

class ExportController extends Controller
{
    public function exportContributionsPDF()
    {
        $contributions = Contribution::all();
        $pdf = PDF::loadView('exports.contributions', compact('contributions'));
        return $pdf->download('contributions_report.pdf');
    }

    public function exportLoansPDF()
    {
        $loans = Loan::all();
        $pdf = PDF::loadView('exports.loans', compact('loans'));
        return $pdf->download('loans_report.pdf');
    }

    public function exportPenaltiesPDF()
    {
        $penalties = Penalty::all();
        $pdf = PDF::loadView('exports.penalties', compact('penalties'));
        return $pdf->download('penalties_report.pdf');
    }
}

