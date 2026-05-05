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
     * Show payroll index page (list of processed payrolls)
     */
    public function index()
    {
        $payrolls = Payroll::with('employee.designation', 'employee.department')
            ->latest()
            ->paginate(20);
        
        $totalAmount = $payrolls->sum('gross_salary');
        $totalEmployees = $payrolls->count();
        $pendingCount = Payroll::where('status', 'draft')->count();
        
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        
        return Inertia::render('Payroll/Index', [
            'payrolls' => $payrolls,
            'totalAmount' => $totalAmount,
            'totalEmployees' => $totalEmployees,
            'pendingCount' => $pendingCount,
            'months' => $months,
            'currentYear' => Carbon::now()->year,
        ]);
    }

    /**
     * Show generate payroll page
     */
    public function generate()
    {
        $employees = Employee::with(['designation', 'department', 'employeeSalary.allowances'])
            ->where('status', 'active')
            ->get();
        
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        
        return Inertia::render('Payroll/Generate', [
            'employees' => $employees,
            'months' => $months,
            'currentYear' => Carbon::now()->year,
        ]);
    }

    /**
     * Process payroll generation
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer',
            'employees' => 'required|array',
            'employees.*.id' => 'exists:employees,id',
            'employees.*.basic_salary' => 'numeric',
            'employees.*.allowances' => 'numeric',
            'employees.*.gross_salary' => 'numeric',
        ]);
        
        $month = $validated['month'];
        $year = $validated['year'];
        
        // Check if payroll already processed for this month/year
        $existing = Payroll::where('month', $month)->where('year', $year)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Payroll for this month already processed.');
        }
        
        $count = 0;
        foreach ($validated['employees'] as $employeeData) {
            Payroll::create([
                'employee_id' => $employeeData['id'],
                'month' => $month,
                'year' => $year,
                'basic_salary' => $employeeData['basic_salary'],
                'allowances_total' => $employeeData['allowances'],
                'gross_salary' => $employeeData['gross_salary'],
                'status' => 'processed',
                'processed_at' => now(),
            ]);
            $count++;
        }
        
        $monthName = date('F', mktime(0, 0, 0, $month, 1));
        return redirect()->route('payroll.index')->with('success', "Payroll for $monthName $year processed successfully. Total employees: $count");
    }

    /**
     * Show single payslip
     */
    public function payslip($id)
    {
        $payroll = Payroll::with('employee.designation', 'employee.department')
            ->findOrFail($id);
        
        return Inertia::render('Payroll/Payslip', [
            'payroll' => $payroll,
        ]);
    }

    /**
     * Get payroll records for filtering (API endpoint)
     */
    public function records(Request $request)
    {
        $query = Payroll::with('employee.designation', 'employee.department');
        
        if ($request->department) {
            $query->whereHas('employee.department', function($q) use ($request) {
                $q->where('name', $request->department);
            });
        }
        
        if ($request->month) {
            $query->where('month', $request->month);
        }
        
        if ($request->year) {
            $query->where('year', $request->year);
        }
        
        $payrolls = $query->latest()->paginate(20);
        
        return response()->json($payrolls);
    }
}