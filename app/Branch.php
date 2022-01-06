<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'branch_name',
        'branch_code',
        'state_id',
        'city_id',
        'branch_address',
        'branch_postal_code',
        'status'
    ];
}
