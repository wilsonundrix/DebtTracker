@extends('layouts.app')

@section('link')
    <h3 class="float-left">View Customer</h3>
    <a class="btn btn-primary float-right" href="{{ route('customer.index') }}">Back To Customers</a>
@endsection

@section('content')

    {{--Customer Info--}}
    <table class="table table-bordered">
        <thead class="bg-primary">
        <th>Receipt Name</th>
        <th>Actual Names</th>
        <th>Phone No.</th>
        <th>Alternate No.</th>
        </thead>
        <tbody>
        <tr>
            <td>{{ $customer->receipt_name }}</td>
            <td>{{ $customer->real_name }}</td>
            <td>{{ $customer->phone_no }}</td>
            <td>{{ $customer->alternate_no }}</td>
        </tr>
        </tbody>
    </table>
    {{--end of customer info--}}

    <div class="mb-4">
        <h3 class="float-left">Receipts</h3>
        <a class="float-right btn btn-primary" href="{{ route('receipt.create',['customer_id'=>$customer->id]) }}">Add
            Receipt</a>
    </div>

    <table class="table table-bordered">
        <thead class="bg-warning">
        <th>Receipt No</th>
        <th>Sale Amount</th>
        <th>Balance</th>
        <th>Time</th>
        <th>Action</th>
        </thead>
        <tbody>
        @foreach($customer->receipts as $receipt)
            <tr>
                <td>{{ $receipt->receipt_no }}</td>
                <td>{{ $receipt->sale_amount }}</td>
                <td>{{ $receipt->current_balance }}</td>
                <td>{{ $receipt->created_at }}</td>
                <td>
                    <a class="btn btn-outline-success"
                       href="{{ route('receipt.show',$receipt) }}">View Receipt</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection