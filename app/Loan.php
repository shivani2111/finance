<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'loan_type',
        'life',
        'annual_rate',
        'rate',
        'status'
    ];
}
