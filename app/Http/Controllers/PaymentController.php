<?php

namespace App\Http\Controllers;

use App\Account;
use App\Payment;
use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $receipt = Receipt::whereId($request['receipt_id'])->first();
        return view('payment.create')->with([
            'receipt' => $receipt,
        ]);
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

        $receipt_id = $request['receipt_id'];
        $receipt = Receipt::whereId($receipt_id)->first();
        $previous_balance = $receipt->current_balance;

        $pay_amount = $request->input('pay_amount');
        $extra_amount = $request->input('extra_amount');
        $payment_type = $request->input('payment_type');

        $payment = new Payment();
        $payment->user_id = Auth::id();
        $payment->receipt_id = $receipt_id;
        $payment->previous_balance = $previous_balance;
        if ($pay_amount >= $previous_balance) {
            $payment->pay_amount = $previous_balance;
            $payment->new_balance = 0;
        } else {
            $payment->pay_amount = $pay_amount;
            $payment->new_balance = $previous_balance - $pay_amount;
        }
        $payment->extra_amount = $extra_amount;
        $payment->payment_type = $payment_type;
        $payment->save();

        $receipt->current_balance = $payment->new_balance;
        $receipt->update();

        $account = Account::whereCustomerId($receipt->customer_id)->first();
        $account->balance -= $pay_amount;
        $account->update();

        return redirect()->route('receipt.show', $receipt_id)->with([
            'success' => 'Payment Added And Account Updated Successfully',
        ]);
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
