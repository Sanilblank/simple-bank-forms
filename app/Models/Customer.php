<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class, 'customer_id', 'customer_id');
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'customer_id', 'customer_id');
    }

    public function fixedDeposits(): HasMany
    {
        return $this->hasMany(FixedDeposit::class, 'customer_id', 'customer_id');
    }

    public function cheques(): HasMany
    {
        return $this->hasMany(Cheque::class, 'customer_id', 'customer_id');
    }

    public function atmCards(): HasMany
    {
        return $this->hasMany(AtmCard::class, 'customer_id', 'customer_id');
    }

    public function mobileBanking(): HasOne
    {
        return $this->hasOne(MobileBanking::class, 'customer_id', 'customer_id');
    }
}
