@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Accounts List</h2>

        @if (count($accounts))
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Account ID</th>
                    <th>Customer Name</th>
                    <th>Branch Name</th>
                    <th>Account Category</th>
                    <th>Balance(Rs.)</th>
                    <th>Date Opened</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $account->account_id }}</td>
                        <td><a href="{{ route('customers.show', $account->customer_id) }}" target="_blank">{{ $account->customer->name }}</a></td>
                        <td><a href="{{ route('branches.show', $account->branch_id) }}" target="_blank">{{ $account->branch->name }}</a></td>
                        <td>{{ $account->category->account_category_value }}</td>
                        <td>{{ $account->balance }}</td>
                        <td>{{ $account->date_opened }}</td>
                        <td>
                            <a href="{{ route('customers.accounts.show', [$account->customer_id, $account->account_id]) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('customers.accounts.edit', [$account->customer_id, $account->account_id]) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('customers.accounts.destroy', [$account->customer_id, $account->account_id]) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No accounts found.</p>
        @endif
    </div>
@endsection
