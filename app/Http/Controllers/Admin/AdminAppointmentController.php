<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['patient', 'doctor.user', 'payment'])->latest();

        if ($request->has('status') && $request->status !== '' && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $appointments  = $query->paginate(15);
        $currentStatus = $request->status ?? 'all';

        return view('admin.appointments.index', compact('appointments', 'currentStatus'));
    }

    public function updateStatus($id, $status)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => $status]);
        return back()->with('success', '✅ Appointment status updated to ' . ucfirst($status));
    }
}