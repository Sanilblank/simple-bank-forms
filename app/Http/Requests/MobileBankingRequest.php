<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MobileBankingRequest extends FormRequest
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
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'registered_number' => ['required', 'numeric', 'digits:10'],
            'status' => ['required', 'in:Active,Inactive'],
        ];
    }
}
