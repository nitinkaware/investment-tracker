<?php

namespace App\Util;

class RecurringCompound extends Compound
{
    public function finalInvestmentValue()
    {
        return round(
            $this->initialInvestment * ($this->investedForMonths() + 1) + $this->totalInterestEarned(),
            2
        );
    }

    public function totalInterestEarned()
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
            $this->finalInvestmentValue() - $this->totalInterestEarned(),
            2
        );
    }
}
