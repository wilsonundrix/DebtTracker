<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index')->with('customers', $customers);
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
        $customer->receipt_name = $request->input('receipt_name');
        $customer->real_name = $request->input('real_name');
        $customer->phone_no = $request->input('phone_no');
        $customer->alternate_no = $request->input('alternate_no');
        $customer->save();
        return redirect()->route('customer.index');
    }

    /**
     * @param Customer $customer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Customer $customer)
    {
        return view('customer.show')->with('customer', $customer);
    }

    /**
     * @param Customer $customer
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * @param Request $request
     * @param Customer $customer
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * @param Customer $customer
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
