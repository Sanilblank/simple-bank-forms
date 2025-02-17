@extends('adminlte::page')

@section('title', 'Branch Performance Dashboard')

@section('content')
    @include('layouts.response')

    <div class="container">
        <h2 class="mb-4 text-center">Performance Dashboard</h2>

        <div class="row">
            <!-- Active Accounts per Branch -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">Active Accounts per Branch</div>
                    <div class="card-body">
                        <canvas id="activeAccountsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Loan Approval Rate -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">Loan Approval Rate</div>
                    <div class="card-body">
                        <canvas id="loanApprovalChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Transaction Type -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-info text-white">Transaction Types</div>
                    <div class="card-body">
                        <canvas id="transactionTypeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Transaction Modes -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-secondary text-white">Transaction Modes</div>
                    <div class="card-body">
                        <canvas id="transactionModeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Active Customers per Branch (Bar Chart)
        const activeAccountsData = {
            labels: {!! json_encode(array_keys($activeAccountsPerBranch->toArray()), JSON_THROW_ON_ERROR) !!},
            datasets: [{
                label: "Active Accounts",
                data: {!! json_encode(array_values($activeAccountsPerBranch->toArray()), JSON_THROW_ON_ERROR) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        };

        new Chart(document.getElementById("activeAccountsChart"), {
            type: "bar",
            data: activeAccountsData,
            options: {responsive: true, scales: {y: {beginAtZero: true}}}
        });

        // Loan Approval Rate by Branch (Stacked Bar Chart)
        const loanApprovalData = {
            labels: {!! json_encode(array_keys($totalLoans), JSON_THROW_ON_ERROR) !!},
            datasets: [
                {label: "Pending", data: {{ json_encode($pendingPercentage) }}, backgroundColor: "#FFC107"},
                {label: "Approved", data: {{ json_encode($approvedPercentage) }}, backgroundColor: "#4CAF50"},
                {label: "Rejected", data: {{ json_encode($rejectedPercentage) }}, backgroundColor: "#E91E63"}
            ]
        };

        new Chart(document.getElementById("loanApprovalChart"), {
            type: "bar",
            data: loanApprovalData,
            options: {responsive: true, scales: {x: {stacked: true}, y: {stacked: true, beginAtZero: true}}}
        });

        // Pie Chart for Transaction Types
        let transactionTypeChart = new Chart(document.getElementById('transactionTypeChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($transactionTypeArray)) !!}, // Labels: Deposit, Withdrawal, Transfer
                datasets: [{
                    label: 'Transactions',
                    data: {!! json_encode(array_values($transactionTypeArray)) !!}, // Values: [2, 2, 2]
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',   // Red
                        'rgba(54, 162, 235, 0.6)',  // Blue
                        'rgba(255, 206, 86, 0.6)'   // Yellow
                    ]
                }]
            }
        });

        // Pie Chart for Transaction Modes
        let transactionModeChart = new Chart(document.getElementById('transactionModeChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($transactionModeArray)) !!}, // Labels: Deposit, Withdrawal, Transfer
                datasets: [{
                    label: 'Transactions',
                    data: {!! json_encode(array_values($transactionModeArray)) !!}, // Values: [2, 2, 2]
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',   // Red
                        'rgba(54, 162, 235, 0.6)',  // Blue
                        'rgba(255, 206, 86, 0.6)',   // Yellow
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(128, 128, 128, 0.6)'
                    ]
                }]
            }
        });
    </script>
@endsection
