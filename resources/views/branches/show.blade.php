@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Branch Details</h2>
        <a href="{{ route('branches.index') }}" class="btn btn-primary mb-3">Branches List</a>

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>{{ $branch->name }}</td>
            </tr>
            <tr>
                <th>Location</th>
                <td>{{ $branch->location }}</td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td>{{ $branch->contact_number }}</td>
            </tr>
        </table>
        <a href="{{ route('branches.edit', $branch->branch_id) }}" class="btn btn-warning">Edit</a>

        <h3 class="mt-5">Employees in this Branch</h3>
        <a href="{{ route('branches.employees.create', $branch->branch_id) }}" class="btn btn-success mb-3">Add Employee</a>

        @if (count($branch->employees))
            <table class="table table-bordered datatable">
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
    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
