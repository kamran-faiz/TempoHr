<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    protected $fillable = [
        'employee_id',
        'basic_salary',
        'effective_date',
    ];

    public function employee(){
       return $this->belongsTo(Employee::class);
    }
   
    public function allowance(){
       return $this->hasMany(EmployeeAllowance::class);
    }

}
