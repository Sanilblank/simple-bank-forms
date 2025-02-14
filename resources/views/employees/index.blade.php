@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')

        <h3>Employees List</h3>

        @if (count($employees))
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
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td><a href="{{ route('branches.show', $employee->branch_id) }}" target="_blank">{{ $employee->branch->name }}</a></td>
                        <td>{{ $employee->role }}</td>
                        <td>{{ $employee->contact_number }}</td>
                        <td>{{ $employee->is_branch_manager ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('branches.employees.show', [$employee->branch_id, $employee->employee_id]) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('branches.employees.edit', [$employee->branch_id, $employee->employee_id]) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('branches.employees.destroy', [$employee->branch_id, $employee->employee_id]) }}" method="POST"
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
            <p>No employees found.</p>
        @endif
    </div>
@endsection
