<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionTypeEnum extends Model
{
    protected $table = 'transaction_type_enums';

    protected $primaryKey = 'transaction_type_id';

    protected $fillable = [
        'transaction_type_value',
    ];
}
