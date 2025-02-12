<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable
        = [
            'name',
            'date_of_birth',
            'address',
            'contact_number',
            'email',
            'employment_details',
            'credit_score'
        ];

    protected $casts
        = [
            'employment_details' => 'json'
        ];
}
