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
    ];

    public function newCollection(array $models = [])
    {
        return new InvestmentCollection($models);
    }

    public function totalInterestEarned()
    {
        return $this->buildCompound()
                    ->totalInterestEarned();
    }

    public function currentInvestmentValue()
    {
        return $this->buildCompound()
                    ->currentInvestmentValue();
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

    public function buildCompound()
    {
        $compound = "App\\Util\\{$this->type}Compound";

        return (new $compound(
            $this->amount,
            $this->interest,
            $this->invested_at,
            now(),
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
