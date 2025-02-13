@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Edit Account for customer: {{ $customer->name }}</h2>
        <form action="{{ route('customers.accounts.update', [$customer->customer_id, $account->account_id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Account Number *</label>
                <input type="number" name="account_id" class="form-control" value="{{ $account->account_id }}"
                       required readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Branch *</label>
                <select name="branch_id" class="form-control" required>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->branch_id }}" {{ $branch->branch_id === $account->branch_id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Account Category *</label>
                <select name="account_category_id" class="form-control" required>
                    @foreach ($accountCategories as $accountCategory)
                        <option value="{{ $accountCategory->account_category_id }}" {{ $accountCategory->account_category_id === $account->account_category_id ? 'selected' : '' }}>
                            {{ $accountCategory->account_category_value }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Balance *</label>
                <input type="text" name="balance" class="form-control" value="{{ old('balance') ?: $account->balance }}" required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
