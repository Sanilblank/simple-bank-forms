@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Employee Details</h2>
        <p><strong>Name:</strong> {{ $employee->name }}</p>
        <p><strong>Role:</strong> {{ $employee->role }}</p>
        <p><strong>Contact Number:</strong> {{ $employee->contact_number }}</p>
        <p><strong>Branch:</strong> {{ $branch->name }}</p>
        <p><strong>Is Branch Manager?</strong> {{ $employee->is_branch_manager ? 'Yes' : 'No' }}</p>

        <a href="{{ route('branches.show', $branch->branch_id) }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
