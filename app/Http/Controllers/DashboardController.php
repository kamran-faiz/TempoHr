<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Department;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total employees
        $totalEmployees = Employee::count();
        
        // Active employees
        $presentToday = Employee::where('status', 'active')->count();
        
        // Pending leave requests
        $pendingLeaves = LeaveRequest::where('status', 'pending')->count();
        
        // Department breakdown
        $departments = Department::withCount('employees')->get();
        $totalInDepts = $departments->sum('employees_count');
        $departmentBreakdown = $departments->map(function($dept) use ($totalInDepts) {
            return [
                'name' => $dept->name,
                'count' => $dept->employees_count,
                'percentage' => $totalInDepts > 0 ? round(($dept->employees_count / $totalInDepts) * 100) : 0
            ];
        });
        
        // Pending leave requests for the table
        $pendingLeaveRequests = LeaveRequest::with(['employee.designation', 'employee.department', 'leaveType'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get()
            ->map(function($request) {
                return [
                    'id' => $request->id,
                    'employee_name' => $request->employee->first_name . ' ' . $request->employee->last_name,
                    'employee_avatar' => $request->employee->profile_image,
                    'leave_type' => $request->leaveType->name ?? 'Unknown',
                    'days' => Carbon::parse($request->start_date)->diffInDays($request->end_date) + 1,
                    'status' => $request->status
                ];
            });
        
        // Recent activities
        $recentLeaves = LeaveRequest::with('employee')
            ->latest()
            ->take(3)
            ->get()
            ->map(function($leave) {
                return [
                    'type' => 'leave',
                    'icon' => 'event_note',
                    'icon_color' => 'primary',
                    'message' => "{$leave->employee->first_name} {$leave->employee->last_name} requested new leave",
                    'time' => $leave->created_at->diffForHumans()
                ];
            });
        
        $recentEmployees = Employee::latest()
            ->take(2)
            ->get()
            ->map(function($employee) {
                return [
                    'type' => 'new_employee',
                    'icon' => 'person_add',
                    'icon_color' => 'secondary',
                    'message' => "{$employee->first_name} {$employee->last_name} joined the team",
                    'time' => $employee->created_at->diffForHumans()
                ];
            });
        
        $recentActivities = $recentLeaves->concat($recentEmployees)->sortByDesc('time')->take(5)->values();
        
        // Employee spotlight
        $spotlightEmployee = Employee::with('designation')
            ->where('status', 'active')
            ->inRandomOrder()
            ->first();
        
        // Upcoming events (Dynamic dates based on current month)
        $now = Carbon::now();
        $upcomingEvents = [
            ['month' => strtoupper($now->format('M')), 'day' => 25, 'title' => 'Town Hall Meeting', 'time' => '09:30 AM', 'location' => 'Main Conference Hall'],
            ['month' => strtoupper($now->format('M')), 'day' => 28, 'title' => 'Payroll Submission', 'time' => '11:59 PM', 'location' => 'Monthly Deadline'],
            ['month' => strtoupper($now->addMonth()->format('M')), 'day' => 2, 'title' => 'Quarterly Performance Review', 'time' => 'Full Day', 'location' => 'Management Board'],
        ];
        
        $praiseMessages = [
            "Outstanding contribution to the team this quarter.",
            "Consistently delivering high-quality work and mentoring others.",
            "Exceeded all performance targets and showed great leadership.",
            "Innovative problem solver who always goes above and beyond.",
            "A vital member of the team with a positive impact on company culture."
        ];
        $spotlightMessage = $praiseMessages[array_rand($praiseMessages)];
        
        // Current date
        $currentDate = Carbon::now();
        $dayName = $currentDate->format('l');
        $formattedDate = $currentDate->format('F j, Y');
        
        return Inertia::render('Dashboard', [
            'userName' => auth()->user()->employee->first_name ?? auth()->user()->name,
            'totalEmployees' => $totalEmployees,
            'presentToday' => $presentToday,
            'pendingLeaves' => $pendingLeaves,
            'departmentBreakdown' => $departmentBreakdown,
            'pendingLeaveRequests' => $pendingLeaveRequests,
            'recentActivities' => $recentActivities,
            'spotlightEmployee' => $spotlightEmployee,
            'spotlightMessage' => $spotlightMessage,
            'upcomingEvents' => $upcomingEvents,
            'dayName' => $dayName,
            'formattedDate' => $formattedDate,
        ]);
    }
}