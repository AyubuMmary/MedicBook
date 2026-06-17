@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800" style="font-family:'Poppins',sans-serif;">
                ⚙️ Admin Dashboard
            </h2>
            <p class="text-gray-500 text-sm mt-1">
                Welcome back, {{ auth()->user()->name }}! Here's what's happening today.
            </p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.doctors.create') }}"
               class="text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow transition hover:-translate-y-0.5"
               style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                + Add Doctor
            </a>
            <a href="{{ route('admin.appointments.index') }}"
               class="bg-gray-100 text-gray-700 px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-gray-200 transition">
                View Appointments
            </a>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-5 mb-10">

        <!-- Total Patients -->
        <a href="{{ route('admin.patients.index') }}"
           class="rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition hover:-translate-y-1 cursor-pointer"
           style="background: linear-gradient(135deg, #1d4ed8, #3b82f6); display:block; text-decoration:none;">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1rem;">
                <div>
                    <p style="color:#bfdbfe; font-size:0.875rem; font-weight:500;">Total Patients</p>
                    <p style="font-size:3rem; font-weight:900; line-height:1; margin-top:0.25rem;">
                        {{ $stats['total_patients'] }}
                    </p>
                </div>
                <div style="width:3.5rem; height:3.5rem; background:rgba(255,255,255,0.2); border-radius:1rem; display:flex; align-items:center; justify-content:center; font-size:1.75rem;">
                    👥
                </div>
            </div>
            <p style="color:#bfdbfe; font-size:0.75rem;">View all patients →</p>
        </a>

        <!-- Total Doctors -->
        <a href="{{ route('admin.doctors.index') }}"
           class="rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition hover:-translate-y-1 cursor-pointer"
           style="background: linear-gradient(135deg, #059669, #10b981); display:block; text-decoration:none;">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1rem;">
                <div>
                    <p style="color:#d1fae5; font-size:0.875rem; font-weight:500;">Total Doctors</p>
                    <p style="font-size:3rem; font-weight:900; line-height:1; margin-top:0.25rem;">
                        {{ $stats['total_doctors'] }}
                    </p>
                </div>
                <div style="width:3.5rem; height:3.5rem; background:rgba(255,255,255,0.2); border-radius:1rem; display:flex; align-items:center; justify-content:center; font-size:1.75rem;">
                    👨‍⚕️
                </div>
            </div>
            <p style="color:#d1fae5; font-size:0.75rem;">Manage doctors →</p>
        </a>

        <!-- Total Appointments -->
        <a href="{{ route('admin.appointments.index') }}"
           class="rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition hover:-translate-y-1 cursor-pointer"
           style="background: linear-gradient(135deg, #7c3aed, #a855f7); display:block; text-decoration:none;">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1rem;">
                <div>
                    <p style="color:#ede9fe; font-size:0.875rem; font-weight:500;">Total Appointments</p>
                    <p style="font-size:3rem; font-weight:900; line-height:1; margin-top:0.25rem;">
                        {{ $stats['total_appointments'] }}
                    </p>
                </div>
                <div style="width:3.5rem; height:3.5rem; background:rgba(255,255,255,0.2); border-radius:1rem; display:flex; align-items:center; justify-content:center; font-size:1.75rem;">
                    📅
                </div>
            </div>
            <p style="color:#ede9fe; font-size:0.75rem;">View all →</p>
        </a>

        <!-- Total Revenue -->
        <a href="{{ route('admin.payments.index') }}"
           class="rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition hover:-translate-y-1 cursor-pointer"
           style="background: linear-gradient(135deg, #d97706, #f59e0b); display:block; text-decoration:none;">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1rem;">
                <div>
                    <p style="color:#fef3c7; font-size:0.875rem; font-weight:500;">Total Revenue</p>
                    <p style="font-size:1.75rem; font-weight:900; line-height:1; margin-top:0.25rem;">
                        TSh {{ number_format($stats['total_revenue']) }}
                    </p>
                </div>
                <div style="width:3.5rem; height:3.5rem; background:rgba(255,255,255,0.2); border-radius:1rem; display:flex; align-items:center; justify-content:center; font-size:1.75rem;">
                    💰
                </div>
            </div>
            <p style="color:#fef3c7; font-size:0.75rem;">View all payments →</p>
        </a>

        <!-- Pending -->
        <a href="{{ route('admin.appointments.index', ['status' => 'pending']) }}"
           class="rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition hover:-translate-y-1 cursor-pointer"
           style="background: linear-gradient(135deg, #ea580c, #f97316); display:block; text-decoration:none;">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1rem;">
                <div>
                    <p style="color:#ffedd5; font-size:0.875rem; font-weight:500;">Pending</p>
                    <p style="font-size:3rem; font-weight:900; line-height:1; margin-top:0.25rem;">
                        {{ $stats['pending'] }}
                    </p>
                </div>
                <div style="width:3.5rem; height:3.5rem; background:rgba(255,255,255,0.2); border-radius:1rem; display:flex; align-items:center; justify-content:center; font-size:1.75rem;">
                    ⏳
                </div>
            </div>
            <p style="color:#ffedd5; font-size:0.75rem;">Awaiting confirmation →</p>
        </a>

        <!-- Confirmed -->
        <a href="{{ route('admin.appointments.index', ['status' => 'confirmed']) }}"
           class="rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition hover:-translate-y-1 cursor-pointer"
           style="background: linear-gradient(135deg, #0d9488, #14b8a6); display:block; text-decoration:none;">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1rem;">
                <div>
                    <p style="color:#ccfbf1; font-size:0.875rem; font-weight:500;">Confirmed</p>
                    <p style="font-size:3rem; font-weight:900; line-height:1; margin-top:0.25rem;">
                        {{ $stats['confirmed'] }}
                    </p>
                </div>
                <div style="width:3.5rem; height:3.5rem; background:rgba(255,255,255,0.2); border-radius:1rem; display:flex; align-items:center; justify-content:center; font-size:1.75rem;">
                    ✅
                </div>
            </div>
            <p style="color:#ccfbf1; font-size:0.75rem;">Successfully booked →</p>
        </a>

    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        <a href="{{ route('admin.doctors.create') }}"
           class="bg-white rounded-2xl shadow p-5 text-center hover:shadow-lg transition hover:-translate-y-1 group block">
            <div class="text-4xl mb-2 group-hover:scale-110 transition">➕</div>
            <p class="font-semibold text-gray-700 text-sm">Add Doctor</p>
        </a>
        <a href="{{ route('admin.doctors.index') }}"
           class="bg-white rounded-2xl shadow p-5 text-center hover:shadow-lg transition hover:-translate-y-1 group block">
            <div class="text-4xl mb-2 group-hover:scale-110 transition">👨‍⚕️</div>
            <p class="font-semibold text-gray-700 text-sm">All Doctors</p>
        </a>
        <a href="{{ route('admin.appointments.index') }}"
           class="bg-white rounded-2xl shadow p-5 text-center hover:shadow-lg transition hover:-translate-y-1 group block">
            <div class="text-4xl mb-2 group-hover:scale-110 transition">📋</div>
            <p class="font-semibold text-gray-700 text-sm">Appointments</p>
        </a>
        <a href="{{ route('admin.patients.index') }}"
           class="bg-white rounded-2xl shadow p-5 text-center hover:shadow-lg transition hover:-translate-y-1 group block">
            <div class="text-4xl mb-2 group-hover:scale-110 transition">👥</div>
            <p class="font-semibold text-gray-700 text-sm">All Patients</p>
        </a>
    </div>

    <!-- Recent Appointments -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Recent Appointments</h3>
                <p class="text-gray-400 text-sm">Latest 10 appointments</p>
            </div>
            <a href="{{ route('admin.appointments.index') }}"
               class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition">
                View All →
            </a>
        </div>

        @if($recent->isEmpty())
            <div class="text-center py-16">
                <div class="text-6xl mb-4">📅</div>
                <p class="text-gray-500 text-lg">No appointments yet</p>
                <p class="text-gray-400 text-sm mt-1">
                    Appointments will appear here once patients start booking
                </p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Apt ID</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Patient</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Doctor</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Date & Time</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($recent as $apt)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono text-blue-600 text-xs font-bold bg-blue-50 px-2 py-1 rounded-lg">
                                    {{ $apt->appointment_id }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold text-white"
                                         style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                                        {{ strtoupper(substr($apt->patient->name ?? 'P', 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-gray-700">
                                        {{ $apt->patient->name ?? 'Unknown' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-700">
                                @if($apt->doctor && $apt->doctor->user)
                                    {{ str_starts_with($apt->doctor->user->name, 'Dr.') ? $apt->doctor->user->name : 'Dr. ' . $apt->doctor->user->name }}
                                @else
                                    <span class="text-gray-400">Unknown</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-700">
                                    {{ \Carbon\Carbon::parse($apt->appointment_date)->format('M d, Y') }}
                                </p>
                                <p class="text-gray-400 text-xs">
                                    {{ date('h:i A', strtotime($apt->appointment_time)) }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($apt->status === 'confirmed') bg-green-100 text-green-700
                                    @elseif($apt->status === 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($apt->status === 'cancelled') bg-red-100 text-red-700
                                    @else bg-gray-100 text-gray-700 @endif">
                                    @if($apt->status === 'confirmed') ✅
                                    @elseif($apt->status === 'pending') ⏳
                                    @elseif($apt->status === 'cancelled') ❌
                                    @else 🏁 @endif
                                    {{ ucfirst($apt->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    @if($apt->status === 'pending')
                                    <form method="POST"
                                          action="{{ route('admin.appointments.status', [$apt->id, 'confirmed']) }}">
                                        @csrf
                                        <button class="text-xs bg-green-100 text-green-700 px-3 py-1.5 rounded-lg hover:bg-green-200 font-semibold transition">
                                            ✅ Confirm
                                        </button>
                                    </form>
                                    @endif
                                    @if($apt->status !== 'cancelled')
                                    <form method="POST"
                                          action="{{ route('admin.appointments.status', [$apt->id, 'cancelled']) }}">
                                        @csrf
                                        <button class="text-xs bg-red-100 text-red-700 px-3 py-1.5 rounded-lg hover:bg-red-200 font-semibold transition">
                                            ❌ Cancel
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

@endsection