@extends('layouts.app')

@section('link')
    <h3 class="float-left">Create Customer</h3>
    <a class="btn btn-primary float-right" href="{{ route('customer.index') }}">Back To Customers</a>
@endsection

@section('main_content')

    <form class="form-horizontal" method="POST" action="{{ route('customer.store') }}">
        @csrf
        <div class="form-group">
            <label class="control-label">Receipt Name</label>
            <input class="form-control" id="receipt_name" name="receipt_name" type="text"
                   placeholder="Enter receipt name">
        </div>
        <div class="form-group">
            <label class="control-label">Real Name</label>
            <input class="form-control" id="real_name" name="real_name" type="text" placeholder="Enter real name">
        </div>
        <div class="form-group">
            <label class="control-label">Phone Number</label>
            <input class="form-control" id="phone_no" name="phone_no" type="text" placeholder="Enter phone no.">
        </div>
        <div class="form-group">
            <label class="control-label">Alternate Number</label>
            <input class="form-control" id="alternate_no" name="alternate_no" type="text"
                   placeholder="Enter alternate no.">
        </div>
        <button class="btn btn-success btn-block" type="submit">Add Customer</button>
    </form>

@endsection