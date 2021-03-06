<?php

namespace App\Http\Controllers;

use App\Account;
use App\Customer;
use App\Payment;
use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    public function create(Request $request)
    {
        $customer = Customer::whereId($request['customer_id'])->first();
        return view('receipt.create')->with([
            'customer' => $customer,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'receipt_no' => 'required|unique:receipts',
            'sale_amount' => 'required',
            'paid_amount' => 'required',
        ]);

        $customer_id = $request['customer_id'];
        $receipt_no = $request->input('receipt_no');
        $sale_amount = $request->input('sale_amount');
        $paid_amount = $request->input('paid_amount');
        $payment_type = $request->input('payment_type');

        $receipt_remaining_balance = $sale_amount - $paid_amount;
        $account = Account::whereCustomerId($customer_id)->first();

        $receipt = new Receipt();
        $receipt->user_id = Auth::id();
        $receipt->customer_id = $customer_id;
        $receipt->receipt_no = $receipt_no;
        $receipt->sale_amount = $sale_amount;
        $receipt->paid_amount = $paid_amount;

        if (($account->balance * -1) > 0) {
            //you can deduct from account
            if ($receipt_remaining_balance < ($account->balance * -1)) {
                $receipt->current_balance = 0;
            } else {
                $receipt->current_balance = $receipt_remaining_balance - ($account->balance * -1);
            }
        } else {
            $receipt->current_balance = $receipt_remaining_balance;
        }
        $receipt->save();

        //create an automatic payment
        Payment::create([
            'user_id' => Auth::id(),
            'receipt_id' => $receipt->id,
            'pay_amount' => $paid_amount,
            'previous_balance' => $sale_amount,
            'new_balance' => $receipt_remaining_balance,
            'payment_type' => $payment_type,
            'payment_tag' => 'singular',
            'extra_amount' => 0,
        ]);

        //update account balance with receipt balance
        $account->balance += $receipt_remaining_balance;
        $account->update();

        return redirect()->route('customer.show', $customer_id)->with([
            'success' => 'Receipt Added And Account Updated Successfully',
        ]);
    }

    /**
     * @param Receipt $receipt
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Receipt $receipt)
    {
        return view('receipt.show')->with('receipt', $receipt);
    }

    /**
     * @param Receipt $receipt
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * @param Request $request
     * @param Receipt $receipt
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
    }

    /**
     * @param Receipt $receipt
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
