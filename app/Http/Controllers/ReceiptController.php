<?php

namespace App\Http\Controllers;

use App\Account;
use App\Customer;
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
            'receipt_no' => 'required',
            'sale_amount' => 'required',
            'current_balance' => 'required',
        ]);

        $customer_id = $request['customer_id'];
        $receipt_no = $request->input('receipt_no');
        $sale_amount = $request->input('sale_amount');
        $receipt_remaining_balance = $request->input('current_balance');

        $account = Account::whereCustomerId($customer_id)->first();

        $receipt = new Receipt();
        $receipt->user_id = Auth::id();
        $receipt->customer_id = $customer_id;
        $receipt->receipt_no = $receipt_no;
        $receipt->sale_amount = $sale_amount;

        if ($account->balance < 0) {
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
