<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            'HDFC Bank',
            'State Bank Of India',
            'दहिगाव पतसंस्था',
            'गायकवाड पतसंस्था'
        ])->each(fn ($bank) => Bank::create(['name' => $bank]));
    }
}
