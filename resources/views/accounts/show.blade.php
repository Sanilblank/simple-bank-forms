@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Account Details</h2>
        <a href="{{ route('customers.show', $customer->customer_id) }}" class="btn btn-primary mb-3">Customer Details</a>

        <table class="table table-bordered">
            <tr>
                <th>Account ID</th>
                <td>{{ $account->account_id }}</td>
            </tr>
            <tr>
                <th>Branch Name</th>
                <td><a href="{{ route('branches.show', $account->branch_id) }}" target="_blank">{{ $account->branch->name }}</a></td>
            </tr>
            <tr>
                <th>Account Category</th>
                <td>{{ $account->category->account_category_value }}</td>
            </tr>
            <tr>
                <th>Balance(Rs.)</th>
                <td>{{ $account->balance }}</td>
            </tr>
            <tr>
                <th>Date Opened</th>
                <td>{{ $account->date_opened }}</td>
            </tr>
        </table>
        <a href="{{ route('customers.accounts.edit', [$customer->customer_id, $account->account_id]) }}" class="btn btn-warning">Edit</a>

        <h3 class="mt-5">Account Transactions</h3>

        @if (count($account->transactions))
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Transaction Type</th>
                    <th>Transaction Mode</th>
                    <th>Amount(Rs.)</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($account->transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->transaction_id }}</td>
                        <td>{{ $transaction->transactionType->transaction_type_value }}</td>
                        <td>{{ $transaction->transactionMode->transaction_mode_value }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No transactions for this account.</p>
        @endif
    </div>
@endsection
