<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Payroll;
use Inertia\Inertia;
use Carbon\Carbon;

class PayrollController extends Controller
{
    /**
     * Show Run Payroll page
     */
    public function index()
    {
        $employees = Employee::with(['designation', 'department'])->get();
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        $currentYear = Carbon::now()->year;
        
        return Inertia::render('Payroll/RunPayroll', [
            'employees' => $employees,
            'months' => $months,
            'currentYear' => $currentYear,
        ]);
    }

    /**
     * Process payroll for selected month/year
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2000|max:2100',
        ]);

        $month = $validated['month'];
        $year = $validated['year'];

        // Check if payroll already processed for this month/year
        $existing = Payroll::where('month', $month)->where('year', $year)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Payroll for this month already processed.');
        }

        $employees = Employee::with(['employeeSalary.allowances'])->where('status', 'active')->get();
        $payrolls = [];

        foreach ($employees as $employee) {
            $salary = $employee->employeeSalary()->latest()->first();
            
            if ($salary) {
                $basicSalary = $salary->basic_salary;
                $allowancesTotal = $salary->allowances()->sum('value');
                $grossSalary = $basicSalary + $allowancesTotal;

                $payrolls[] = Payroll::create([
                    'employee_id' => $employee->id,
                    'month' => $month,
                    'year' => $year,
                    'basic_salary' => $basicSalary,
                    'allowances_total' => $allowancesTotal,
                    'gross_salary' => $grossSalary,
                    'status' => 'processed',
                    'processed_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', "Payroll for " . date('F', mktime(0,0,0,$month,1)) . " $year processed successfully. Total employees: " . count($payrolls));
    }

    /**
     * Show Salary List (all payroll records)
     */
    public function salaryList(Request $request)
    {
        $query = Payroll::with('employee.designation', 'employee.department');
        
        if ($request->month) {
            $query->where('month', $request->month);
        }
        if ($request->year) {
            $query->where('year', $request->year);
        }
        
        $payrolls = $query->latest()->paginate(20);
        
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        $years = Payroll::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        
        return Inertia::render('Payroll/SalaryList', [
            'payrolls' => $payrolls,
            'months' => $months,
            'years' => $years,
            'filters' => $request->only(['month', 'year']),
        ]);
    }

    /**
     * Update payroll status
     */
    public function updateStatus(Request $request, Payroll $payroll)
    {
        $validated = $request->validate([
            'status' => 'required|in:draft,processed,paid',
        ]);
        
        $payroll->update(['status' => $validated['status']]);
        
        return redirect()->back()->with('success', 'Payroll status updated.');
    }

    /**
     * Delete payroll record
     */
    public function destroy(Payroll $payroll)
    {
        $payroll->delete();
        return redirect()->back()->with('success', 'Payroll record deleted.');
    }
}