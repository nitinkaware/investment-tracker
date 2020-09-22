<?php

namespace App\Util;

class RecurringCompound extends Compound
{
    public function currentInvestmentValue()
    {
        return $this->investmentValue(1);
    }

    public function maturityValue()
    {
        return $this->investmentValue();
    }

    protected function investmentValue(int $addMonths = 0)
    {
        return round(
            $this->initialInvestment * ($this->investedForMonths() + $addMonths) + $this->interestEarnedUntilNow(),
            2
        );
    }

    public function interestEarnedUntilNow()
    {
        $p = $this->initialInvestment;
        $i = $this->interest;
        $n = $this->investedForMonths();
        $e = pow((1 + $i / 400), $n / 3);
        $d = pow((1 + $i / 400), (-1 / 3));
        $m = ($p * ($e - 1)) / (1 - $d);

        return round(
            $m - ($p * $n),
            2
        );
    }

    public function withoutInterestInvestmentValue()
    {
        return round(
            $this->currentInvestmentValue() - $this->interestEarnedUntilNow(),
            2
        );
    }
}
