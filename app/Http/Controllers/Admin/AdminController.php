<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Payment;
use App\Models\User;

class AdminController extends Controller
{
   public function dashboard()
{
    $stats = [
        'total_patients'     => \App\Models\User::where('role', 'patient')->count(),
        'total_doctors'      => \App\Models\Doctor::count(),
        'total_appointments' => \App\Models\Appointment::count(),
        'total_revenue'      => \App\Models\Payment::where('status', 'paid')->sum('amount'),
        'pending'            => \App\Models\Appointment::where('status', 'pending')->count(),
        'confirmed'          => \App\Models\Appointment::where('status', 'confirmed')->count(),
    ];

    $recent = \App\Models\Appointment::with(['patient', 'doctor.user'])
        ->latest()
        ->take(10)
        ->get();

    return view('admin.dashboard', compact('stats', 'recent'));
}
}