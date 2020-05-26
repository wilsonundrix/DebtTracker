<?php

use App\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::truncate();

        $c1 = new Customer();
        $c1->user_id = 1;
        $c1->real_name = 'Jane Doe Brown';
        $c1->receipt_name = 'Doe Jane';
        $c1->phone_no = '0712384624';
        $c1->alternate_no = '0712091234';
        $c1->save();

        $c2 = new Customer();
        $c2->user_id = 1;
        $c2->real_name = 'Roselyne Njeri Maina';
        $c2->receipt_name = 'Bakhita Maina';
        $c2->phone_no = '0729852536';
        $c2->alternate_no = '0787687681';
        $c2->save();

        $c3 = new Customer();
        $c3->user_id = 1;
        $c3->real_name = 'Wilson Nduyu Maina';
        $c3->receipt_name = 'ndunya';
        $c3->phone_no = '0716729060';
        $c3->alternate_no = '0724678125';
        $c3->save();

    }
}
