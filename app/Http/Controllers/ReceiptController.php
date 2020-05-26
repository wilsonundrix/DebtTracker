<?php

namespace App\Http\Controllers;

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

        $receipt = new Receipt();
        $receipt->user_id = Auth::id();
        $receipt->customer_id = $customer_id;
        $receipt->receipt_no = $request->input('receipt_no');
        $receipt->sale_amount = $request->input('sale_amount');
        $receipt->current_balance = $request->input('current_balance');
        $receipt->save();
        return redirect()->route('customer.show', $customer_id);
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
