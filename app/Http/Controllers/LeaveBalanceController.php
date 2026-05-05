<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Inertia\Inertia;
class LeaveBalanceController extends Controller
{
    public function index(){
        $employee = Employee::with(['designation', 'department', 'leaveBalances.leaveType'])->latest()->get();
        return Inertia::render('Leaves/LeaveBalances',[
            'employees' => $employee,
        ]);
    }
}
