<?php

namespace App\Util;

class FixedCompound extends Compound
{
    public function finalInvestmentValue()
    {
        return round(
            $this->initialInvestment * pow(1 + ($this->interest / 100), $this->investedForYears()),
            2
        );
    }

    public function totalInterestEarned()
    {
        return round(
            $this->finalInvestmentValue() - $this->initialInvestment,
            2
        );
    }

    public function withoutInterestInvestmentValue()
    {
        return round(
            $this->initialInvestment,
            2
        );
    }
}
