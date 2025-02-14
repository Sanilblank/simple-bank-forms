@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Update Mobile Banking for customer: {{ $customer->name }}</h2>
        <form action="{{ route('customers.mobile-banking.update', [$customer->customer_id, $mobileBanking->mobile_banking_id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Registered Number *</label>
                <input type="number" name="registered_number" class="form-control" value="{{ @old('registered_number') ?: $mobileBanking->registered_number }}"
                       required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control" required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ $status === $mobileBanking->status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
