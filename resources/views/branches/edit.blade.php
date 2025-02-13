@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Edit Branch</h2>
        <form action="{{ route('branches.update', $branch->branch_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Branch Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') ?: $branch->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Location *</label>
                <input type="text" name="location" class="form-control" value="{{ old('location') ?: $branch->location }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contact Number *</label>
                <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') ?: $branch->contact_number }}"
                       required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
