<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminPatientController extends Controller
{
    public function index()
    {
        $patients = User::where('role', 'patient')
            ->withCount('appointments')
            ->latest()
            ->paginate(15);

        return view('admin.patients.index', compact('patients'));
    }

    public function show($id)
    {
        $patient = User::where('role', 'patient')
            ->with(['appointments.doctor.user', 'appointments.payment'])
            ->findOrFail($id);

        return view('admin.patients.show', compact('patient'));
    }

    public function destroy($id)
    {
        $patient = User::where('role', 'patient')->findOrFail($id);
        $patient->delete();
        return back()->with('success', '✅ Patient deleted successfully.');
    }
}