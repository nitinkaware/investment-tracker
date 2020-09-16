<?php

namespace App\Util;

use Carbon\Carbon;

abstract class Compound
{
    protected float $initialInvestment = 0;

    protected float $interest = 0;

    protected $investedAt = null;

    protected $investedTill = null;

    public function __construct(float $initialInvestment, float $interest, Carbon $investedAt, Carbon $investedTill)
    {
        $this->initialInvestment = $initialInvestment;

        $this->interest = $interest;

        $this->investedAt = $investedAt;

        $this->investedTill = $investedTill;
    }

    protected function investedForDuration()
    {
        return $this->investedAt->diffInMonths($this->investedTill);
    }

    protected function investedForYears()
    {
        return $this->investedForDuration() / 12;
    }

    protected function investedForMonths()
    {
        return $this->investedForDuration();
    }

    public function percentageIncreased()
    {
        $increased = $this->currentInvestmentValue() - $this->withoutInterestInvestmentValue();

        return round(
            ($increased / $this->withoutInterestInvestmentValue()) * 100,
            2
        );
    }

    abstract public function currentInvestmentValue();

    abstract public function totalInterestEarned();

    abstract public function withoutInterestInvestmentValue();
}
