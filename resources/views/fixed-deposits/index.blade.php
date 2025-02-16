@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Fixed Deposits</h2>

        @if (count($fixedDeposits))
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th>Fixed Deposit ID</th>
                    <th>Customer Name</th>
                    <th>Account ID</th>
                    <th>Deposit Amount(Rs.)</th>
                    <th>Interest Rate(%)</th>
                    <th>Created At</th>
                    <th>Maturity Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fixedDeposits as $fixedDeposit)
                    <tr>
                        <td>{{ $fixedDeposit->fixed_deposit_id }}</td>
                        <td><a href="{{route('customers.show', $fixedDeposit->customer_id)}}" target="_blank">{{ $fixedDeposit->customer->name }}</a></td>
                        <td><a href="{{route('customers.accounts.show', [$fixedDeposit->customer_id, $fixedDeposit->account_id])}}" target="_blank">{{ $fixedDeposit->account_id }}</a></td>
                        <td>{{ $fixedDeposit->deposit_amount }}</td>
                        <td>{{ $fixedDeposit->interest_rate }}</td>
                        <td>{{ $fixedDeposit->created_at->format('Y-m-d') }}</td>
                        <td>{{ $fixedDeposit->maturity_date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No fixed deposits found.</p>
        @endif
    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
