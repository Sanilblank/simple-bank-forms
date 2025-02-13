<?php

namespace App\Http\Requests;

use App\Models\AccountCategory;
use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'account_id' => ['required', 'numeric', 'between:100000000000, 999999999999'],
            'branch_id' => ['required', 'exists:branches,branch_id'],
            'account_category_id' => ['required', 'exists:account_categories,account_category_id'],
            'balance' => ['required', 'numeric', function ($attribute, $value, $fail) {
                if (! $this->account_category_id) {
                    return;
                }

                $minimumBalance = AccountCategory::find($this->account_category_id)->minimum_balance;

                if ($value < $minimumBalance) {
                    $fail('The balance must be at least '.$minimumBalance);
                }
            }],
        ];
    }
}
