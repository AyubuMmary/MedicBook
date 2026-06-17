@extends('layouts.app')
@section('title', 'All Patients')
@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800" style="font-family:'Poppins',sans-serif;">
                👥 All Patients
            </h2>
            <p class="text-gray-500 text-sm mt-1">Manage all registered patients</p>
        </div>
        <a href="{{ route('admin.dashboard') }}"
           class="bg-gray-100 text-gray-700 px-4 py-2.5 rounded-xl hover:bg-gray-200 transition font-semibold text-sm">
            ← Dashboard
        </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-2xl shadow p-5 text-center border-b-4 border-blue-500">
            <p class="text-4xl font-extrabold text-blue-700">{{ $patients->total() }}</p>
            <p class="text-gray-500 mt-1">Total Patients</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5 text-center border-b-4 border-green-500">
            <p class="text-4xl font-extrabold text-green-600">
                {{ $patients->sum('appointments_count') }}
            </p>
            <p class="text-gray-500 mt-1">Total Bookings</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5 text-center border-b-4 border-purple-500">
            <p class="text-4xl font-extrabold text-purple-600">
                {{ $patients->where('appointments_count', '>', 0)->count() }}
            </p>
            <p class="text-gray-500 mt-1">Active Patients</p>
        </div>
    </div>

    <!-- Patients Table -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-700">All Patients ({{ $patients->total() }})</h3>
        </div>

        @if($patients->isEmpty())
            <div class="text-center py-16">
                <div class="text-6xl mb-4">👥</div>
                <p class="text-gray-500 text-lg">No patients registered yet</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">#</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Patient</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Phone</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Appointments</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Joined</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($patients as $patient)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4 text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white text-sm"
                                         style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                                        {{ strtoupper(substr($patient->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $patient->name }}</p>
                                        <p class="text-gray-400 text-xs">{{ $patient->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $patient->phone ?? '—' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $patient->appointments_count }} bookings
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">
                                {{ $patient->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.patients.show', $patient->id) }}"
                                       class="bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg hover:bg-blue-200 text-xs font-semibold transition">
                                        👁️ View
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.patients.destroy', $patient->id) }}"
                                          onsubmit="return confirm('Delete this patient?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-100 text-red-700 px-3 py-1.5 rounded-lg hover:bg-red-200 text-xs font-semibold transition">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $patients->links() }}
            </div>
        @endif
    </div>
</div>

@endsection