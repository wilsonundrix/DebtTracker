@extends('layouts.app')

@section('link')
    <h3 class="float-left">Create Customer</h3>
    <a class="btn btn-primary float-right" href="{{ route('customer.index') }}">Back To Customers</a>
@endsection

@section('content')

    <form class="form-horizontal" method="POST" action="{{ route('customer.store') }}">
        @csrf
        <div class="form-group">
            <label class="control-label">Receipt Name</label>
            <input class="form-control" id="receipt_name" name="receipt_name" type="text"
                   placeholder="Enter receipt name" value="{{ old('receipt_name') }}">
        </div>
        <div class="form-group">
            <label class="control-label">Real Name</label>
            <input class="form-control" id="real_name" name="real_name" type="text" placeholder="Enter real name"
                   value="{{ old('real_name') }}">
        </div>
        <div class="form-group">
            <label class="control-label">Phone Number</label>
            <input class="form-control" id="phone_no" name="phone_no" type="text" placeholder="Enter phone no."
                   value="{{ old('phone_no') }}">
        </div>
        <div class="form-group">
            <label class="control-label">Alternate Number</label>
            <input class="form-control" id="alternate_no" name="alternate_no" type="text"
                   placeholder="Enter alternate no." value="{{ old('alternate_no') }}">
        </div>
        <div class="form-group">
            <label class="control-label">Starting Balance</label>
            <input class="form-control" id="starting_balance" name="starting_balance" type="text"
                   placeholder="Enter Starting Balance" value="{{ old('starting_balance') }}">
        </div>
        <button class="btn btn-success btn-block" type="submit">Add Customer</button>
    </form>

@endsection