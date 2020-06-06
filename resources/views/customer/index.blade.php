@php(extract($data))
@extends('layouts.app')

@section('link')
    <h3 class="float-left">View Customers</h3>
    <a class="btn btn-primary float-right" href="{{ route('customer.create') }}">Add New Customer</a>
@endsection

@section('content')
    <div class="row">

        <form action="{{route('customer.index')}}" method="get" class="form-group">

                    <input type="text" class="form-group" name="name" value="{{request()->query('name')}}">

                    <button class="btn btn-sm btn-primary" type="submit"> Fetch</button>


            </div>
        </form>
    <a href="{{route('customer.index')}}" class="btn btn-info btn-sm">Refresh/Reload</a>
    </div>

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
                           href="{{ route('customer.show',['customer'=>$customer]) }}">View</a>
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
{{$customers->render()}}
@endsection