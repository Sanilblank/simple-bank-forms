<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanTypeEnum extends Model
{
    protected $table = 'loan_type_enums';

    protected $primaryKey = 'loan_type_id';

    protected $fillable = [
        'loan_type_value',
    ];
}
