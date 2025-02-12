<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentificationTypeEnum extends Model
{
    protected $table = 'identification_type_enums';

    protected $primaryKey = 'identification_type_id';

    protected $fillable = [
        'identification_type_value',
    ];
}
