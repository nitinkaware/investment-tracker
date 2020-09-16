<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class InvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        collect([
            [
                'name' => 'SBI Fixed',
                'invested_at' => now()->parse('27-Oct-2019'),
                'amount' => 200000,
                'interest' => 11,
                'type' => 'Fixed',
            ],
            [
                'name' => 'HDFC Fixed',
                'invested_at' => now()->parse('01-Jan-2019'),
                'amount' => 200000,
                'interest' => 11,
                'type' => 'Fixed',
            ],
            [
                'name' => 'HDFC Recurring',
                'invested_at' => now()->parse('01-May-2018'),
                'amount' => 10000,
                'interest' => 11,
                'type' => 'Recurring',
            ],
        ])->each(function ($investment) use ($user) {
            $user
                ->investments()
                ->create($investment);
        });
    }
}
