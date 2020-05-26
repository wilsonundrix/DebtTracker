<?php

namespace App\Http\Controllers;

use App\Account;
use App\Customer;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BatchController extends Controller
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
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'batch_amount' => 'required|integer',
        ]);

        $customer_id = $request['customer_id'];
        $batch_amount = $request['batch_amount'];
        $customer = Customer::whereId($customer_id)->first();
        $account = Account::whereCustomerId($customer_id)->first();

        foreach ($customer->receipts as $receipt) {

            if ($receipt->current_balance > 0) {

                $receipt_current_balance = $receipt->current_balance;
                if ($batch_amount >= $receipt->current_balance) {
                    // 1. Make Auto Payment
                    Payment::create([
                        'user_id' => Auth::id(),
                        'receipt_id' => $receipt->id,
                        'pay_amount' => $receipt_current_balance,
                        'previous_balance' => $receipt_current_balance,
                        'new_balance' => 0,
                        'payment_type' => 'cash',
                        'extra_amount' => 0,
                    ]);

                    // 2. Update receipt balance with new balance
                    $receipt->current_balance = 0;
                    $receipt->update();

                    // 3. Update account balance with receipt balance
                    $account->balance -= $receipt_current_balance;
                    $account->update();

                    // 4. update batch amount value
                    $batch_amount -= $receipt_current_balance;

                } else {
                    // 1. Make Auto Payment
                    Payment::create([
                        'user_id' => Auth::id(),
                        'receipt_id' => $receipt->id,
                        'pay_amount' => $batch_amount,
                        'previous_balance' => $receipt_current_balance,
                        'new_balance' => $receipt_current_balance - $batch_amount,
                        'payment_type' => 'cash',
                        'extra_amount' => 0,
                    ]);

                    // 2. Update receipt balance with new balance
                    $receipt->current_balance = $receipt_current_balance - $batch_amount;
                    $receipt->update();

                    // 3. Update account balance with receipt balance
                    $account->balance -= $batch_amount;
                    $account->update();

                    // 4. update batch amount value
                    $batch_amount -= $batch_amount;
                }
            }
        }

        if ($batch_amount > 0) {
            //deposit to account
            $account->balance -= $batch_amount;
            $account->update();
        }

        return redirect()->route('customer.show', $customer_id)->with([
            'success' => 'Batch Payment Made Successfully',
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
