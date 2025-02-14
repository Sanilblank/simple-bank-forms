<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AtmCard extends Model
{
    protected $table = 'atm_cards';

    protected $primaryKey = 'card_id';

    protected $fillable = [
        'customer_id',
        'account_id',
        'card_number',
        'expiry_date',
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
