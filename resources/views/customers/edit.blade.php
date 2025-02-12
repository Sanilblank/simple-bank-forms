@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Edit Customer</h2>
        <a href="{{ route('customers.index') }}" class="btn btn-primary mb-3">Back to List</a>

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Name *</label>
                <input type="text" name="name" value="{{ old('name') ?: $customer->name}}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Date of Birth *</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') ?: $customer->date_of_birth }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Address *</label>
                <input type="text" name="address" value="{{ old('address') ?: $customer->address }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Contact Number *</label>
                <input type="text" name="contact_number" value="{{ old('contact_number') ?: $customer->contact_number }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') ?: $customer->email }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Credit Score</label>
                <input type="number" name="credit_score" value="{{ old('credit_score') ?: $customer->credit_score }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Employment Details</label>
                <div id="employment-section">
                    @foreach($customer->employment_details as $index => $job)
                        <div class="employment-group mb-3">
                            <input type="text" name="employment_details[{{ $index }}][company_name]" class="form-control mb-2" value="{{ old()['employment_details'][$index]['company_name'] ?? $job['company_name'] }}" placeholder="Company Name">
                            <input type="text" name="employment_details[{{ $index }}][job_title]" class="form-control mb-2" value="{{ old()['employment_details'][$index]['job_title'] ?? $job['job_title'] }}" placeholder="Job Title">
                            <input type="number" name="employment_details[{{ $index }}][years_worked]" class="form-control mb-2" value="{{ old()['employment_details'][$index]['years_worked'] ?? $job['years_worked'] }}" placeholder="Years Worked">
                            <label><input type="checkbox" name="employment_details[{{ $index }}][still_working]" value="1" {{ old()['employment_details'][$index]['still_working'] ?? isset($job['still_working']) ? 'checked' : '' }}> Still Working Here</label>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary" onclick="addEmployment()">+ Add More</button>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>

    <script>
        let employmentIndex = {{ count($customer->employment_details) }};

        function addEmployment() {
            let section = document.getElementById('employment-section');
            let newGroup = document.createElement('div');
            newGroup.classList.add('employment-group', 'mb-3');
            newGroup.innerHTML = `
            <input type="text" name="employment_details[\${employmentIndex}][company_name]" class="form-control mb-2" placeholder="Company Name">
            <input type="text" name="employment_details[\${employmentIndex}][job_title]" class="form-control mb-2" placeholder="Job Title">
            <input type="number" name="employment_details[\${employmentIndex}][years_worked]" class="form-control mb-2" placeholder="Years Worked">
            <label><input type="checkbox" name="employment_details[\${employmentIndex}][still_working]" value="1"> Still Working Here</label>
        `;
            section.appendChild(newGroup);
            employmentIndex++;
        }
    </script>

@endsection
