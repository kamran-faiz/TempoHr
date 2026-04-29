<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\LeaveBalance;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeService
{
    public function createEmployee(array $data): Employee
    {
        $profileImagePath = null;
if (isset($data['profile_image']) && $data['profile_image']) {
    $profileImagePath = $data['profile_image']->store('profile-images', 'public');
}
        $user = User::create([
    'name' => $data['first_name'] . ' ' . $data['last_name'],
    'email' => $data['email'],
    'password' => Hash::make('password123'),
]);
$employee = Employee::create([
    'user_id' => $user->id,
    'profile_image' => $profileImagePath,
    'employee_code' => $data['employee_code'],
    'first_name' => $data['first_name'],
    'last_name' => $data['last_name'],
    'email' => $data['email'],
    'phone' => $data['phone'] ?? null,
    'cnic' => $data['cnic'] ?? null,
    'date_of_birth' => $data['date_of_birth'] ?? null,
    'gender' => $data['gender'] ?? null,
    'address' => $data['address'] ?? null,
    'emergency_contact_name' => $data['emergency_contact_name'] ?? null,
    'emergency_contact_phone' => $data['emergency_contact_phone'] ?? null,
    'department_id' => $data['department_id'],
    'designation_id' => $data['designation_id'],
    'employee_type' => $data['employee_type'],
    'joining_date' => $data['joining_date'],
    'reporting_manager_id' => $data['reporting_manager_id'] ?? null,
    'status' => $data['status'] ?? 'active',
]);
$leaveTypes = LeaveType::all();
foreach ($leaveTypes as $leaveType) {
    LeaveBalance::create([
        'employee_id' => $employee->id,
        'leave_type_id' => $leaveType->id,
        'year' => now()->year,
        'allocated_days' => $leaveType->days_per_year,
        'used_days' => 0,
        'carried_forward_days' => 0,
        'remaining_days' => $leaveType->days_per_year,
    ]);
}
return $employee;
     
    }

    public function updateEmployee(Employee $employee, array $data): Employee
    {
        if (isset($data['profile_image']) && $data['profile_image']) {
    if ($employee->profile_image) {
        Storage::disk('public')->delete($employee->profile_image);
    }
    $data['profile_image'] = $data['profile_image']->store('profile-images', 'public');
} else {
    unset($data['profile_image']);
}

$employee->update($data);
return $employee;
    }
    public function deleteEmployee(Employee $employee): void
{
    $employee->leaveBalances()->delete();
    $employee->delete();
}
}