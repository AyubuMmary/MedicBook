<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class AdminPaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['appointment.patient', 'appointment.doctor.user'])
            ->latest()
            ->paginate(15);

        $totalRevenue   = Payment::where('status', 'paid')->sum('amount');
        $totalPaid      = Payment::where('status', 'paid')->count();
        $totalPending   = Payment::where('status', 'pending')->count();
        $totalFailed    = Payment::where('status', 'failed')->count();

        return view('admin.payments.index', compact(
            'payments', 'totalRevenue',
            'totalPaid', 'totalPending', 'totalFailed'
        ));
    }
}