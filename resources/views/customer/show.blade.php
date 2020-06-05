@extends('layouts.app')

@section('link')
    <h3 class="float-left">View Customer</h3>
    <a class="btn btn-primary float-right" href="{{ route('customer.index') }}">Back To Customers</a>
@endsection

@section('content')
    {{--Customer Info--}}
    <table class="table table-bordered">
        <thead class="bg-primary">
        <th>Receipt Name</th>
        <th>Actual Names</th>
        <th>Phone No.</th>
        <th>Alternate No.</th>
        <th>Balance</th>
        </thead>
        <tbody>
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
        </tr>
        </tbody>
    </table>
    {{--end of customer info--}}

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="form-horizontal" method="POST"
                  action="{{ route('batch.store',['customer_id'=>$customer->id]) }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="payment_type">Payment Option:</label>
                        <select class="form-control" id="payment_type" name="payment_type">
                            <option>cash</option>
                            <option>m-pesa</option>
                            <option>Bank Transfer</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Batch Payment</label>
                        <input class="form-control" id="batch_amount" name="batch_amount" type="number"
                               placeholder="Enter batch amount">
                    </div>
                </div>

                <button class="btn btn-success btn-block mb-2" type="submit">Make Payment</button>
            </form>
        </div>
    </div>

    <div class="mb-4">
        <h3 class="float-left">Receipts</h3>
        <a class="float-right btn btn-primary" href="{{ route('receipt.create',['customer_id'=>$customer->id]) }}">Add
            Receipt</a>
    </div>

    <table class="table table-bordered">
        <thead class="bg-warning">
        <th>Receipt No</th>
        <th>Sale Amount</th>
        <th>Tendered Amount</th>
        <th>Balance</th>
        <th>Time</th>
        <th>Action</th>
        </thead>
        <tbody>
        @foreach($customer->receipts->sortDesc() as $receipt)
            <tr>
                <td>{{ $receipt->receipt_no }}</td>
                <td>{{ $receipt->sale_amount }}</td>
                <td>{{ $receipt->paid_amount }}</td>
                <td>{{ $receipt->current_balance }}</td>
                <td>{{ $receipt->created_at }}</td>
                <td>
                    <a class="btn btn-outline-success"
                       href="{{ route('receipt.show',$receipt) }}">View Receipt</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection