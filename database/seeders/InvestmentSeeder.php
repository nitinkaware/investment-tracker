<?php

namespace Database\Seeders;

use App\Models\Bank;
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
                'id' => 1,
                'bank_id' => Bank::where('name', 'गायकवाड पतसंस्था')->first()->getKey(),
                'name' => 'गायकवाड पतसंस्था',
                'invested_at' => now()->parse('27-Oct-2019'),
                'invested_till' => now()->parse('27-Oct-2020'),
                'amount' => 200000,
                'interest' => 11,
                'type' => 'Fixed',
            ],
            [
                'id' => 2,
                'bank_id' => Bank::where('name', 'दहिगाव पतसंस्था')->first()->getKey(),
                'name' => 'दहिगाव पतसंस्था',
                'invested_at' => now()->parse('11 Sep 2020'),
                'invested_till' => now()->parse('11 Sep 2021'),
                'amount' => 200000,
                'interest' => 10.5,
                'type' => 'Fixed',
            ],
            [
                'id' => 3,
                'bank_id' => Bank::where('name', 'दहिगाव पतसंस्था')->first()->getKey(),
                'name' => 'दहिगाव पतसंस्था',
                'invested_at' => now()->parse('9-11-2018'),
                'invested_till' => now()->parse('9-11-2020'),
                'amount' => 110000,
                'interest' => 12,
                'type' => 'Fixed',
            ],
            [
                'id' => 4,
                'bank_id' => Bank::where('name', 'HDFC Bank')->first()->getKey(),
                'name' => 'HDFC Fixed',
                'invested_at' => now()->parse('1-April-2020'),
                'invested_till' => now()->parse('1-April-2021'),
                'amount' => 100000,
                'interest' => 5.6,
                'type' => 'Fixed',
            ],
            [
                'id' => 5,
                'bank_id' => Bank::where('name', 'HDFC Bank')->first()->getKey(),
                'name' => 'HDFC Fixed',
                'invested_at' => now()->parse('1 July 2020'),
                'invested_till' => now()->parse('1 July 2021'),
                'amount' => 100000,
                'interest' => 5.6,
                'type' => 'Fixed',
            ],
            [
                'id' => 6,
                'bank_id' => Bank::where('name', 'HDFC Bank')->first()->getKey(),
                'name' => 'HDFC Recurring',
                'invested_at' => now()->parse('06 Jan 2020'),
                'invested_till' => now()->parse('06 Jan 2020')->addYear(1),
                'amount' => 10000,
                'interest' => 6.3,
                'type' => 'Recurring',
            ],
            [
                'id' => 7,
                'bank_id' => Bank::where('name', 'HDFC Bank')->first()->getKey(),
                'name' => 'HDFC Recurring',
                'invested_at' => now()->parse('09 May 2020'),
                'invested_till' => now()->parse('09 May 2020')->addMonths(6),
                'amount' => 5000,
                'interest' => 4.75,
                'type' => 'Recurring',
            ],
            [
                'id' => 9,
                'bank_id' => Bank::where('name', 'State Bank Of India')->first()->getKey(),
                'name' => 'SBI Recurring',
                'invested_at' => now()->parse('02 Nov 2019'),
                'invested_till' => now()->parse('02 Nov 2019')->addYear(1),
                'amount' => 5000,
                'interest' => 6.4,
                'type' => 'Recurring',
            ]
        ])->each(function ($investment) use ($user) {
            $user
                ->investments()
                ->create($investment);
        });
    }
}
