<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'account_category_id';

    protected $fillable = [
        'account_type_id',
        'account_category_value',
        'interest_rate',
        'withdrawal_limit',
    ];

    public function accountType(): void
    {
        $this->belongsTo(AccountTypeEnum::class, 'account_type_id', 'account_type_id');
    }
}
