<?php

use App\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::truncate();

        $p1 = new Payment();
        $p1->user_id = Auth::user();
        $p1->receipt_id = 1;
        $p1->pay_amount = 3000;
        $p1->previous_balance = 5000;
        $p1->new_balance = 2000;
        $p1->payment_type = 'cash';
        $p1->extra_amount = 0;
        $p1->save();

        $p2 = new Payment();
        $p2->user_id = Auth::user();
        $p2->receipt_id = 1;
        $p2->pay_amount = 2000;
        $p2->previous_balance = 2000;
        $p2->new_balance = 0;
        $p2->payment_type = 'cash';
        $p2->extra_amount = 0;
        $p2->save();

        $p3 = new Payment();
        $p3->user_id = Auth::user();
        $p3->receipt_id = 2;
        $p3->pay_amount = 4000;
        $p3->previous_balance = 4500;
        $p3->new_balance = 500;
        $p3->payment_type = 'mpesa';
        $p3->extra_amount = 50;
        $p3->save();

        $p4 = new Payment();
        $p4->user_id = Auth::user();
        $p4->receipt_id = 2;
        $p4->pay_amount = 400;
        $p4->previous_balance = 500;
        $p4->new_balance = 100;
        $p4->payment_type = 'cash';
        $p4->extra_amount = 0;
        $p4->save();
    }
}
