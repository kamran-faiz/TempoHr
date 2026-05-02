<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\LeaveType;

use Inertia\Inertia;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaveRequest = LeaveRequest::with(['employee.designation', 'leaveType'])->latest()->get();
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();
       
          return Inertia::render('Leaves/LeaveRequests', [
            'leaveRequests' => $leaveRequest,
            'employees' => $employees,      
            'leaveTypes' => $leaveTypes 
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
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason' => 'nullable|string'

        ]);
        LeaveRequest::create($validated);
        return redirect()->back()->with('success', 'LeaveRequest created successfully.');

    }

    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason' => 'nullable|string',
        ]);
        $leaveRequest->update($validated);
        return redirect()->back()->with('success','LeaveRequest updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();
        return redirect()->back()->with('success','LeaveRequest deleted successfully');
    }
    
        public function updateStatus(Request $request, LeaveRequest $leaveRequest) {
    $leaveRequest->update(['status' => $request->status]);
    if ($request->status === 'approved') {
    $days = \Carbon\Carbon::parse($leaveRequest->start_date)
    ->diffInDays($leaveRequest->end_date) + 1;
    $balance = \App\Models\LeaveBalance::where('employee_id', $leaveRequest->employee_id)
    ->where('leave_type_id', $leaveRequest->leave_type_id)
    ->where('year', now()->year)
    ->first();
    if ($balance) {
    $balance->update([
        'used_days' => $balance->used_days + $days,
        'remaining_days' => $balance->remaining_days - $days,
    ]);
}
}
    return redirect()->back()->with('success', 'Status updated!');
}
}
