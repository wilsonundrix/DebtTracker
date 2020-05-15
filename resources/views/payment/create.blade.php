@extends('layouts.app')

@section('link')
    <h3 class="float-left">Create Payment</h3>
    <a class="btn btn-primary float-right" href="{{ route('customer.index') }}">Back To Receipt</a>
@endsection

@section('main_content')

    <form class="form-horizontal" method="POST" action="{{ route('payment.store',$receipt) }}">
        @csrf
        <div class="form-group">
            <label class="control-label">Pay Amount</label>
            <input class="form-control" id="pay_amount" name="pay_amount" type="number"
                   placeholder="Enter receipt name">
        </div>
        <div class="form-group">
            <label class="control-label">Extra Payment</label>
            <input class="form-control" id="extra_amount" name="extra_amount" type="text"
                   placeholder="Enter extra payment">
        </div>
        <div class="form-group">
            <label class="control-label">Payment Type</label>
            <input class="form-control" id="payment_type" name="payment_type" type="text"
                   placeholder="Enter payment type">
        </div>
        <button class="btn btn-success btn-block" type="submit">Add Payment</button>
    </form>

@endsection