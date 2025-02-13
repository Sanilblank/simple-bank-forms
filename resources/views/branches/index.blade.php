@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Branches</h2>
        <a href="{{ route('branches.create') }}" class="btn btn-success">Add New Branch</a>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Contact Number</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($branches as $branch)
                <tr>
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->location }}</td>
                    <td>{{ $branch->contact_number }}</td>
                    <td>
                        <a href="{{ route('branches.show', $branch->branch_id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('branches.edit', $branch->branch_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('branches.destroy', $branch->branch_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
