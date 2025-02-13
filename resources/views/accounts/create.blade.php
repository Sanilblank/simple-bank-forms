@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Add Account for customer: {{ $customer->name }}</h2>
        <form action="{{ route('customers.accounts.store', $customer->customer_id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Account Number *</label>
                <input type="number" name="account_id" class="form-control" value="{{ random_int(100000000000, 999999999999) }}"
                       required readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Branch *</label>
                <select name="branch_id" class="form-control" required>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->branch_id }}">
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Account Category *</label>
                <select name="account_category_id" class="form-control" required>
                    @foreach ($accountCategories as $accountCategory)
                        <option value="{{ $accountCategory->account_category_id }}">
                            {{ $accountCategory->account_category_value }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Balance *</label>
                <input type="text" name="balance" class="form-control" value="{{ old('balance') }}" required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
