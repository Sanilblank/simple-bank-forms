<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'address' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'numeric', 'digits:10'],
            'email' => ['nullable', 'email', 'max:255'],
            'credit_score' => ['nullable', 'numeric', 'between:0, 10'],
            'employment_details' => ['required', 'array'],
            'identifications.*.identification_type_id' => ['required', 'exists:identification_type_enums,identification_type_id'],
            'identifications.*.identification_number' => ['required', 'string'],
            'identifications.*.issuing_authority' => ['required', 'string'],
            'identifications.*.expiry_date' => ['nullable', 'date'],
        ];
    }
}
