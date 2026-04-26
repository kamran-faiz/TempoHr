<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $fillable = [
        'name',
        'days_per_year',
        'carry_forward',
        'carry_forward_limit',
        'is_encashable',
        'allow_encroachment'
    ];
}
