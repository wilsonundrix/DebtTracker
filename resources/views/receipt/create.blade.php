@extends('layouts.app')

@section('link')
    <h3 class="float-left">Create Receipt for {{ $customer->receipt_name }}</h3>
    <a class="btn btn-primary float-right" href="{{ route('customer.show',$customer->id) }}">Back To Customer</a>
@endsection

@section('content')

    <form class="form-horizontal" method="POST" action="{{ route('receipt.store',['customer_id'=>$customer->id]) }}">
        @csrf
        <div class="row">
            <div class="form-group col-md-4">
                <label class="control-label">Receipt No</label>
                <input class="form-control" id="receipt_no" name="receipt_no" type="text"
                       placeholder="Enter receipt no" value="{{ old('receipt_no') }}">
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">Receipt Date</label>
                <input class="date form-control" id="receipt_date" name="receipt_date" type="date"
                       placeholder="Enter receipt Date" value={{ time() }}>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">Sale Amount</label>
                <input class="form-control" id="sale_amount" name="sale_amount" type="text"
                       placeholder="Enter Sale Amount"
                       value="{{ old('sale_amount') }}">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="payment_type">Select Payment Option:</label>
                <select class="form-control" id="payment_type" name="payment_type">
                    <option>cash</option>
                    <option>m-Pesa</option>
                    <option>Bank Transfer</option>
                    <option>cheque</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="control-label">Tendered Amount</label>
                <input class="form-control" id="paid_amount" name="paid_amount" type="text"
                       placeholder="Enter Amount Paid" value="{{ old('paid_amount') }}">
            </div>
        </div>
        <button class="btn btn-success btn-block" type="submit">Add Receipt</button>
    </form>

    {{--<script src="{{ asset('js/jquery.min.js') }}"></script>--}}
    {{--<script type="text/javascript">--}}
    {{--$('#receipt_date').datepicker({--}}
    {{--autoclose: true,--}}
    {{--format: 'yyyy-mm-dd',--}}
    {{--});--}}
    {{--</script>--}}

@endsection