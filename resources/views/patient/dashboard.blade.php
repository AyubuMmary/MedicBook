@extends('layouts.app')
@section('title', __('messages.dashboard'))
@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Welcome Header - Ocean Breeze -->
    <div class="rounded-3xl p-8 mb-8 text-white relative overflow-hidden"
         style="background: linear-gradient(135deg, #4BB8F0 0%, #7FCDFF 50%, #4BB8F0 100%);">
        <!-- Decorations -->
        <div class="absolute top-0 right-0 w-64 h-64 rounded-full opacity-20"
             style="background: radial-gradient(circle, #DFF7FF, transparent); transform: translate(30%,-30%);"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 rounded-full opacity-20"
             style="background: radial-gradient(circle, #DFF7FF, transparent); transform: translate(-30%,30%);"></div>

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="flex items-center gap-4">
                <!-- Avatar -->
                <div class="w-16 h-16 rounded-full flex items-center justify-center font-black text-2xl shadow-lg"
                     style="background: rgba(255,255,255,0.3); border: 3px solid rgba(255,255,255,0.5); color: white;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-medium" style="color: #DFF7FF;">
                        {{ __('messages.welcome_back') }},
                    </p>
                    <h1 class="text-3xl font-black text-white" style="font-family:'Poppins',sans-serif;">
                        {{ auth()->user()->name }}! 👋
                    </h1>
                    <p class="text-sm mt-1" style="color: #DFF7FF;">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>
            <!-- Book Button -->
            <a href="{{ route('doctors.index') }}"
               class="flex items-center gap-2 px-6 py-3 rounded-xl font-bold shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl"
               style="background: linear-gradient(135deg, #059669, #10b981); color: white;">
                📅 {{ __('messages.book_new') }}
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

        <!-- Total Appointments -->
        <div class="rounded-2xl p-6 shadow-md hover:-translate-y-1 transition"
             style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border-left: 4px solid #4BB8F0; border: 1px solid rgba(127,205,255,0.3); border-left: 4px solid #4BB8F0;">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500">{{ __('messages.total_appointments') }}</p>
                    <p class="text-4xl font-black mt-1" style="color: #1A8FCC;">{{ $totalAppointments }}</p>
                </div>
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl"
                     style="background: #DFF7FF;">
                    📅
                </div>
            </div>
            <a href="{{ route('appointments.my') }}"
               class="text-xs font-semibold mt-3 block hover:underline"
               style="color: #1A8FCC;">
                {{ __('messages.view_all') }}
            </a>
        </div>

        <!-- Confirmed -->
        <div class="rounded-2xl p-6 shadow-md hover:-translate-y-1 transition"
             style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border: 1px solid rgba(127,205,255,0.3); border-left: 4px solid #10b981;">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500">{{ __('messages.confirmed') }}</p>
                    <p class="text-4xl font-black text-green-600 mt-1">{{ $confirmedAppointments }}</p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center text-3xl">
                    ✅
                </div>
            </div>
            <p class="text-green-600 text-xs font-semibold mt-3">
                {{ app()->getLocale() === 'sw' ? 'Imefanikiwa kuwekwa' : 'Successfully booked' }}
            </p>
        </div>

        <!-- Pending -->
        <div class="rounded-2xl p-6 shadow-md hover:-translate-y-1 transition"
             style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border: 1px solid rgba(127,205,255,0.3); border-left: 4px solid #6ee7b7;">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500">{{ __('messages.pending') }}</p>
                    <p class="text-4xl font-black mt-1" style="color: #059669;">{{ $pendingAppointments }}</p>
                </div>
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl"
                     style="background: #d1fae5;">
                    ⏳
                </div>
            </div>
            <p class="text-xs font-semibold mt-3" style="color: #059669;">
                {{ app()->getLocale() === 'sw' ? 'Inasubiri uthibitisho' : 'Awaiting confirmation' }}
            </p>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT: Recent Appointments -->
        <div class="lg:col-span-2">
            <div class="rounded-2xl shadow-md overflow-hidden"
                 style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border: 1px solid rgba(127,205,255,0.3);">
                <div class="px-6 py-4 flex justify-between items-center"
                     style="border-bottom: 1px solid rgba(127,205,255,0.3);">
                    <h3 class="font-bold text-lg" style="color: #0e6fa3;">
                        {{ __('messages.recent_appointments') }}
                    </h3>
                    <a href="{{ route('appointments.my') }}"
                       class="text-sm font-semibold hover:underline"
                       style="color: #4BB8F0;">
                        {{ __('messages.view_all') }}
                    </a>
                </div>

                @if($appointments->isEmpty())
                    <div class="text-center py-12">
                        <div class="text-6xl mb-3">📅</div>
                        <p class="font-medium text-gray-500">{{ __('messages.no_appointments') }}</p>
                        <p class="text-gray-400 text-sm mt-1">{{ __('messages.book_first') }}</p>
                        <a href="{{ route('doctors.index') }}"
                           class="mt-4 inline-block px-6 py-2.5 rounded-xl font-bold text-sm text-white shadow transition hover:-translate-y-0.5"
                           style="background: linear-gradient(135deg, #4BB8F0, #1A8FCC);">
                            {{ __('messages.book_now') }}
                        </a>
                    </div>
                @else
                    <div class="divide-y" style="divide-color: rgba(127,205,255,0.2);">
                        @foreach($appointments as $apt)
                        <div class="px-6 py-4 hover:bg-white/50 transition">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex items-center gap-3">
                                    <!-- Doctor Photo -->
                                    @if($apt->doctor && $apt->doctor->photo)
                                        <img src="{{ asset('storage/'.$apt->doctor->photo) }}"
                                             class="w-12 h-12 rounded-full object-cover"
                                             style="border: 2px solid #7FCDFF;">
                                    @else
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-2xl"
                                             style="background: #DFF7FF;">
                                            👨‍⚕️
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-gray-800">
                                            @if($apt->doctor && $apt->doctor->user)
                                                {{ str_starts_with($apt->doctor->user->name, 'Dr.') ? $apt->doctor->user->name : 'Dr. '.$apt->doctor->user->name }}
                                            @endif
                                        </p>
                                        <p class="text-xs font-semibold" style="color: #4BB8F0;">
                                            {{ $apt->doctor->specialization ?? '' }}
                                        </p>
                                        <p class="text-gray-400 text-xs mt-0.5">
                                            📅 {{ \Carbon\Carbon::parse($apt->appointment_date)->format('M d, Y') }}
                                            🕐 {{ date('h:i A', strtotime($apt->appointment_time)) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <!-- Appointment ID -->
                                    <p class="font-mono text-xs font-bold px-2 py-1 rounded-lg mb-2"
                                       style="background: #DFF7FF; color: #1A8FCC;">
                                        {{ $apt->appointment_id }}
                                    </p>
                                    <!-- Status Badge -->
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($apt->status === 'confirmed') bg-green-100 text-green-700
                                        @elseif($apt->status === 'pending') bg-blue-100 text-blue-700
                                        @elseif($apt->status === 'cancelled') bg-red-100 text-red-700
                                        @else bg-gray-100 text-gray-600 @endif">
                                        @if($apt->status === 'confirmed') ✅ {{ app()->getLocale() === 'sw' ? 'Imethibitishwa' : 'Confirmed' }}
                                        @elseif($apt->status === 'pending') ⏳ {{ app()->getLocale() === 'sw' ? 'Inasubiri' : 'Pending' }}
                                        @elseif($apt->status === 'cancelled') ❌ {{ app()->getLocale() === 'sw' ? 'Imefutwa' : 'Cancelled' }}
                                        @else 🏁 {{ ucfirst($apt->status) }}
                                        @endif
                                    </span>
                                    <!-- Payment Status -->
                                    @if($apt->payment)
                                        <p class="text-xs mt-1 {{ $apt->payment->status === 'paid' ? 'text-green-600' : 'text-red-500' }} font-semibold">
                                            💳 {{ ucfirst($apt->payment->status) }}
                                        </p>
                                    @else
                                        @if($apt->status !== 'cancelled')
                                        <a href="{{ route('payment.create', $apt->id) }}"
                                           class="text-xs font-semibold hover:underline mt-1 block text-red-500">
                                            💳 {{ __('messages.pay_now_btn') }}
                                        </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <!-- Action Buttons -->
                            <div class="mt-3 flex gap-2">
                                <a href="{{ route('appointments.show', $apt->id) }}"
                                   class="text-xs px-3 py-1.5 rounded-lg font-semibold transition hover:-translate-y-0.5"
                                   style="background: #DFF7FF; color: #1A8FCC;">
                                    👁️ {{ __('messages.view_details') }}
                                </a>
                                @if(in_array($apt->status, ['pending', 'confirmed']))
                                <form method="POST" action="{{ route('appointments.cancel', $apt->id) }}">
                                    @csrf
                                    <button type="submit"
                                            onclick="return confirm('{{ app()->getLocale() === "sw" ? "Una uhakika unataka kufuta miadi hii?" : "Cancel this appointment?" }}')"
                                            class="text-xs bg-red-50 text-red-700 px-3 py-1.5 rounded-lg hover:bg-red-100 font-semibold transition">
                                        ❌ {{ __('messages.cancel_btn') }}
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- RIGHT: Quick Actions + How to Book -->
        <div class="space-y-6">

            <!-- Quick Actions -->
            <div class="rounded-2xl shadow-md p-6"
                 style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border: 1px solid rgba(127,205,255,0.3);">
                <h3 class="font-bold text-lg mb-4" style="color: #0e6fa3;">
                    {{ __('messages.quick_actions') }}
                </h3>
                <div class="space-y-3">

                    <a href="{{ route('doctors.index') }}"
                       class="flex items-center gap-3 p-3 rounded-xl transition group hover:-translate-y-0.5"
                       style="background: #DFF7FF;">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl"
                             style="background: rgba(75,184,240,0.2);">
                            🔍
                        </div>
                        <div>
                            <p class="font-semibold text-sm" style="color: #0e6fa3;">
                                {{ __('messages.find_a_doctor') }}
                            </p>
                            <p class="text-gray-400 text-xs">{{ __('messages.browse_specialists') }}</p>
                        </div>
                        <span class="ml-auto" style="color: #4BB8F0;">→</span>
                    </a>

                    <a href="{{ route('appointments.my') }}"
                       class="flex items-center gap-3 p-3 rounded-xl transition group hover:-translate-y-0.5"
                       style="background: #d1fae5;">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl bg-green-200">
                            📋
                        </div>
                        <div>
                            <p class="font-semibold text-sm text-green-800">
                                {{ __('messages.my_appointments') }}
                            </p>
                            <p class="text-gray-400 text-xs">{{ __('messages.view_all_bookings') }}</p>
                        </div>
                        <span class="ml-auto text-green-600">→</span>
                    </a>

                    @if($pendingAppointments > 0)
                    <div class="rounded-xl p-3"
                         style="background: #DFF7FF; border: 1px solid rgba(127,205,255,0.5);">
                        <p class="text-sm font-semibold" style="color: #1A8FCC;">
                            ⚠️ {{ __('messages.pending_payments') }}
                        </p>
                        <a href="{{ route('appointments.my') }}"
                           class="text-xs font-medium hover:underline"
                           style="color: #4BB8F0;">
                            {{ __('messages.complete_payment') }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- How to Book -->
            <div class="rounded-2xl shadow-md p-6"
                 style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border: 1px solid rgba(127,205,255,0.3);">
                <h3 class="font-bold text-lg mb-4" style="color: #0e6fa3;">
                    {{ __('messages.how_to_book') }}
                </h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0"
                             style="background: linear-gradient(135deg, #4BB8F0, #1A8FCC);">
                            1
                        </div>
                        <div>
                            <p class="font-semibold text-sm" style="color: #0e6fa3;">
                                {{ __('messages.find_a_doctor') }}
                            </p>
                            <p class="text-gray-400 text-xs">{{ __('messages.browse_specialists') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0"
                             style="background: linear-gradient(135deg, #059669, #10b981);">
                            2
                        </div>
                        <div>
                            <p class="font-semibold text-sm text-green-800">
                                {{ __('messages.select_date') }}
                            </p>
                            <p class="text-gray-400 text-xs">
                                {{ app()->getLocale() === 'sw' ? 'Chagua wakati unaokufaa' : 'Choose your preferred slot' }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0"
                             style="background: linear-gradient(135deg, #7FCDFF, #4BB8F0);">
                            3
                        </div>
                        <div>
                            <p class="font-semibold text-sm" style="color: #0e6fa3;">
                                {{ app()->getLocale() === 'sw' ? 'Lipa Mtandaoni' : 'Pay Online' }}
                            </p>
                            <p class="text-gray-400 text-xs">
                                {{ app()->getLocale() === 'sw' ? 'Malipo salama ya simu' : 'Secure mobile payment' }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0"
                             style="background: linear-gradient(135deg, #DFF7FF, #7FCDFF);">
                            <span style="color: #1A8FCC;">4</span>
                        </div>
                        <div>
                            <p class="font-semibold text-sm" style="color: #0e6fa3;">
                                {{ __('messages.appointment_id_label') }}
                            </p>
                            <p class="text-gray-400 text-xs">
                                {{ app()->getLocale() === 'sw' ? 'Onyesha hospitali' : 'Show at hospital' }}
                            </p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('doctors.index') }}"
                   class="mt-5 block w-full text-center py-3 rounded-xl font-bold text-sm text-white shadow transition hover:-translate-y-0.5"
                   style="background: linear-gradient(135deg, #4BB8F0, #1A8FCC);">
                    📅 {{ __('messages.book_now') }}
                </a>
            </div>

        </div>
    </div>

    <!-- Available Doctors Section -->
    <div class="mt-8">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-2xl font-bold" style="font-family:'Poppins',sans-serif; color: #0e6fa3;">
                {{ __('messages.available_doctors') }}
            </h3>
            <a href="{{ route('doctors.index') }}"
               class="text-sm font-semibold hover:underline"
               style="color: #4BB8F0;">
                {{ __('messages.view_all') }}
            </a>
        </div>

        @if($doctors->isEmpty())
            <div class="rounded-2xl shadow p-10 text-center"
                 style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px);">
                <p class="text-6xl mb-3">👨‍⚕️</p>
                <p class="text-gray-500">{{ __('messages.no_doctors') }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($doctors as $doctor)
                @if(!$doctor->user) @continue @endif
                <div class="rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group hover:-translate-y-1"
                     style="background: rgba(255,255,255,0.8); backdrop-filter: blur(10px); border: 1px solid rgba(127,205,255,0.3);">

                    <!-- Card Header - Ocean Breeze -->
                    <div class="h-20 relative"
                         style="background: linear-gradient(135deg, #7FCDFF, #4BB8F0);">
                        <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2">
                            @if($doctor->photo)
                                <img src="{{ asset('storage/'.$doctor->photo) }}"
                                     class="w-16 h-16 rounded-full border-4 border-white object-cover shadow-lg">
                            @else
                                <div class="w-16 h-16 rounded-full border-4 border-white flex items-center justify-center text-3xl shadow-lg"
                                     style="background: #DFF7FF;">
                                    {{ $doctor->gender === 'female' ? '👩‍⚕️' : '👨‍⚕️' }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="pt-10 pb-5 px-5 text-center">
                        <h4 class="font-bold text-gray-800">
                            {{ str_starts_with($doctor->user->name, 'Dr.') ? $doctor->user->name : 'Dr. '.$doctor->user->name }}
                        </h4>
                        <p class="text-sm font-semibold" style="color: #1A8FCC;">
                            {{ $doctor->specialization }}
                        </p>
                        <p class="text-gray-400 text-xs mt-0.5">{{ $doctor->qualification }}</p>
                        @if($doctor->experience)
                            <p class="text-gray-400 text-xs mt-1">
                                ⭐ {{ $doctor->experience }} {{ __('messages.years') }} {{ __('messages.experience') }}
                            </p>
                        @endif
                        <div class="flex justify-center gap-2 mt-3">
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-semibold">
                                ✅ {{ __('messages.available') }}
                            </span>
                            <span class="text-xs px-2 py-1 rounded-full font-semibold"
                                  style="background: #DFF7FF; color: #1A8FCC;">
                                TSh {{ number_format($doctor->consultation_fee) }}
                            </span>
                        </div>
                        <a href="{{ route('appointments.create', $doctor->id) }}"
                           class="mt-4 block w-full py-2.5 rounded-xl font-bold text-white text-sm transition hover:-translate-y-0.5 hover:shadow-lg"
                           style="background: linear-gradient(135deg, #4BB8F0, #1A8FCC);">
                            📅 {{ __('messages.book_appointment') }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

@endsection