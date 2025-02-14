<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MobileBanking extends Model
{
    protected $table = 'mobile_bankings';

    protected $primaryKey = 'mobile_banking_id';

    protected $fillable = [
        'customer_id',
        'registered_number',
        'status',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
