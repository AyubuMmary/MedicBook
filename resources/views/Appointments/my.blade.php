@extends('layouts.app')
@section('title', 'My Appointments')
@section('content')

<h2 class="text-3xl font-bold mb-6">My Appointments</h2>

@if($appointments->isEmpty())
    <div class="text-center py-16 text-gray-500">
        <p class="text-6xl mb-4">📅</p>
        <p class="text-xl">No appointments yet.</p>
        <a href="{{ route('doctors.index') }}" class="mt-4 inline-block bg-blue-700 text-white px-6 py-2 rounded-full">Book Now</a>
    </div>
@else
    <div class="space-y-4">
        @foreach($appointments as $apt)
        <div class="bg-white shadow rounded-xl p-6 flex justify-between items-center">
            <div>
                <p class="font-mono text-blue-600 font-bold">{{ $apt->appointment_id }}</p>
                <p class="font-semibold text-lg">Dr. {{ $apt->doctor->user->name }} — {{ $apt->doctor->specialization }}</p>
                <p class="text-gray-500">{{ \Carbon\Carbon::parse($apt->appointment_date)->format('M d, Y') }} at {{ date('h:i A', strtotime($apt->appointment_time)) }}</p>
            </div>
            <div class="text-right">
                <span class="px-3 py-1 rounded-full text-sm font-semibold
                    @if($apt->status === 'confirmed') bg-green-100 text-green-700
                    @elseif($apt->status === 'pending') bg-yellow-100 text-yellow-700
                    @elseif($apt->status === 'cancelled') bg-red-100 text-red-700
                    @else bg-gray-100 text-gray-700 @endif">
                    {{ ucfirst($apt->status) }}
                </span>
                <div class="mt-2">
                    @if($apt->payment?->status !== 'paid' && $apt->status !== 'cancelled')
                        <a href="{{ route('payment.create', $apt->id) }}" class="text-sm text-red-600 hover:underline mr-2">Pay Now</a>
                    @endif
                    <a href="{{ route('appointments.show', $apt->id) }}" class="text-sm text-blue-600 hover:underline">View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $appointments->links() }}</div>
@endif
@endsection