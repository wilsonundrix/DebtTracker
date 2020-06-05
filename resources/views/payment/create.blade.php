@extends('layouts.app')

@section('link')
    <h3 class="float-left">Create Payment for {{ $receipt->receipt_no }}</h3>
    <a class="btn btn-primary float-right" href="{{ route('receipt.show',$receipt->id) }}">Back To Receipt</a>
@endsection

@section('content')

    <form class="form-horizontal" method="POST" action="{{ route('payment.store',['receipt_id'=>$receipt->id]) }}">
        @csrf

        <div class="row">
            <div class="form-group col-md-6">
                <label for="payment_type">Select Payment Option:</label>
                <select class="form-control" id="payment_type" name="payment_type">
                    <option>cash</option>
                    <option>m-pesa</option>
                    <option>Bank Transfer</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="control-label">Pay Amount</label>
                <input class="form-control" id="pay_amount" name="pay_amount" type="number"
                       placeholder="Enter payment amount" value="{{ old('pay_amount') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Extra Payment</label>
            <input class="form-control" id="extra_amount" name="extra_amount" type="text"
                   placeholder="Enter extra payment" value="{{ 0|old('extra_amount') }}">
        </div>
        <button class="btn btn-success btn-block" type="submit">Add Payment</button>
    </form>

@endsection