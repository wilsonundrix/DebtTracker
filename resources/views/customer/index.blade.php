@extends('layouts.app')

@section('link')
    <h3 class="float-left">View Customers</h3>
    <a class="btn btn-primary float-right" href="{{ route('customer.create') }}">Add New Customer</a>
@endsection

@section('main_content')
    <table class="table table-bordered">
        <thead class="bg-primary">
        <th>Receipt Name</th>
        <th>Actual Names</th>
        <th>Phone No.</th>
        <th>Alternate No.</th>
        <th>Action</th>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->receipt_name }}</td>
                <td>{{ $customer->real_name }}</td>
                <td>{{ $customer->phone_no }}</td>
                <td>{{ $customer->alternate_no }}</td>
                <td>
                    <a class="btn btn-outline-success"
                       href="{{ route('customer.show',$customer) }}">View Customer</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection