<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create($appointmentId)
    {
        $appointment = Appointment::with('doctor.user')
            ->where('patient_id', auth()->id())
            ->findOrFail($appointmentId);

        if ($appointment->payment && $appointment->payment->status === 'paid') {
            return redirect()->route('appointments.show', $appointment->id)
                ->with('info', 'This appointment is already paid.');
        }

        return view('payments.create', compact('appointment'));
    }

    public function process(Request $request, $appointmentId)
    {
        $appointment = Appointment::with('doctor')
            ->where('patient_id', auth()->id())
            ->findOrFail($appointmentId);

        $request->validate([
            'phone_number' => 'required|digits:9',
            'network'      => 'required|in:vodacom,tigo,airtel,halotel',
        ]);

        // Create payment record as pending
        Payment::updateOrCreate(
            ['appointment_id' => $appointment->id],
            [
                'user_id'           => auth()->id(),
                'amount'            => $appointment->doctor->consultation_fee,
                'stripe_payment_id' => 'MOBILE-' . strtoupper($request->network) . '-' . time(),
                'status'            => 'pending',
            ]
        );

        return response()->json(['success' => true]);
    }

    public function success(Request $request, $appointmentId)
    {
        $appointment = Appointment::where('patient_id', auth()->id())
            ->findOrFail($appointmentId);

        // Update or create payment as paid
        Payment::updateOrCreate(
            ['appointment_id' => $appointment->id],
            [
                'user_id' => auth()->id(),
                'amount'  => $appointment->doctor->consultation_fee,
                'status'  => 'paid',
            ]
        );

        // Confirm appointment
        $appointment->update(['status' => 'confirmed']);

        return redirect()->route('appointments.show', $appointment->id)
            ->with('success', '✅ Payment successful! Your appointment is confirmed.');
    }
}