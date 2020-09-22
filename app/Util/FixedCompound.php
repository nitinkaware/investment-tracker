<?php

namespace App\Util;

class FixedCompound extends Compound
{
    public function currentInvestmentValue()
    {
        return round(
            $this->initialInvestment * pow(1 + ($this->interest / 100), $this->investedForYears()),
            2
        );
    }

    public function maturityValue()
    {
        return $this->currentInvestmentValue();
    }

    public function interestEarnedUntilNow()
    {
        return round(
            $this->currentInvestmentValue() - $this->initialInvestment,
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
