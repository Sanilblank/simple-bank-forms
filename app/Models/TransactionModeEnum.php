<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionModeEnum extends Model
{
    protected $table = 'transaction_mode_enums';

    protected $primaryKey = 'transaction_mode_id';

    protected $fillable = [
        'transaction_mode_value',
    ];
}
