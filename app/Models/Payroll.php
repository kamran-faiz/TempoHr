<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'month',
        'year',
        'basic_salary',
        'allowances_total',
        'gross_salary',
        'status',
        'processed_at',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'basic_salary' => 'decimal:2',
        'allowances_total' => 'decimal:2',
        'gross_salary' => 'decimal:2',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeForMonth($query, $month, $year)
    {
        return $query->where('month', $month)->where('year', $year);
    }

    public function scopeProcessed($query)
    {
        return $query->where('status', 'processed');
    }
}