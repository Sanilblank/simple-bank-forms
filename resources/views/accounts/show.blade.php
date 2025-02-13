@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Account Details</h2>
        <a href="{{ route('customers.show', $customer->customer_id) }}" class="btn btn-primary mb-3">Back to List</a>

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
    </div>
@endsection
