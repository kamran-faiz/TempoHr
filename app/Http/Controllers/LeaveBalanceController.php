<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Inertia\Inertia;
class LeaveBalanceController extends Controller
{
    public function index(){
        $employee = Employee::with(['designation', 'department', 'leaveBalances.leaveType'])->latest()->get();
        
        $activeLeaves = LeaveRequest::where('status', 'approved')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->count();
        
        $pendingRequests = LeaveRequest::where('status', 'pending')->count();

        return Inertia::render('Leaves/LeaveBalances',[
            'employees' => $employee,
            'activeLeaves' => $activeLeaves,
            'pendingRequests' => $pendingRequests
        ]);
    }
}
