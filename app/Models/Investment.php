<?php

namespace App\Models;

use App\Models\Collection\InvestmentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'interest' => 'float',
        'amount' => 'float',
        'invested_at' => 'datetime',
        'invested_till' => 'datetime',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function newCollection(array $models = [])
    {
        return new InvestmentCollection($models);
    }

    public function interestEarnedUntilNow()
    {
        return $this->buildCompound()
                    ->interestEarnedUntilNow();
    }
    
    public function interestEarnedOnMaturity()
    {
        return $this->buildCompound($this->invested_till)
                    ->interestEarnedUntilNow();
    }

    public function currentInvestmentValue()
    {
        return $this->buildCompound()
                    ->currentInvestmentValue();
    }

    public function maturityValue()
    {
        return $this->buildCompound($this->invested_till)
                    ->maturityValue();
    }

    public function withoutInterestInvestmentValue()
    {
        return $this->buildCompound()
                    ->withoutInterestInvestmentValue();
    }

    public function percentageIncreased()
    {
        return $this->buildCompound()
                    ->percentageIncreased();
    }

    public function buildCompound($investedTill = null)
    {
        $investedTill = $investedTill ?? now();

        $compound = "App\\Util\\{$this->type}Compound";

        return (new $compound(
            $this->amount,
            $this->interest,
            $this->invested_at,
            $investedTill,
        ));
    }

    public function isFixed()
    {
        return $this->type === 'Recurring';
    }

    public function isRecurring()
    {
        return $this->type === 'Recurring';
    }
}
