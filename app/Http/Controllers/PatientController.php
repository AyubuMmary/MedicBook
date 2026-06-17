<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;

class PatientController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        $appointments = Appointment::with(['doctor.user', 'payment'])
            ->where('patient_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $totalAppointments     = Appointment::where('patient_id', $user->id)->count();
        $confirmedAppointments = Appointment::where('patient_id', $user->id)->where('status', 'confirmed')->count();
        $pendingAppointments   = Appointment::where('patient_id', $user->id)->where('status', 'pending')->count();

        $doctors = Doctor::with('user')
            ->whereHas('user')
            ->where('is_available', true)
            ->latest()
            ->take(6)
            ->get();

        return view('patient.dashboard', compact(
            'appointments',
            'totalAppointments',
            'confirmedAppointments',
            'pendingAppointments',
            'doctors'
        ));
    }
}