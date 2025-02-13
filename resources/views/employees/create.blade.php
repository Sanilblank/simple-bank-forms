@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Add Employee for branch: {{ $branch->name }}</h2>
        <form action="{{ route('branches.employees.store', $branch->branch_id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Employee Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Role *</label>
                <input type="text" name="role" class="form-control" value="{{ old('role') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contact Number *</label>
                <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Is Branch Manager? *</label>
                <select name="is_branch_manager" class="form-control" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
