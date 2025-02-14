<?php

namespace App\Http\Requests;

use App\Models\AtmCard;
use Illuminate\Foundation\Http\FormRequest;

class AtmCardRequest extends FormRequest
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
            'account_id' => ['required', 'exists:accounts,account_id', function ($attribute, $value, $fail) {
                if ($this->atm_card) {
                    if ($this->customer->atmCards()->where('account_id', $value)->where('card_id', '!=', $this->atm_card->card_id)->exists()) {
                        $fail('Atm card already exists for this account.');
                    }
                } elseif ($this->customer->atmCards()->where('account_id', $value)->exists()) {
                    $fail('Atm card already exists for this account.');
                }
            }],
            'card_number' => ['required', function ($attribute, $value, $fail) {
                if ($this->atm_card) {
                    if (AtmCard::where('card_number', $value)->where('card_id', '!=', $this->atm_card->card_id)->exists()) {
                        $fail('Atm card number already exists.');
                    }
                } elseif (AtmCard::where('card_number', $value)->exists()) {
                    $fail('Atm card number already exists.');
                }
            }],
            'expiry_date' => ['required', 'date', 'after_or_equal:today'],
        ];
    }
}
