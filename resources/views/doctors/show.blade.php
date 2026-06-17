@extends('layouts.app')
@section('title', 'Dr. '.$doctor->user->name)
@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow p-8">

        <div class="flex flex-col md:flex-row gap-8 items-center md:items-start mb-6">
            @if($doctor->photo)
                <img src="{{ asset('storage/'.$doctor->photo) }}"
                     class="w-36 h-36 rounded-full object-cover border-4 border-blue-100">
            @else
                <div class="w-36 h-36 rounded-full bg-blue-100 flex items-center justify-center text-6xl">
                    👨‍⚕️
                </div>
            @endif

            <div>
                <h1 class="text-3xl font-bold text-gray-800">Dr. {{ $doctor->user->name }}</h1>
                <p class="text-blue-600 text-lg font-semibold mt-1">{{ $doctor->specialization }}</p>
                <p class="text-gray-500">{{ $doctor->qualification }}</p>
                <div class="mt-3 flex items-center gap-2">
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                        ✅ Available
                    </span>
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                        💰 TSh {{ number_format($doctor->consultation_fee) }}
                    </span>
                </div>
            </div>
        </div>

        @if($doctor->bio)
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="font-bold text-lg mb-2 text-gray-700">About Doctor</h3>
            <p class="text-gray-600 leading-relaxed">{{ $doctor->bio }}</p>
        </div>
        @endif

        <div class="bg-blue-50 rounded-lg p-4 mb-6">
            <h3 class="font-bold text-lg mb-3 text-blue-700">Appointment Info</h3>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="flex items-center gap-2">
                    <span>🕐</span>
                    <span class="text-gray-600">Available: 9AM - 5PM</span>
                </div>
                <div class="flex items-center gap-2">
                    <span>📅</span>
                    <span class="text-gray-600">Mon - Sat</span>
                </div>
                <div class="flex items-center gap-2">
                    <span>💰</span>
                    <span class="text-gray-600">Fee: ${{ $doctor->consultation_fee }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span>⏱️</span>
                    <span class="text-gray-600">Duration: 30 mins</span>
                </div>
            </div>
        </div>

        @auth
            <a href="{{ route('appointments.create', $doctor->id) }}"
               class="block w-full text-center bg-blue-700 text-white py-3 rounded-xl text-lg font-semibold hover:bg-blue-800 transition">
                📅 Book Appointment Now
            </a>
        @else
            <div class="text-center">
                <p class="text-gray-500 mb-3">Please login to book an appointment</p>
                <a href="{{ route('login') }}"
                   class="inline-block bg-blue-700 text-white px-8 py-3 rounded-xl text-lg font-semibold hover:bg-blue-800 transition">
                    Login to Book
                </a>
            </div>
        @endauth
    </div>

    <div class="mt-4">
        <a href="{{ route('doctors.index') }}" class="text-blue-600 hover:underline">← Back to Doctors</a>
    </div>
</div>

@endsection
