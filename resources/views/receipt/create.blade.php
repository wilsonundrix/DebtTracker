@extends('layouts.app')

@section('link')
    <h3 class="float-left">Create Receipt</h3>
    <a class="btn btn-primary float-right" href="{{ route('customer.index') }}">Back To Customer</a>
@endsection

@section('main_content')

    <form class="form-horizontal" method="POST" action="{{ route('receipt.store',$customer) }}">
        @csrf
        <div class="form-group">
            <label class="control-label">Receipt No</label>
            <input class="form-control" id="receipt_name" name="receipt_name" type="text"
                   placeholder="Enter receipt name">
        </div>
        <div class="form-group">
            <label class="control-label">Sale Amount</label>
            <input class="form-control" id="sale_amount" name="sale_amount" type="text" placeholder="Enter Sale Amount">
        </div>
        <div class="form-group">
            <label class="control-label">Balance</label>
            <input class="form-control" id="current_balance" name="current_balance" type="text" placeholder="Enter current_balance.">
        </div>

        <button class="btn btn-success btn-block" type="submit">Add Receipt</button>
    </form>

@endsection