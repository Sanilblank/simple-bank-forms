@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Edit ATM Card for customer: {{ $customer->name }}</h2>
        <form action="{{ route('customers.atm-cards.update', [$customer->customer_id, $atmCard->card_id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Account *</label>
                <select name="account_id" class="form-control" required>
                    @foreach ($customer->accounts as $account)
                        <option value="{{ $account->account_id }}" {{ $account->account_id === $atmCard->account_id ? 'selected' : '' }}>
                            {{ $account->account_id }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Card Number *</label>
                <input type="number" name="card_number" class="form-control" value="{{ $atmCard->card_number }}"
                       required readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Expiry Date *</label>
                <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date')?: $atmCard->expiry_date }}"
                       required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
