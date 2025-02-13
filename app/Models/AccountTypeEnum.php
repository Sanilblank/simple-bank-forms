<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountTypeEnum extends Model
{
    use HasFactory;

    protected $table = 'account_type_enums';

    protected $primaryKey = 'account_type_id';

    protected $fillable = [
        'account_type_value',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(AccountCategory::class, 'account_type_id', 'account_type_id');
    }
}
