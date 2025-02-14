@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Loan Applications</h2>

        @if (count($loans))
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Customer Name</th>
                    <th>Type</th>
                    <th>Amount(Rs.)</th>
                    <th>Duration(Months)</th>
                    <th>Status</th>
                    <th>Repayment Schedule</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($loans as $loan)
                    <tr>
                        <td>{{ $loan->loan_id }}</td>
                        <td><a href="{{route('customers.show', $loan->customer->customer_id)}}" target="_blank">{{ $loan->customer->name }}</a></td>
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
