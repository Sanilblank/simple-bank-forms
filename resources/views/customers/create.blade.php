@extends('adminlte::page')

@section('content')
    <div class="container">
        @include('layouts.response')
        <h2>Add Customer</h2>
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Name *</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label>Date of Birth *</label>
                <input type="date" name="date_of_birth" class="form-control" required value="{{ old('date_of_birth') }}">
            </div>
            <div class="form-group">
                <label>Address *</label>
                <input type="text" name="address" class="form-control" required value="{{ old('address') }}">
            </div>
            <div class="form-group">
                <label>Contact Number *</label>
                <input type="text" name="contact_number" class="form-control" required value="{{ old('contact_number') }}">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label>Credit Score</label>
                <input type="number" name="credit_score" class="form-control" value="{{ old('credit_score') }}">
            </div>
            <div class="form-group">
                <label>Registered Services</label><br>

                @foreach ($serviceTypes as $type)
                    <label><input type="checkbox" name="registered_services[{{ $type->service_id }}]" value="1"> {{ $type->service_name }}</label>
                @endforeach
            </div>

            <div class="form-group">
                <label>Employment Details</label>
                <div id="employment-section">
                    <div class="employment-group mb-3">
                        <input type="text" name="employment_details[0][company_name]" class="form-control mb-2" placeholder="Company Name">
                        <input type="text" name="employment_details[0][job_title]" class="form-control mb-2" placeholder="Job Title">
                        <input type="number" name="employment_details[0][years_worked]" class="form-control mb-2" placeholder="Years Worked">
                        <label><input type="checkbox" name="employment_details[0][still_working]" value="1"> Still Working Here</label>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" onclick="addEmployment()">+ Add More Employment Details</button>
            </div>

            <div class="form-group">
                <label>Identification Details</label>
                <div id="identification-section">
                    <div class="identification-group mb-3">
                        <select name="identifications[0][identification_type_id]" class="form-control mb-2">
                            @foreach($identificationTypes as $type)
                                <option value="{{ $type->identification_type_id }}">{{ $type->identification_type_value }}</option>
                            @endforeach
                        </select>

                        <input type="text" name="identifications[0][identification_number]" placeholder="ID Number *" class="form-control mb-2">
                        <input type="text" name="identifications[0][issuing_authority]" placeholder="Issuing Authority *" class="form-control mb-2">
                        <input type="date" name="identifications[0][expiry_date]" class="form-control mb-2">
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" onclick="addIdentification()">+ Add More Identifications</button>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>

    <script>
        let employmentIndex = 1;

        function addEmployment() {
            let section = document.getElementById('employment-section');
            let newGroup = document.createElement('div');
            newGroup.classList.add('employment-group', 'mb-3');
            newGroup.innerHTML = `
            <input type="text" name="employment_details[\${employmentIndex}][company_name]" class="form-control mb-2" placeholder="Company Name" required>
            <input type="text" name="employment_details[\${employmentIndex}][job_title]" class="form-control mb-2" placeholder="Job Title" required>
            <input type="number" name="employment_details[\${employmentIndex}][years_worked]" class="form-control mb-2" placeholder="Years Worked" required>
            <label><input type="checkbox" name="employment_details[\${employmentIndex}][still_working]" value="1"> Still Working Here</label>
        `;
            section.appendChild(newGroup);
            employmentIndex++;
        }

        let identificationIndex = 1;

        function addIdentification() {
            let section = document.getElementById('identification-section');
            let newGroup = document.createElement('div');
            newGroup.classList.add('identification-group', 'mb-3');
            newGroup.innerHTML = `
                <select name="identifications[${identificationIndex}][identification_type_id]" class="form-control mb-2">
                    @foreach($identificationTypes as $type)
                        <option value="{{ $type->identification_type_id }}">{{ $type->identification_type_value }}</option>
                    @endforeach
                        </select>
                        <input type="text" name="identifications[${identificationIndex}][identification_number]" placeholder="ID Number *" class="form-control mb-2">
                <input type="text" name="identifications[${identificationIndex}][issuing_authority]" placeholder="Issuing Authority *" class="form-control mb-2">
                <input type="date" name="identifications[${identificationIndex}][expiry_date]" class="form-control mb-2">
                `;
            section.appendChild(newGroup);
            identificationIndex++;
        }
    </script>

@endsection
