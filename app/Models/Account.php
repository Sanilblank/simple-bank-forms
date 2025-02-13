<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    protected $table = 'accounts';

    protected $primaryKey = 'account_id';

    public $incrementing = false;

    protected $fillable = [
        'account_id',
        'customer_id',
        'branch_id',
        'account_category_id',
        'balance',
        'date_opened',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(AccountCategory::class, 'account_category_id', 'account_category_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
