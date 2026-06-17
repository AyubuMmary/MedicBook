@extends('layouts.app')
@section('title', 'Book Appointment')
@section('content')

<div class="max-w-2xl mx-auto bg-white shadow rounded-xl p-8">
    <h2 class="text-2xl font-bold mb-6">Book Appointment with Dr. {{ $doctor->user->name }}</h2>
    <p class="text-blue-600 mb-6">{{ $doctor->specialization }} — <span class="text-green-600 font-bold">TSh {{ number_format($doctor->consultation_fee) }}</span></p>

    <form method="POST" action="{{ route('appointments.store') }}">
        @csrf
        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

        <div class="mb-4">
            <label class="block font-semibold mb-1">Appointment Date</label>
            <input type="date" name="appointment_date" min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                   class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                   value="{{ old('appointment_date') }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Appointment Time</label>
            <select name="appointment_time" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                <option value="">-- Select Time --</option>
                @foreach(['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30'] as $time)
                    <option value="{{ $time }}">{{ date('h:i A', strtotime($time)) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-1">Symptoms (optional)</label>
            <textarea name="symptoms" rows="3"
                      class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                      placeholder="Describe your symptoms...">{{ old('symptoms') }}</textarea>
        </div>

        <button type="submit" class="w-full bg-blue-700 text-white py-3 rounded-xl font-semibold text-lg hover:bg-blue-800">
            Confirm Appointment & Proceed to Payment
        </button>
    </form>
</div>
@endsection