@extends('adminlte::page')

@section('content')
    <div class="container">
        <h2>Customer Details</h2>
        <a href="{{ route('customers.index') }}" class="btn btn-primary mb-3">Back to List</a>

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>{{ $customer->name }}</td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>{{ $customer->date_of_birth }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $customer->address }}</td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td>{{ $customer->contact_number }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $customer->email ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Credit Score</th>
                <td>{{ $customer->credit_score }}</td>
            </tr>
            <tr>
                <th>Employment Details</th>
                <td>
                    @foreach($customer->employment_details as $job)
                        <strong>{{ $job['company_name'] }}</strong> - {{ $job['job_title'] }}
                        ({{ $job['years_worked'] }} years)
                        @if(isset($job['still_working']))
                            <span class="badge bg-success">Still Working</span>
                        @endif
                        <br>
                    @endforeach
                </td>
            </tr>
        </table>

        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
    </div>
@endsection
