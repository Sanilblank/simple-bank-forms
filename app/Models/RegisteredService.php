<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegisteredService extends Model
{
    protected $table = 'registered_services';

    protected $primaryKey = 'registered_service_id';

    protected $fillable = [
        'customer_id',
        'service_id',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(ServiceEnum::class, 'service_id', 'service_id');
    }
}
