@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Edit Employee for branch: {{$branch->name}}</h2>
        <form action="{{ route('branches.employees.update', [$branch->branch_id, $employee->employee_id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Employee Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') ?: $employee->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Role *</label>
                <input type="text" name="role" class="form-control" value="{{ old('role') ?: $employee->role }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contact Number *</label>
                <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') ?: $employee->contact_number }}"
                       required>
            </div>
            <div class="mb-3">
                <label class="form-label">Is Branch Manager?</label>
                <select name="is_branch_manager" class="form-control" required>
                    <option value="0" {{ !$employee->is_branch_manager ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $employee->is_branch_manager ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
