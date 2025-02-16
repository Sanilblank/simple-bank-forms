@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Customers List</h2>
        <a href="{{ route('customers.create') }}" class="btn btn-success mb-3">Add New Customer</a>

        @if (count($customers))
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->customer_id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->contact_number }}</td>
                        <td>{{ $customer->email ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('customers.show', $customer->customer_id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No customers found.</p>
        @endif
    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
