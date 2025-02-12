@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Customers List</h2>
        <a href="{{ route('customers.create') }}" class="btn btn-success mb-3">Add New Customer</a>

        <table class="table table-bordered">
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

                        <form action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(event) {
            event.preventDefault();

            if (confirm("Are you sure you want to delete this customer?")) {
                event.target.submit();
            }
        }
    </script>
@endsection
