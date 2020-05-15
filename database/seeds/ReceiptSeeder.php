<?php

use App\Receipt;
use Illuminate\Database\Seeder;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Receipt::truncate();

        $r1 = new Receipt();
        $r1->customer_id = 1;
        $r1->receipt_no = 139234;
        $r1->sale_amount = 5000;
        $r1->current_balance = 5000;
        $r1->save();

        $r1 = new Receipt();
        $r1->customer_id = 2;
        $r1->receipt_no = 139235;
        $r1->sale_amount = 4500;
        $r1->current_balance = 4500;
        $r1->save();

        $r1 = new Receipt();
        $r1->customer_id = 1;
        $r1->receipt_no = 139236;
        $r1->sale_amount = 3800;
        $r1->current_balance = 3800;
        $r1->save();


    }
}
