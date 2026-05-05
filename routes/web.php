<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\AllowanceTypeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\LeaveBalanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Settings Modules
    Route::resource('departments', DepartmentController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('designations', DesignationController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('leaveTypes', LeaveTypeController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('allowanceTypes', AllowanceTypeController::class)->only(['index', 'store', 'update', 'destroy']);
    
    // Employee Management
    Route::resource('employees', EmployeeController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::patch('employees/{employee}/status', [EmployeeController::class, 'toggleStatus'])->name('EmployeeStatus.patch');
    
    // Leave Management
    Route::resource('leaveRequests', LeaveRequestController::class)->only(['store', 'index', 'update', 'destroy']);
    Route::put('leaveRequests/{leaveRequest}/status', [LeaveRequestController::class, 'updateStatus'])->name('leaveRequests.updateStatus');
    
    // Salary Management
    Route::resource('employeeSalary', EmployeeSalaryController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('leave-balances', LeaveBalanceController::class)->only(['index']);
    
    // Payroll Management
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
    Route::get('/payroll/generate', [PayrollController::class, 'generate'])->name('payroll.generate');
    Route::post('/payroll/process', [PayrollController::class, 'process'])->name('payroll.process');
    Route::get('/payroll/payslip/{id}', [PayrollController::class, 'payslip'])->name('payroll.payslip');
    Route::get('/payroll/records', [PayrollController::class, 'records'])->name('payroll.records');
});

require __DIR__.'/auth.php';