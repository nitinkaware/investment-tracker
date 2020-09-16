<?php

namespace App\Models\Collection;

use App\Models\Investment;
use Illuminate\Support\Collection;

class InvestmentCollection extends Collection
{
    public function totalInterestEarned()
    {
        return (int) $this->sum(function ($investment) {
            return $investment->totalInterestEarned();
        });
    }

    public function withoutInterestInvestmentValue()
    {
        return (int) $this->sum(function ($investment) {
            return $investment->withoutInterestInvestmentValue();
        });
    }

    public function finalInvestmentValue()
    {
        return (int) $this->sum(function ($investment) {
            return $investment->finalInvestmentValue();
        });
    }

    public function mapWithInvestments()
    {
        return $this->map(function (Investment $investment) {
            return [
                'investmentName' => $investment->name,
                'withoutInterestInvestmentValue' => (int) $investment->withoutInterestInvestmentValue(),
                'finalInvestmentValue' => (int) $investment->finalInvestmentValue(),
                'totalInterestEarned' => (int) $investment->totalInterestEarned(),
                'percentageIncreased' => $investment->percentageIncreased(),
                'investedAtRedable' => $this->redableFormat($investment),
                'investedAt' => $investment->invested_at->format('l, j F Y'),
            ];
        });
    }

    public function percentageIncreased()
    {
        $increased = $this->finalInvestmentValue() - $this->withoutInterestInvestmentValue();

        return round(
            ($increased / $this->withoutInterestInvestmentValue()) * 100,
            2
        );
    }

    public function redableFormat($investment)
    {
        if ($investment->invested_at->diffInMonths(now()) < 1) {
            return $investment->invested_at->diff(now())->format('%d Days').' Ago';
        }

        if ($investment->invested_at->diffInYears(now()) < 1) {
            return $investment->invested_at->diff(now())->format('%m Month %d Days').' Ago';
        }

        return $investment->invested_at->diff(now())->format('%y Year %m Month %d Days').' Ago';
    }
}