<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChequeRequest extends FormRequest
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
            'account_id' => ['required', 'exists:accounts,account_id'],
            'date_issued' => ['required', 'date', 'before_or_equal:today'],
            'status' => ['required', 'in:Active,Finished,Cancelled'],
        ];
    }
}
