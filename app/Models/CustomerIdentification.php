<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerIdentification extends Model
{
    protected $table = 'customer_identifications';

    protected $primaryKey = 'customer_identification_id';

    protected $fillable = [
        'customer_id',
        'identification_type_id',
        'identification_number',
        'issuing_authority',
        'expiry_date',
    ];

    public function identificationType(): BelongsTo
    {
        return $this->belongsTo(IdentificationTypeEnum::class, 'identification_type_id', 'identification_type_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
