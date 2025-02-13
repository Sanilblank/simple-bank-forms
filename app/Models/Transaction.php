<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'account_id',
        'transaction_type_id',
        'transaction_mode_id',
        'amount',
        'date',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'account_id');
    }

    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionTypeEnum::class, 'transaction_type_id', 'transaction_type_id');
    }

    public function transactionMode(): BelongsTo
    {
        return $this->belongsTo(TransactionModeEnum::class, 'transaction_mode_id', 'transaction_mode_id');
    }
}
