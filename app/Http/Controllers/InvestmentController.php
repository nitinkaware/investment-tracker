<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Inertia\Inertia;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::orderByDesc('invested_at')->get();

        return Inertia::render('Investment/Index', [
            'withoutInterestInvestmentValue' => $investments->withoutInterestInvestmentValue(),
            'totalInterestEarned' => $investments->totalInterestEarned(),
            'currentInvestmentValue' => $investments->currentInvestmentValue(),
            'investments' => $investments->mapWithInvestments(),
            'percentageIncreased' => $investments->percentageIncreased(),
        ]);
    }
}
