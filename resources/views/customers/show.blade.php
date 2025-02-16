@php use App\Models\ServiceEnum; @endphp
@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Customer Details</h2>
        <a href="{{ route('customers.index') }}" class="btn btn-primary mb-3">Customers List</a>

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>{{ $customer->name }}</td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>{{ $customer->date_of_birth }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $customer->address }}</td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td>{{ $customer->contact_number }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $customer->email ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Credit Score</th>
                <td>{{ $customer->credit_score }}</td>
            </tr>
            <tr>
                <th>Employment Details</th>
                <td>
                    @foreach($customer->employment_details as $job)
                        <strong>{{ $job['company_name'] }}</strong> - {{ $job['job_title'] }}
                        ({{ $job['years_worked'] }} years)
                        @if(isset($job['still_working']))
                            <span class="badge bg-success">Still Working</span>
                        @endif
                        <br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>Identification Details</th>
                <td>
                    @foreach($customer->identifications as $identification)
                        <strong>{{ $identification->identificationType->identification_type_value }}</strong>
                        - {{ $identification['identification_number'] . ' issued by ' . $identification['issuing_authority'] }} {{ $identification['expiry_date'] ? ' expires on ' . $identification['expiry_date'] : '' }}
                        <br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>Registered Services</th>
                <td>
                    @if (count($customer->registeredServices))
                        @foreach($customer->registeredServices as $service)
                            <strong>{{ $service->service->service_name }}</strong>
                            <br>
                        @endforeach
                    @else
                        N/A
                    @endif
                </td>
            </tr>
        </table>
        <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-warning">Edit</a>

        <h3 class="mt-5">Customer Accounts</h3>
        <a href="{{ route('customers.accounts.create', $customer->customer_id) }}" class="btn btn-success mb-3">Add
            Account</a>

        @if (count($customer->accounts))
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th>Account ID</th>
                    <th>Branch Name</th>
                    <th>Account Category</th>
                    <th>Balance(Rs.)</th>
                    <th>Date Opened</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($customer->accounts as $account)
                    <tr>
                        <td>{{ $account->account_id }}</td>
                        <td>{{ $account->branch->name }}</td>
                        <td>{{ $account->category->account_category_value }}</td>
                        <td>{{ $account->balance }}</td>
                        <td>{{ $account->date_opened }}</td>
                        <td>
                            <a href="{{ route('customers.accounts.show', [$customer->customer_id, $account->account_id]) }}"
                               class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('customers.accounts.edit', [$customer->customer_id, $account->account_id]) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                            <form
                                action="{{ route('customers.accounts.destroy', [$customer->customer_id, $account->account_id]) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No accounts for this customer.</p>
        @endif

        <h3 class="mt-5">Loan Applications</h3>

        @if (count($customer->loans))
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Type</th>
                    <th>Amount(Rs.)</th>
                    <th>Duration(Months)</th>
                    <th>Status</th>
                    <th>Repayment Schedule</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customer->loans as $loan)
                    <tr>
                        <td>{{ $loan->loan_id }}</td>
                        <td>{{ $loan->loanType->loan_type_value }}</td>
                        <td>{{ $loan->amount }}</td>
                        <td>{{ $loan->duration }}</td>
                        <td>
                            @switch($loan->approval_status)
                                @case('Pending')
                                    <span class="badge badge-warning">Pending</span>
                                    @break
                                @case('Approved')
                                    <span class="badge badge-success">Approved</span>
                                    @break
                                @case('Rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                    @break
                            @endswitch
                        </td>
                        <td>{{ $loan->repayment_schedule }}</td>
                        <td>
                            @if ($loan->approval_status === 'Pending')
                                <a href="{{ route('loans.update-status', [$loan->loan_id, 'Approved']) }}"
                                   class="btn btn-success">Approve</a>
                                <a href="{{ route('loans.update-status', [$loan->loan_id, 'Rejected']) }}"
                                   class="btn btn-danger">Reject</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No loans found.</p>
        @endif

        <h2 class="mt-5">Fixed Deposits</h2>

        @if (count($customer->fixedDeposits))
            <table class="table table-bordered datatable">
                <thead>
                <tr>
                    <th>Fixed Deposit ID</th>
                    <th>Account ID</th>
                    <th>Deposit Amount(Rs.)</th>
                    <th>Interest Rate(%)</th>
                    <th>Created At</th>
                    <th>Maturity Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customer->fixedDeposits as $fixedDeposit)
                    <tr>
                        <td>{{ $fixedDeposit->fixed_deposit_id }}</td>
                        <td>
                            <a href="{{route('customers.accounts.show', [$fixedDeposit->customer_id, $fixedDeposit->account_id])}}"
                               target="_blank">{{ $fixedDeposit->account_id }}</a></td>
                        <td>{{ $fixedDeposit->deposit_amount }}</td>
                        <td>{{ $fixedDeposit->interest_rate }}</td>
                        <td>{{ $fixedDeposit->created_at->format('Y-m-d') }}</td>
                        <td>{{ $fixedDeposit->maturity_date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No fixed deposits found.</p>
        @endif

        <h2 class="mt-5">ATM Cards Issued</h2>
        @if (count($customer->registeredServices) && $customer->registeredServices()->where('service_id', ServiceEnum::where('service_name', 'ATM Card')->first()->service_id)->exists())
            <a href="{{ route('customers.atm-cards.create', $customer->customer_id) }}" class="btn btn-success mb-3">Add
                ATM
                Card</a>

            @if (count($customer->atmCards))
                <table class="table table-bordered datatable">
                    <thead>
                    <tr>
                        <th>Card ID</th>
                        <th>Account ID</th>
                        <th>Card Number</th>
                        <th>Expiry Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customer->atmCards as $atmCard)
                        <tr>
                            <td>{{ $atmCard->card_id }}</td>
                            <td>
                                <a href="{{route('customers.accounts.show', [$atmCard->customer_id, $atmCard->account_id])}}"
                                   target="_blank">{{ $atmCard->account_id }}</a></td>
                            <td>{{ $atmCard->card_number }}</td>
                            <td>{{ $atmCard->expiry_date }}</td>
                            <td>
                                <a href="{{ route('customers.atm-cards.edit', [$atmCard->customer_id, $atmCard->card_id]) }}"
                                   class="btn btn-warning btn-sm">Edit</a>
                                <form
                                    action="{{ route('customers.atm-cards.destroy', [$atmCard->customer_id, $atmCard->card_id]) }}"
                                    method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No ATM cards found.</p>
            @endif
        @else
            <p>No ATM card service found.</p>
        @endif

        <h2 class="mt-5">Cheques Issued</h2>
        @if (count($customer->registeredServices) && $customer->registeredServices()->where('service_id', ServiceEnum::where('service_name', 'Cheque')->first()->service_id)->exists())
            <a href="{{ route('customers.cheques.create', $customer->customer_id) }}" class="btn btn-success mb-3">Add
                Cheque</a>

            @if (count($customer->cheques))
                <table class="table table-bordered datatable">
                    <thead>
                    <tr>
                        <th>Cheque ID</th>
                        <th>Account ID</th>
                        <th>Date Issued</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customer->cheques as $cheque)
                        <tr>
                            <td>{{ $cheque->cheque_id }}</td>
                            <td>
                                <a href="{{route('customers.accounts.show', [$cheque->customer_id, $cheque->account_id])}}"
                                   target="_blank">{{ $cheque->account_id }}</a></td>
                            <td>{{ $cheque->date_issued }}</td>
                            <td>
                                @switch($cheque->status)
                                    @case('Active')
                                        <span class="badge badge-success">Active</span>
                                        @break
                                    @case('Finished')
                                        <span class="badge badge-warning">Finished</span>
                                        @break
                                    @case('Cancelled')
                                        <span class="badge badge-danger">Cancelled</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <a href="{{ route('customers.cheques.edit', [$cheque->customer_id, $cheque->cheque_id]) }}"
                                   class="btn btn-warning btn-sm">Edit</a>
                                <form
                                    action="{{ route('customers.cheques.destroy', [$cheque->customer_id, $cheque->cheque_id]) }}"
                                    method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No cheques found.</p>
            @endif
        @else
            <p>No cheque service found.</p>
        @endif

        <h2 class="mt-5">Mobile Banking</h2>
        @if (count($customer->registeredServices) && $customer->registeredServices()->where('service_id', ServiceEnum::where('service_name', 'Mobile Banking')->first()->service_id)->exists())
            @if ($customer->mobileBanking)
                <table class="table table-bordered datatable">
                    <thead>
                    <tr>
                        <th>Mobile Banking ID</th>
                        <th>Registered Number</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $customer->mobileBanking->mobile_banking_id }}</td>
                        <td>{{ $customer->mobileBanking->registered_number }}</td>
                        <td>
                            @switch($customer->mobileBanking->status)
                                @case('Active')
                                    <span class="badge badge-success">Active</span>
                                    @break
                                @case('Inactive')
                                    <span class="badge badge-danger">Inactive</span>
                                    @break
                            @endswitch
                        </td>
                        <td>
                            <a href="{{ route('customers.mobile-banking.edit', [$customer->mobileBanking->customer_id, $customer->mobileBanking->mobile_banking_id]) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                            <form
                                action="{{ route('customers.mobile-banking.destroy', [$customer->mobileBanking->customer_id, $customer->mobileBanking->mobile_banking_id]) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            @else
                <a href="{{ route('customers.mobile-banking.create', $customer->customer_id) }}"
                   class="btn btn-success mb-3">Add Mobile Banking</a>
                <p>No mobile banking found.</p>
            @endif
        @else
            <p>No mobile banking service found.</p>
        @endif
    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
