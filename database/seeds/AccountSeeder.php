<?php

use App\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create(['customer_id' => 1, 'balance' => 100]);
        Account::create(['customer_id' => 2, 'balance' => 250]);
        Account::create(['customer_id' => 3, 'balance' => 380]);
    }
}
