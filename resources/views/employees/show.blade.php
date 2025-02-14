@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Employee Details</h2>
        <a href="{{ route('branches.show', $branch->branch_id) }}" class="btn btn-primary mb-3">Employee Branch Detail</a>

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>{{ $employee->name }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{ $employee->role }}</td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td>{{ $employee->contact_number }}</td>
            </tr>
            <tr>
                <th>Is Branch Manager?</th>
                <td>{{ $employee->is_branch_manager ? 'Yes' : 'No' }}</td>
            </tr>
        </table>
    </div>
@endsection
