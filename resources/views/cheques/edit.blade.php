@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Edit Cheque for customer: {{ $customer->name }}</h2>
        <form action="{{ route('customers.cheques.update', [$customer->customer_id, $cheque->cheque_id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Account *</label>
                <select name="account_id" class="form-control" required>
                    @foreach ($customer->accounts as $account)
                        <option value="{{ $account->account_id }}" {{ $account->account_id === $cheque->account_id ? 'selected' : '' }}>
                            {{ $account->account_id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Issued Date *</label>
                <input type="date" name="date_issued" class="form-control" value="{{ old('date_issued') ?: $cheque->date_issued }}"
                       required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control" required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ $status === $cheque->status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
