@extends('layouts.app')

@section('link')
    <h3 class="float-left">View Customers</h3>
    <a class="btn btn-primary float-right" href="{{ route('customer.create') }}">Add New Customer</a>
@endsection

@section('content')
    <table class="table table-bordered">
        <thead class="bg-primary">
        <th>Receipt Name</th>
        <th>Actual Names</th>
        <th>Phone No.</th>
        <th>Alternate No.</th>
        <th>Balance</th>
        @can('view-customers')
            <th>Action</th>
        @endcan
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->receipt_name }}</td>
                <td>{{ $customer->real_name }}</td>
                <td>{{ $customer->phone_no }}</td>
                <td>{{ $customer->alternate_no }}</td>
                @if($customer->account->balance <= 0)
                    <td class="text-success">{{ $customer->account->balance }}</td>
                @else
                    <td class="text-danger">{{ $customer->account->balance }}</td>
                @endif
                <td>
                    @can('view-customers')
                        <a class="btn btn-primary float-left mr-1"
                           href="{{ route('customer.show',$customer) }}">View</a>
                    @endcan
                    @can('edit-customers')
                        <a class="btn btn-success float-left mr-1"
                           href="{{ route('customer.edit',$customer) }}">Edit</a>
                    @endcan
                    @can('delete-customers')
                        <form action="{{ route('customer.destroy',$customer) }}" class=" float-left" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection