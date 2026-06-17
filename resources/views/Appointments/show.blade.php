@extends('layouts.app')
@section('title', 'Appointment Details')
@section('content')

<div class="max-w-2xl mx-auto">

    <!-- Success Banner -->
    @if($appointment->status === 'confirmed' && session('success'))
    <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-2xl p-6 mb-6 text-center shadow-lg">
        <p class="text-5xl mb-3">🎉</p>
        <h2 class="text-2xl font-black">Payment Successful!</h2>
        <p class="text-green-100 text-sm mt-2">Your appointment has been confirmed successfully</p>
    </div>
    @endif

    <!-- Page Header -->
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('patient.dashboard') }}"
           class="w-10 h-10 bg-white rounded-full shadow flex items-center justify-center text-gray-600 hover:text-blue-700 transition">
            ←
        </a>
        <div>
            <h2 class="text-2xl font-black text-gray-800" style="font-family:'Poppins',sans-serif;">
                Appointment Details
            </h2>
            <p class="text-gray-500 text-sm">View your booking information</p>
        </div>
    </div>

    <!-- Main Appointment Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-5">

        <!-- Card Header with Appointment ID -->
        <div class="p-8 text-white text-center relative overflow-hidden"
             style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #4f46e5 100%);">
            <!-- Background decoration -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>

            <div class="relative z-10">
                <p class="text-blue-200 text-sm font-medium mb-2 uppercase tracking-widest">
                    🪪 Your Appointment ID
                </p>
                <div class="bg-white/15 rounded-2xl px-6 py-4 inline-block mb-3">
                    <p class="text-3xl font-black font-mono tracking-wider text-yellow-300">
                        {{ $appointment->appointment_id }}
                    </p>
                </div>
                <p class="text-blue-200 text-xs">
                    📋 Show this ID at the hospital reception desk
                </p>
            </div>
        </div>

        <!-- Status Banner -->
        <div class="px-6 py-3
            @if($appointment->status === 'confirmed') bg-green-50 border-b border-green-100
            @elseif($appointment->status === 'pending') bg-yellow-50 border-b border-yellow-100
            @elseif($appointment->status === 'cancelled') bg-red-50 border-b border-red-100
            @else bg-gray-50 border-b border-gray-100 @endif">
            <div class="flex justify-center">
                <span class="px-5 py-2 rounded-full text-sm font-bold flex items-center gap-2
                    @if($appointment->status === 'confirmed') bg-green-100 text-green-700
                    @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-700
                    @elseif($appointment->status === 'cancelled') bg-red-100 text-red-700
                    @else bg-gray-100 text-gray-700 @endif">
                    @if($appointment->status === 'confirmed')
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse inline-block"></span>
                        ✅ Appointment Confirmed
                    @elseif($appointment->status === 'pending')
                        <span class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse inline-block"></span>
                        ⏳ Pending Payment
                    @elseif($appointment->status === 'cancelled')
                        <span class="w-2 h-2 bg-red-500 rounded-full inline-block"></span>
                        ❌ Appointment Cancelled
                    @else
                        🏁 {{ ucfirst($appointment->status) }}
                    @endif
                </span>
            </div>
        </div>

        <!-- Appointment Details -->
        <div class="p-6">
            <h3 class="font-bold text-gray-700 text-sm uppercase tracking-wider mb-4">
                📋 Appointment Information
            </h3>

            <div class="space-y-0 divide-y divide-gray-50">

                <!-- Doctor -->
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">👨‍⚕️</span>
                        <span class="text-gray-500 font-medium text-sm">Doctor</span>
                    </div>
                    <div class="text-right">
                        @if($appointment->doctor && $appointment->doctor->user)
                            <p class="font-bold text-gray-800">
                                {{ str_starts_with($appointment->doctor->user->name, 'Dr.') ? $appointment->doctor->user->name : 'Dr. '.$appointment->doctor->user->name }}
                            </p>
                            <p class="text-blue-600 text-xs font-semibold">
                                {{ $appointment->doctor->specialization }}
                            </p>
                        @else
                            <p class="text-gray-400">Unknown</p>
                        @endif
                    </div>
                </div>

                <!-- Patient -->
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">👤</span>
                        <span class="text-gray-500 font-medium text-sm">Patient</span>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-800">{{ $appointment->patient->name }}</p>
                        <p class="text-gray-400 text-xs">{{ $appointment->patient->email }}</p>
                    </div>
                </div>

                <!-- Date -->
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">📅</span>
                        <span class="text-gray-500 font-medium text-sm">Appointment Date</span>
                    </div>
                    <p class="font-bold text-gray-800">
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F d, Y') }}
                    </p>
                </div>

                <!-- Time -->
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">🕐</span>
                        <span class="text-gray-500 font-medium text-sm">Appointment Time</span>
                    </div>
                    <p class="font-bold text-gray-800">
                        {{ date('h:i A', strtotime($appointment->appointment_time)) }}
                    </p>
                </div>

                <!-- Qualification -->
                @if($appointment->doctor && $appointment->doctor->qualification)
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">🎓</span>
                        <span class="text-gray-500 font-medium text-sm">Qualification</span>
                    </div>
                    <p class="font-bold text-gray-800">
                        {{ $appointment->doctor->qualification }}
                    </p>
                </div>
                @endif

                <!-- Consultation Fee -->
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">💰</span>
                        <span class="text-gray-500 font-medium text-sm">Consultation Fee</span>
                    </div>
                    <p class="font-black text-green-600 text-lg">
                        TSh {{ number_format($appointment->doctor->consultation_fee ?? 0) }}
                    </p>
                </div>

                <!-- Symptoms -->
                @if($appointment->symptoms)
                <div class="py-4">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xl">🩺</span>
                        <span class="text-gray-500 font-medium text-sm">Symptoms / Notes</span>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 ml-8">
                        <p class="text-gray-700 text-sm leading-relaxed">
                            {{ $appointment->symptoms }}
                        </p>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Payment Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-5">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                💳 Payment Information
            </h3>
        </div>

        @if($appointment->payment)
            <div class="p-6">
                <div class="space-y-0 divide-y divide-gray-50">

                    <!-- Payment Status -->
                    <div class="flex justify-between items-center py-4">
                        <span class="text-gray-500 font-medium text-sm">Payment Status</span>
                        <span class="px-4 py-1.5 rounded-full text-sm font-bold
                            @if($appointment->payment->status === 'paid') bg-green-100 text-green-700
                            @elseif($appointment->payment->status === 'pending') bg-yellow-100 text-yellow-700
                            @elseif($appointment->payment->status === 'failed') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700 @endif">
                            @if($appointment->payment->status === 'paid') ✅ Paid
                            @elseif($appointment->payment->status === 'pending') ⏳ Pending
                            @elseif($appointment->payment->status === 'failed') ❌ Failed
                            @else {{ ucfirst($appointment->payment->status) }}
                            @endif
                        </span>
                    </div>

                    <!-- Amount Paid -->
                    <div class="flex justify-between items-center py-4">
                        <span class="text-gray-500 font-medium text-sm">Amount Paid</span>
                        <p class="font-black text-green-600 text-xl">
                            TSh {{ number_format($appointment->payment->amount) }}
                        </p>
                    </div>

                    <!-- Payment Method -->
                    @if($appointment->payment->stripe_payment_id)
                    <div class="flex justify-between items-center py-4">
                        <span class="text-gray-500 font-medium text-sm">Payment Method</span>
                        <span class="font-semibold text-gray-700 text-sm">
                            @if(str_contains($appointment->payment->stripe_payment_id, 'VODACOM'))
                                📱 Vodacom M-Pesa
                            @elseif(str_contains($appointment->payment->stripe_payment_id, 'TIGO'))
                                📱 Tigo Pesa
                            @elseif(str_contains($appointment->payment->stripe_payment_id, 'AIRTEL'))
                                📱 Airtel Money
                            @elseif(str_contains($appointment->payment->stripe_payment_id, 'HALOTEL'))
                                📱 Halotel Pesa
                            @else
                                📱 Mobile Money
                            @endif
                        </span>
                    </div>
                    @endif

                    <!-- Payment Date -->
                    <div class="flex justify-between items-center py-4">
                        <span class="text-gray-500 font-medium text-sm">Payment Date</span>
                        <p class="font-semibold text-gray-700 text-sm">
                            {{ $appointment->payment->created_at->format('M d, Y h:i A') }}
                        </p>
                    </div>

                </div>
            </div>
        @else
            <div class="p-6 text-center">
                @if($appointment->status !== 'cancelled')
                    <div class="text-5xl mb-3">💳</div>
                    <p class="text-gray-500 font-medium mb-1">Payment Not Completed</p>
                    <p class="text-gray-400 text-sm mb-4">
                        Please complete payment to confirm your appointment
                    </p>
                    <a href="{{ route('payment.create', $appointment->id) }}"
                       class="inline-block px-8 py-3 rounded-xl font-bold text-white shadow-lg transition hover:-translate-y-0.5"
                       style="background: linear-gradient(135deg, #059669, #10b981);">
                        💳 Pay Now — TSh {{ number_format($appointment->doctor->consultation_fee ?? 0) }}
                    </a>
                @else
                    <p class="text-gray-400 text-sm">No payment for cancelled appointment</p>
                @endif
            </div>
        @endif
    </div>

    <!-- What to bring card -->
    @if($appointment->status === 'confirmed')
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-5">
        <h3 class="font-bold text-blue-800 mb-3 flex items-center gap-2">
            📌 What to Bring to Your Appointment
        </h3>
        <ul class="space-y-2 text-blue-700 text-sm">
            <li class="flex items-center gap-2">
                <span class="w-5 h-5 bg-blue-200 rounded-full flex items-center justify-center text-xs font-bold">1</span>
                Your National ID or Passport
            </li>
            <li class="flex items-center gap-2">
                <span class="w-5 h-5 bg-blue-200 rounded-full flex items-center justify-center text-xs font-bold">2</span>
                This Appointment ID: <strong class="font-mono">{{ $appointment->appointment_id }}</strong>
            </li>
            <li class="flex items-center gap-2">
                <span class="w-5 h-5 bg-blue-200 rounded-full flex items-center justify-center text-xs font-bold">3</span>
                Payment confirmation (screenshot)
            </li>
            <li class="flex items-center gap-2">
                <span class="w-5 h-5 bg-blue-200 rounded-full flex items-center justify-center text-xs font-bold">4</span>
                Arrive 10 minutes before your appointment time
            </li>
        </ul>
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex flex-col gap-3">

        <!-- Pay Now Button - only if not paid -->
        @if((!$appointment->payment || $appointment->payment->status !== 'paid') && $appointment->status !== 'cancelled')
        <a href="{{ route('payment.create', $appointment->id) }}"
           class="block w-full text-center py-4 rounded-xl font-black text-white text-lg shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl"
           style="background: linear-gradient(135deg, #059669, #10b981);">
            💳 Complete Payment — TSh {{ number_format($appointment->doctor->consultation_fee ?? 0) }}
        </a>
        @endif

        <!-- Back to Dashboard -->
        <a href="{{ route('patient.dashboard') }}"
           class="block w-full text-center py-3.5 rounded-xl font-bold text-white transition hover:-translate-y-0.5"
           style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
            ← Back to Dashboard
        </a>

        <!-- Cancel Button -->
        @if(in_array($appointment->status, ['pending', 'confirmed']))
        <form method="POST" action="{{ route('appointments.cancel', $appointment->id) }}">
            @csrf
            <button type="submit"
                    onclick="return confirm('⚠️ Are you sure you want to cancel this appointment? This action cannot be undone.')"
                    class="w-full py-3.5 rounded-xl font-bold bg-red-50 text-red-600 hover:bg-red-100 border-2 border-red-200 transition">
                ❌ Cancel Appointment
            </button>
        </form>
        @endif

    </div>

</div>

@endsection