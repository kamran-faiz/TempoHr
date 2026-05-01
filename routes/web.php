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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('departments', DepartmentController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('designations', DesignationController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('leaveTypes', LeaveTypeController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('allowanceTypes', AllowanceTypeController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('employees', EmployeeController::class)->only(['index', 'show', 'store' , 'update' , 'destroy']);
    Route::resource('leaveRequests', LeaveRequestController::class)->only(['store','index','update','destroy']);
    Route::put('leaveRequests/{leaveRequest}/status', [LeaveRequestController::class , 'updateStatus'])->name('leaveRequests.updateStatus');
});

require __DIR__.'/auth.php';
