<?php

namespace App\Http\Controllers;

use App\Account;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index')->with([
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'receipt_name' => 'required',
            'real_name' => 'required',
            'phone_no' => 'required',
        ]);

        $customer = new Customer();
        $customer->user_id = Auth::id();
        $customer->receipt_name = $request->input('receipt_name');
        $customer->real_name = $request->input('real_name');
        $customer->phone_no = $request->input('phone_no');
        $customer->alternate_no = $request->input('alternate_no');
        $customer->save();

        $cus_id = $customer->id;
        $starting_balance = $request->input('starting_balance');

        Account::create(['customer_id' => $cus_id, 'balance' => $starting_balance]);

        return redirect()->route('customer.index')->with([
            'success' => 'Customer Created Successfully'
        ]);
    }

    /**
     * @param Customer $customer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Customer $customer)
    {
        return view('customer.show')->with([
            'customer' => $customer,
        ]);
    }

    /**
     * @param Customer $customer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit')->with([
            'customer' => $customer,
        ]);
    }

    /**
     * @param Request $request
     * @param Customer $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'receipt_name' => 'required',
            'real_name' => 'required',
            'phone_no' => 'required',
        ]);

        $customer->receipt_name = $request->input('receipt_name');
        $customer->real_name = $request->input('real_name');
        $customer->phone_no = $request->input('phone_no');
        $customer->alternate_no = $request->input('alternate_no');
        $customer->update();
        return redirect()->route('customer.index')->with([
            'success' => 'Customer Updated Successfully'
        ]);
    }

    /**
     * @param Customer $customer
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with([
            'success' => 'Customer Deleted Successfully'
        ]);
    }
}