<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Department;
use Inertia\Inertia;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::with('department')->latest()->get();
        $departments = Department::all();
        $totalEmployees = \App\Models\Employee::count();
        
        return Inertia::render('Settings/Designations', [
            'designations' => $designations,
            'departments' => $departments,
            'totalEmployees' => $totalEmployees
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:designations,name,NULL,id,department_id,'.$request->department_id,
            'department_id' => 'required|exists:departments,id',
            'description' => 'nullable|string',
        ]);
           Designation::create($validated);
            return redirect()->back()->with('success', 'Designation created successfully.');
    }

    public function update(Request $request, Designation $designation){
        $validated =$request->validate([
            'name' => 'required|string|max:100|unique:designations,name,'.$designation->id.',id,department_id,'.$request->department_id,
            'department_id' => 'required|exists:departments,id',
            'description' => 'nullable|string',
        ]);
        $designation->update($validated);
        return redirect()->back()->with('success', 'Designation updated successfully.');
    }

    public function destroy(Designation $designation){
        $designation->delete();
        return redirect()->back()->with('success', 'Designation deleted successfully.');
    }
}
