@extends('layouts.app')

@section('link')
    <h3 class="float-left">Edit Customer</h3>
    <a class="btn btn-primary float-right" href="{{ route('customer.index') }}">Back To Customers</a>
@endsection

@section('content')

    <form class="form-horizontal" method="POST" action="{{ route('customer.update',$customer) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="control-label">Receipt Name</label>
            <input class="form-control" id="receipt_name" name="receipt_name" type="text"
                   value="{{ $customer->receipt_name }}">
        </div>
        <div class="form-group">
            <label class="control-label">Real Name</label>
            <input class="form-control" id="real_name" name="real_name" type="text"
                   value="{{ $customer->real_name }}">
        </div>
        <div class="form-group">
            <label class="control-label">Phone Number</label>
            <input class="form-control" id="phone_no" name="phone_no" type="text" value="{{ $customer->phone_no }}">
        </div>
        <div class="form-group">
            <label class="control-label">Alternate Number</label>
            <input class="form-control" id="alternate_no" name="alternate_no" type="text"
                   value="{{ $customer->alternate_no }}">
        </div>
        <button class="btn btn-success btn-block" type="submit">Save Customer changes</button>
    </form>

@endsection