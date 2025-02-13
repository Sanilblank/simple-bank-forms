@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Branch Details</h2>
        <p><strong>Name:</strong> {{ $branch->name }}</p>
        <p><strong>Location:</strong> {{ $branch->location }}</p>
        <p><strong>Contact Number:</strong> {{ $branch->contact_number }}</p>

        <h3>Employees in this Branch</h3>
        <a href="{{ route('branches.employees.create', $branch->branch_id) }}" class="btn btn-success mb-3">Add Employee</a>

        @if (count($branch->employees))
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Contact Number</th>
                    <th>Branch Manager</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($branch->employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->role }}</td>
                        <td>{{ $employee->contact_number }}</td>
                        <td>{{ $employee->is_branch_manager ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('branches.employees.show', [$branch->branch_id, $employee->employee_id]) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('branches.employees.edit', [$branch->branch_id, $employee->employee_id]) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('branches.employees.destroy', [$branch->branch_id, $employee->employee_id]) }}" method="POST"
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
            <p>No employees in this branch.</p>
        @endif

        <a href="{{ route('branches.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
