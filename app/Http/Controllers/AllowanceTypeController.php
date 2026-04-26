<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllowanceType;
use Inertia\Inertia;

class AllowanceTypeController extends Controller
{
    public function index()
    {
        $allowanceTypes = AllowanceType::latest()->get();
        return Inertia::render('Settings/AllowanceTypes', [
            'allowanceTypes' => $allowanceTypes
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:allowance_types,name',
            'type' => 'required|string|in:fixed,percentage',
        ]);
        
        AllowanceType::create($validated);
        return redirect()->back()->with('success', 'Allowance Type created successfully.');
    }

    public function update(Request $request, AllowanceType $allowanceType)
    {
            $validated = $request->validate([
                'name' => 'required|string|max:100|unique:allowance_types,name,' . $allowanceType->id,
                'type' => 'required|string|in:fixed,percentage',
            ]);
            $allowanceType->update($validated);
            return redirect()->back()->with('success', 'Allowance Type updated successfully.');
    }

    public function destroy(AllowanceType $allowanceType)
    {
        $allowanceType->delete();
        return redirect()->back()->with('success', 'Allowance Type deleted successfully.');
    }
}
