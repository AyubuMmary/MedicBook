@extends('layouts.app')
@section('title', 'All Appointments')
@section('content')

<h2 class="text-3xl font-bold mb-6">All Appointments</h2>

<div class="bg-white shadow rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-3 text-left">Apt ID</th>
                <th class="px-4 py-3 text-left">Patient</th>
                <th class="px-4 py-3 text-left">Doctor</th>
                <th class="px-4 py-3 text-left">Date & Time</th>
                <th class="px-4 py-3 text-left">Payment</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $apt)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-3 font-mono text-blue-600 text-xs">{{ $apt->appointment_id }}</td>
                <td class="px-4 py-3">{{ $apt->patient->name }}</td>
                <td class="px-4 py-3">Dr. {{ $apt->doctor->user->name }}</td>
                <td class="px-4 py-3">
                    {{ \Carbon\Carbon::parse($apt->appointment_date)->format('M d, Y') }}
                    <br>
                    <span class="text-gray-400">{{ date('h:i A', strtotime($apt->appointment_time)) }}</span>
                </td>
                <td class="px-4 py-3">
                    @if($apt->payment)
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $apt->payment->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($apt->payment->status) }}
                        </span>
                    @else
                        <span class="text-gray-400 text-xs">No payment</span>
                    @endif
                </td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                        @if($apt->status === 'confirmed') bg-green-100 text-green-700
                        @elseif($apt->status === 'pending') bg-yellow-100 text-yellow-700
                        @elseif($apt->status === 'cancelled') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-700 @endif">
                        {{ ucfirst($apt->status) }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex gap-1 flex-wrap">
                        @if($apt->status !== 'confirmed')
                        <form method="POST" action="{{ route('admin.appointments.status', [$apt->id, 'confirmed']) }}">
                            @csrf
                            <button class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded hover:bg-green-200">
                                Confirm
                            </button>
                        </form>
                        @endif
                        @if($apt->status !== 'cancelled')
                        <form method="POST" action="{{ route('admin.appointments.status', [$apt->id, 'cancelled']) }}">
                            @csrf
                            <button class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded hover:bg-red-200">
                                Cancel
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

<div class="mt-4">{{ $appointments->links() }}</div>

@endsection