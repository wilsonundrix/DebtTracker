<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Receipt;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     *
     */
    public function index()
    {
        //
    }

    /**
     * @param Receipt $receipt
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Receipt $receipt)
    {
        return view('payment.create')->with('receipt',$receipt);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'pay_amount' => 'required',
        ]);

        $pay_amount = $request->input('pay_amount');
        $previous_balance = $request->receipt()->current_balance;
        $new_balance = $previous_balance - $pay_amount;
        $extra_amount = $request->input('extra_amount');
        $payment_type = $request->input('payment_type');
        if ($extra_amount == null) {
            $extra_amount = 0;
        }

        $payment = new Payment();
        $payment->pay_amount = $pay_amount;
        $payment->previous_balance = $previous_balance;
        $payment->new_balance = $new_balance;
        $payment->extra_amount = $extra_amount;
        $payment->payment_type = $payment_type;

        {{ dd($payment); }}

        $payment->save();

        return redirect()->route('receipt.show');
    }

    /**
     * @param Payment $payment
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * @param Payment $payment
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * @param Request $request
     * @param Payment $payment
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * @param Payment $payment
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
