<?php

namespace App\Models\Collection;

use App\Models\Investment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class InvestmentCollection extends Collection
{
    public function interestEarnedUntilNow()
    {
        return (int) $this->sum(fn (Investment $investment) => $investment->interestEarnedUntilNow());
    }
    
    public function interestEarnedOnMaturity()
    {
        return (int) $this->sum(fn (Investment $investment) => $investment->interestEarnedOnMaturity());
    }

    public function withoutInterestInvestmentValue()
    {
        return (int) $this->sum(fn (Investment $investment) => $investment->withoutInterestInvestmentValue());
    }

    public function currentInvestmentValue()
    {
        return (int) $this->sum(fn (Investment $investment) => $investment->currentInvestmentValue());
    }

    public function mapWithInvestments()
    {
        return $this->map(function (Investment $investment) {
            return [
                'investmentName' => $investment->name,
                'isRecurring' => $investment->isRecurring(),
                'amount' => $investment->amount,

                'withoutInterestInvestmentValue' => (int) $investment->withoutInterestInvestmentValue(),
                'currentInvestmentValue' => (int) $investment->currentInvestmentValue(),
                'maturityValue' => (int) $investment->maturityValue(),
                'interestEarnedUntilNow' => (int) $investment->interestEarnedUntilNow(),
                'percentageIncreased' => $investment->percentageIncreased(),

                'investedAtRedable' => $this->redableFormat($investment->invested_at).' Ago',
                'investedAt' => $investment->invested_at->format('l, j F Y'),

                'investedTill' => $investment->invested_till->format('l, j F Y'),
                'investedTillRedable' => $this->redableFormat($investment->invested_till),
            ];
        });
    }

    public function percentageIncreased()
    {
        $increased = $this->currentInvestmentValue() - $this->withoutInterestInvestmentValue();

        return round(
            ($increased / $this->withoutInterestInvestmentValue()) * 100,
            2
        );
    }

    public function redableFormat(Carbon $timestamp)
    {
        if ($timestamp->diffInMonths(now()) < 1) {
            return $timestamp->diff(now())->format('%d Days');
        }

        if ($timestamp->diffInYears(now()) < 1) {
            return $timestamp->diff(now())->format('%m Month %d Days');
        }

        return $timestamp->diff(now())->format('%y Year %m Month %d Days');
    }
}
