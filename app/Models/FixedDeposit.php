<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FixedDeposit extends Model
{
    protected $table = 'fixed_deposits';

    protected $primaryKey = 'fixed_deposit_id';

    protected $fillable = [
        'customer_id',
        'account_id',
        'deposit_amount',
        'interest_rate',
        'maturity_date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'account_id');
    }
}
