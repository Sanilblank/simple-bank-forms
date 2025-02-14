<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $table = 'loans';

    protected $primaryKey = 'loan_id';

    protected $fillable = [
        'customer_id',
        'loan_type_id',
        'amount',
        'interest_rate',
        'duration',
        'approval_status',
        'repayment_schedule',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function loanType(): BelongsTo
    {
        return $this->belongsTo(LoanTypeEnum::class, 'loan_type_id', 'loan_type_id');
    }
}
