<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAllowance extends Model
{
    protected $fillable = [
       'employee_salary_id',
       'allowance_type_id',
       'value'



    ];

    public function employeeSalary(){
       return $this->belongsTo(EmployeeSalary::class);

    }
    public function allowanceType(){
       return $this->belongsTo(AllowanceType::class);
    }
}
