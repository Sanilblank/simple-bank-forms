@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Create Mobile Banking for customer: {{ $customer->name }}</h2>
        <form action="{{ route('customers.mobile-banking.store', $customer->customer_id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Registered Number *</label>
                <input type="number" name="registered_number" class="form-control" value="{{ @old('registered_number') ?: $customer->contact_number }}"
                       required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control" required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}">
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
