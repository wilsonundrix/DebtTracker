@extends('layouts.app')

@section('link')
    <h3 class="float-left">View Receipt</h3>
    <a class="btn btn-primary float-right" href="{{ route('customer.show',$receipt->customer) }}">Back To Customer</a>
@endsection

@section('content')

    <table class="table table-bordered">
        <thead class="bg-primary">
        <th>Receipt No</th>
        <th>Sale Amount</th>
        <th>Balance</th>
        <th>Date</th>
        </thead>
        <tbody>
        <tr>
            <td>{{ $receipt->receipt_no }}</td>
            <td>{{ $receipt->sale_amount }}</td>
            <td>{{ $receipt->current_balance }}</td>
            <td>{{ $receipt->created_at }}</td>
        </tr>
        </tbody>
    </table>

    <div class="mb-4">
        <h3 class="float-left">Payments</h3>
        @if($receipt->current_balance > 0)
            <a class="float-right btn btn-primary" href="{{ route('payment.create',['receipt_id'=>$receipt->id]) }}">
                Add Payment</a>
        @endif
        <div>
            <table class="table table-bordered">
                <thead class="bg-warning">
                <th>Receipt No</th>
                <th>Previous Balance</th>
                <th>Pay Amount</th>
                <th>New Balance</th>
                <th>Time</th>
                </thead>
                <tbody>

                @if(count($receipt->payments) <1)
                    <h3 class="text-center">
                        No Payments Made
                    </h3>
                @endif

                @foreach($receipt->payments as $payment)
                    <tr>
                        <td>{{ $payment->receipt->receipt_no }}</td>
                        <td>{{ $payment->previous_balance }}</td>
                        <td>{{ $payment->pay_amount }}</td>
                        <td>{{ $payment->new_balance }}</td>
                        <td>{{ $payment->created_at }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection