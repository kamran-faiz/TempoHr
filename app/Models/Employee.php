<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'employee_code',
        'first_name',
        'last_name',
        'email',
        'phone',
        'cnic',
        'date_of_birth',
        'gender',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'profile_image',
        'designation_id',
        'department_id',
        'employee_type',
        'joining_date',
        'reporting_manager_id',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function manager()
   {
    return $this->belongsTo(Employee::class, 'reporting_manager_id');
   
 }

 public function subordanarates()
 {
    return $this->hasMany(Employee::class, 'reporting_manager_id');
 }
}
