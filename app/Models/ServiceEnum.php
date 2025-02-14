<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceEnum extends Model
{
    protected $table = 'service_enums';

    protected $primaryKey = 'service_id';

    protected $fillable = ['service_name'];
}
