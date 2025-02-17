<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $table = 'branches';

    protected $primaryKey = 'branch_id';

    protected $fillable = [
        'name',
        'location',
        'contact_number',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'branch_id', 'branch_id');
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class, 'branch_id', 'branch_id');
    }
}
