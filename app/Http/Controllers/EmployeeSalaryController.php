<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeSalary;
use App\Models\AllowanceType;
use App\Models\EmployeeAllowance;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeSalary = EmployeeSalary::with('allowance')->latest()->get();
        $allowanceTypes = AllowanceType::all();
        return Inertia::render('Employee/SalarySetup',[
          'employeeSalary' =>   $employeeSalary,
          'allowanceTypes'  => $allowanceTypes,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request ->validate([
            'employee_id' => 'required|exists:employees,id',
            'basic_salary' => 'required|numeric',
            'effective_date' => 'required|date',
            'allowances' => 'nullable|array',
            'allowances.*.allowance_type_id' => 'required|exists:allowance_types,id',
            'allowances.*.value' => 'required|numeric'
        ]);
        
        $salary = EmployeeSalary::create(['employee_id' => $validated['employee_id'],
        'basic_salary' => $validated['basic_salary'],
        'effective_date' => $validated['effective_date'],]);
    if (!empty($validated['allowances'])) {
      foreach ($validated['allowances'] as $allowance) {
        EmployeeAllowance::create([
        'employee_salary_id' => $salary->id,
        'allowance_type_id'  => $allowance['allowance_type_id'],
        'value'              => $allowance['value'],
    ]);
}
}
        return redirect()->back()->with('success','Employee Salary created successfully');
    }

   
    

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, EmployeeSalary $employeeSalary)
{
    $validated = $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'basic_salary' => 'required|numeric',
        'effective_date' => 'required|date',
        'allowances' => 'nullable|array',
        'allowances.*.allowance_type_id' => 'required|exists:allowance_types,id',
        'allowances.*.value' => 'required|numeric'
    ]);

    $employeeSalary->update([
        'employee_id' => $validated['employee_id'],
        'basic_salary' => $validated['basic_salary'],
        'effective_date' => $validated['effective_date'],
    ]);

    $employeeSalary->allowances()->delete();

    if (!empty($validated['allowances'])) {
        foreach ($validated['allowances'] as $allowance) {
            EmployeeAllowance::create([
                'employee_salary_id' => $employeeSalary->id,
                'allowance_type_id' => $allowance['allowance_type_id'],
                'value' => $allowance['value'],
            ]);
        }
    }

    return redirect()->back()->with('success', 'Employee Salary updated successfully');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeSalary $employeesalary)
    {
        $employeesalary->allowances()->delete();
        $employeesalary->delete();
        return redirect()->back()->with('success', 'EmployeeSalary deleted successfully.');
    }
}
