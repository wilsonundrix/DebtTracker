<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * @param Customer $customer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Customer $customer)
    {
        return view('receipt.create')->with('customer', $customer);
    }

    /**
     * @param Request $request
     * @param Customer $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Customer $customer)
    {
        $request->validate([
            'receipt_no' => 'required',
            'sale_amount' => 'required',
            'current_balance' => 'required',
        ]);

        $receipt = new Receipt();
        $receipt->customer_id = $customer->id;
        $receipt->receipt_no = $request->input('receipt_no');
        $receipt->sale_amount = $request->input('sale_amount');
        $receipt->current_balance = $request->input('current_balance');
        $receipt->save();
        return redirect()->route('customer.show', $receipt->customer);
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
