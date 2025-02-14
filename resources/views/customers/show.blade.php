@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Customer Details</h2>
        <a href="{{ route('customers.index') }}" class="btn btn-primary mb-3">Customers List</a>

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
            <tr>
                <th>Identification Details</th>
                <td>
                    @foreach($customer->identifications as $identification)
                        <strong>{{ $identification->identificationType->identification_type_value }}</strong> - {{ $identification['identification_number'] . ' issued by ' . $identification['issuing_authority'] }} {{ $identification['expiry_date'] ? ' expires on ' . $identification['expiry_date'] : '' }}
                        <br>
                    @endforeach
                </td>
            </tr>
        </table>
        <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-warning">Edit</a>

        <h3 class="mt-5">Customer Accounts</h3>
        <a href="{{ route('customers.accounts.create', $customer->customer_id) }}" class="btn btn-success mb-3">Add Account</a>

        @if (count($customer->accounts))
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Account ID</th>
                    <th>Branch Name</th>
                    <th>Account Category</th>
                    <th>Balance(Rs.)</th>
                    <th>Date Opened</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($customer->accounts as $account)
                    <tr>
                        <td>{{ $account->account_id }}</td>
                        <td>{{ $account->branch->name }}</td>
                        <td>{{ $account->category->account_category_value }}</td>
                        <td>{{ $account->balance }}</td>
                        <td>{{ $account->date_opened }}</td>
                        <td>
                            <a href="{{ route('customers.accounts.show', [$customer->customer_id, $account->account_id]) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('customers.accounts.edit', [$customer->customer_id, $account->account_id]) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('customers.accounts.destroy', [$customer->customer_id, $account->account_id]) }}" method="POST"
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
            <p>No accounts for this customer.</p>
        @endif

        <h3 class="mt-5">Loan Applications</h3>

        @if (count($customer->loans))
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Type</th>
                    <th>Amount(Rs.)</th>
                    <th>Duration(Months)</th>
                    <th>Status</th>
                    <th>Repayment Schedule</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customer->loans as $loan)
                    <tr>
                        <td>{{ $loan->loan_id }}</td>
                        <td>{{ $loan->loanType->loan_type_value }}</td>
                        <td>{{ $loan->amount }}</td>
                        <td>{{ $loan->duration }}</td>
                        <td>
                            @switch($loan->approval_status)
                                @case('Pending')
                                    <span class="badge badge-warning">Pending</span>
                                    @break
                                @case('Approved')
                                    <span class="badge badge-success">Approved</span>
                                    @break
                                @case('Rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                    @break
                            @endswitch
                        </td>
                        <td>{{ $loan->repayment_schedule }}</td>
                        <td>
                            @if ($loan->approval_status === 'Pending')
                                <a href="{{ route('loans.update-status', [$loan->loan_id, 'Approved']) }}" class="btn btn-success">Approve</a>
                                <a href="{{ route('loans.update-status', [$loan->loan_id, 'Rejected']) }}" class="btn btn-danger">Reject</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No loans found.</p>
        @endif
    </div>
@endsection
