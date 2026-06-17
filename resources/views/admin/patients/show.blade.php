@extends('layouts.app')
@section('title', 'Patient Details')
@section('content')

<div class="max-w-4xl mx-auto">

    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.patients.index') }}"
           class="w-10 h-10 bg-white rounded-full shadow flex items-center justify-center text-gray-600 hover:text-blue-700 transition">
            ←
        </a>
        <div>
            <h2 class="text-3xl font-bold text-gray-800" style="font-family:'Poppins',sans-serif;">
                Patient Details
            </h2>
            <p class="text-gray-500 text-sm">{{ $patient->name }}'s profile and appointments</p>
        </div>
    </div>

    <!-- Patient Card -->
    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <div class="flex items-center gap-6">
            <div class="w-20 h-20 rounded-full flex items-center justify-center font-bold text-white text-3xl shadow-lg"
                 style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                {{ strtoupper(substr($patient->name, 0, 1)) }}
            </div>
            <div class="flex-1">
                <h3 class="text-2xl font-bold text-gray-800">{{ $patient->name }}</h3>
                <p class="text-gray-500">{{ $patient->email }}</p>
                <p class="text-gray-500">{{ $patient->phone ?? 'No phone' }}</p>
                <p class="text-gray-400 text-sm mt-1">
                    Joined: {{ $patient->created_at->format('F d, Y') }}
                </p>
            </div>
            <div class="text-center">
                <p class="text-4xl font-extrabold text-blue-700">{{ $patient->appointments->count() }}</p>
                <p class="text-gray-500 text-sm">Total Appointments</p>
            </div>
        </div>
    </div>

    <!-- Appointments List -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-700">Appointment History</h3>
        </div>

        @if($patient->appointments->isEmpty())
            <div class="text-center py-12">
                <p class="text-6xl mb-3">📅</p>
                <p class="text-gray-500">No appointments yet</p>
            </div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach($patient->appointments as $apt)
                <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                    <div>
                        <p class="font-mono text-blue-600 text-xs font-bold">{{ $apt->appointment_id }}</p>
                        <p class="font-semibold text-gray-800 mt-1">
                            @if($apt->doctor && $apt->doctor->user)
                                Dr. {{ $apt->doctor->user->name }}
                                <span class="text-blue-600 text-sm">({{ $apt->doctor->specialization }})</span>
                            @endif
                        </p>
                        <p class="text-gray-400 text-sm">
                            {{ \Carbon\Carbon::parse($apt->appointment_date)->format('M d, Y') }}
                            at {{ date('h:i A', strtotime($apt->appointment_time)) }}
                        </p>
                    </div>
                    <div class="text-right">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($apt->status === 'confirmed') bg-green-100 text-green-700
                            @elseif($apt->status === 'pending') bg-yellow-100 text-yellow-700
                            @elseif($apt->status === 'cancelled') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ ucfirst($apt->status) }}
                        </span>
                        @if($apt->payment)
                            <p class="text-green-600 font-bold text-sm mt-1">
                                TSh {{ number_format($apt->payment->amount) }}
                            </p>
                            <p class="text-gray-400 text-xs">{{ ucfirst($apt->payment->status) }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection