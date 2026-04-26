<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_code' => 'required|string|unique:employees,employee_code,'.$this->employee->id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:employees,email,'.$this->employee->id,
            'phone' => 'nullable|string',
            'cnic' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string',
            'emergency_contact_phone' => 'nullable|string',
            'profile_image' => 'nullable|max:2048|mimes:jpg,jpeg,png',
            'designation_id' => 'required|exists:designations,id',
            'department_id' => 'required|exists:departments,id',
            'employee_type' => 'required|string|in:full_time,part_time,contractor',
            'joining_date' => 'required|date',
            'reporting_manager_id' => 'nullable|exists:employees,id',
            'status' => 'required|string|in:active,inactive',
        ];
    }
}
