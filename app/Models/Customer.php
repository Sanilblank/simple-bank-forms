<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $table = 'customers';

    protected $primaryKey = 'customer_id';

    protected $fillable
        = [
            'name',
            'date_of_birth',
            'address',
            'contact_number',
            'email',
            'employment_details',
            'credit_score',
        ];

    protected $casts
        = [
            'employment_details' => 'json',
        ];

    public function identifications(): HasMany
    {
        return $this->hasMany(CustomerIdentification::class, 'customer_id', 'customer_id');
    }
}
