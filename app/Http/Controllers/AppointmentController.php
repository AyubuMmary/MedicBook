<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // ==================== SHOW BOOKING FORM ====================
    public function create($doctorId)
    {
        $doctor = Doctor::with('user')->findOrFail($doctorId);
        return view('appointments.create', compact('doctor'));
    }

    // ==================== STORE NEW APPOINTMENT ====================
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id'        => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'symptoms'         => 'nullable|string|max:500',
        ]);

        // Check if time slot is already booked
        $exists = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'slot' => '⚠️ This time slot is already booked. Please choose another time.'
            ])->withInput();
        }

        // Generate simple appointment ID
        // Format: APT00001, APT00002, APT00003 ...
        $count         = Appointment::count() + 1;
        $appointmentId = 'APT' . str_pad($count, 5, '0', STR_PAD_LEFT);

        // Create the appointment
        $appointment = Appointment::create([
            'appointment_id'   => $appointmentId,
            'patient_id'       => auth()->id(),
            'doctor_id'        => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'symptoms'         => $request->symptoms,
            'status'           => 'pending',
        ]);

        return redirect()->route('payment.create', $appointment->id)
            ->with('success', '✅ Appointment booked! Your ID is ' . $appointmentId . '. Please complete payment.');
    }

    // ==================== MY APPOINTMENTS ====================
    public function myAppointments()
    {
        $appointments = Appointment::with(['doctor.user', 'payment'])
            ->where('patient_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('appointments.my', compact('appointments'));
    }

    // ==================== SHOW SINGLE APPOINTMENT ====================
    public function show($id)
    {
        $appointment = Appointment::with([
            'doctor.user',
            'patient',
            'payment'
        ])
        ->where('patient_id', auth()->id())
        ->findOrFail($id);

        return view('appointments.show', compact('appointment'));
    }

    // ==================== CANCEL APPOINTMENT ====================
    public function cancel($id)
    {
        $appointment = Appointment::where('patient_id', auth()->id())
            ->findOrFail($id);

        // Cannot cancel if already completed
        if ($appointment->status === 'completed') {
            return back()->with('error', '❌ Cannot cancel a completed appointment.');
        }

        // Cannot cancel if already cancelled
        if ($appointment->status === 'cancelled') {
            return back()->with('error', '❌ This appointment is already cancelled.');
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', '✅ Appointment ' . $appointment->appointment_id . ' has been cancelled successfully.');
    }
}