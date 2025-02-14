@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Issue Cheque for customer: {{ $customer->name }}</h2>
        <form action="{{ route('customers.cheques.store', $customer->customer_id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Account *</label>
                <select name="account_id" class="form-control" required>
                    @foreach ($customer->accounts as $account)
                        <option value="{{ $account->account_id }}">
                            {{ $account->account_id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Issued Date *</label>
                <input type="date" name="date_issued" class="form-control" value="{{ old('date_issued') }}"
                       required>
            </div>
            <input type="hidden" name="status" value="Active">
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
