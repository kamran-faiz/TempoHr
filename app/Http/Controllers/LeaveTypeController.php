<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveType;
use Inertia\Inertia;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveType = LeaveType::latest()->get();
        return Inertia::render('Settings/LeaveTypes', [
            'leaveType' => $leaveType,
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:leave_types,name',
            'days_per_year' => 'required|integer',
            'carry_forward' => 'required|boolean',
            'carry_forward_limit' => 'nullable|integer',
            'is_encashable' => 'required|boolean',
            'allow_encroachment' => 'required|boolean',
        ]);
              LeaveType::create($validated);
              return redirect()->back()->with('success', 'Leave Type created successfully.');
    }
    public function update(Request $request,LeaveType $leaveType){
        
    $validated = $request->validate([
        'name' => 'required|string|max:100|unique:leave_types,name,'.$leaveType->id,
        'days_per_year' => 'required|integer',
        'carry_forward' => 'required|boolean',
        'carry_forward_limit' => 'nullable|integer',
        'is_encashable' => 'required|boolean',
        'allow_encroachment' => 'required|boolean',
    ]);
       $leaveType->update($validated);
       return redirect()->back()->with('success', 'Leave Type updated successfully.');

    }

    public function destroy(LeaveType $leaveType){
        $leaveType->delete();
        return redirect()->back()->with('success', 'Leave Type deleted successfully.');
    }
}
