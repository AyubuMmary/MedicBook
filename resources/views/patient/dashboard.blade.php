@extends('layouts.app')
@section('title', __('messages.dashboard'))
@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Welcome Header -->
    <div class="rounded-3xl p-8 mb-8 text-white relative overflow-hidden"
         style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #4f46e5 100%);">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full flex items-center justify-center font-black text-2xl shadow-lg"
                     style="background: linear-gradient(135deg, #fde68a, #f59e0b); color: #1e3a8a;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-blue-200 text-sm font-medium">{{ __('messages.welcome_back') }},</p>
                    <h1 class="text-3xl font-black" style="font-family:'Poppins',sans-serif;">
                        {{ auth()->user()->name }}! 👋
                    </h1>
                    <p class="text-blue-200 text-sm mt-1">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>
            <a href="{{ route('doctors.index') }}"
               class="flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-blue-900 shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl"
               style="background: linear-gradient(135deg, #fde68a, #f59e0b);">
                📅 {{ __('messages.book_new') }}
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-blue-500 hover:shadow-lg transition">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">{{ __('messages.total_appointments') }}</p>
                    <p class="text-4xl font-black text-blue-700 mt-1">{{ $totalAppointments }}</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-3xl">📅</div>
            </div>
            <a href="{{ route('appointments.my') }}" class="text-blue-600 text-xs font-semibold mt-3 block hover:underline">
                {{ __('messages.view_all') }}
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-green-500 hover:shadow-lg transition">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">{{ __('messages.confirmed') }}</p>
                    <p class="text-4xl font-black text-green-600 mt-1">{{ $confirmedAppointments }}</p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center text-3xl">✅</div>
            </div>
            <p class="text-green-600 text-xs font-semibold mt-3">
                {{ app()->getLocale() === 'sw' ? 'Imewekwa vizuri' : 'Successfully booked' }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-yellow-500 hover:shadow-lg transition">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">{{ __('messages.pending') }}</p>
                    <p class="text-4xl font-black text-yellow-600 mt-1">{{ $pendingAppointments }}</p>
                </div>
                <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center text-3xl">⏳</div>
            </div>
            <p class="text-yellow-600 text-xs font-semibold mt-3">
                {{ app()->getLocale() === 'sw' ? 'Inasubiri malipo' : 'Awaiting confirmation' }}
            </p>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT: Recent Appointments -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 text-lg">📋 {{ __('messages.recent_appointments') }}</h3>
                    <a href="{{ route('appointments.my') }}"
                       class="text-blue-600 text-sm font-semibold hover:underline">
                        {{ __('messages.view_all') }}
                    </a>
                </div>

                @if($appointments->isEmpty())
                    <div class="text-center py-12">
                        <div class="text-6xl mb-3">📅</div>
                        <p class="text-gray-500 font-medium">{{ __('messages.no_appointments') }}</p>
                        <p class="text-gray-400 text-sm mt-1">{{ __('messages.book_first') }}</p>
                        <a href="{{ route('doctors.index') }}"
                           class="mt-4 inline-block px-6 py-2.5 rounded-xl font-bold text-white text-sm"
                           style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                            {{ __('messages.book_now') }}
                        </a>
                    </div>
                @else
                    <div class="divide-y divide-gray-50">
                        @foreach($appointments as $apt)
                        <div class="px-6 py-4 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex items-center gap-3">
                                    <!-- Doctor Avatar -->
                                    @if($apt->doctor && $apt->doctor->photo)
                                        <img src="{{ asset('storage/'.$apt->doctor->photo) }}"
                                             class="w-12 h-12 rounded-full object-cover border-2 border-blue-100">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-2xl">
                                            👨‍⚕️
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-gray-800">
                                            @if($apt->doctor && $apt->doctor->user)
                                                {{ str_starts_with($apt->doctor->user->name, 'Dr.') ? $apt->doctor->user->name : 'Dr. '.$apt->doctor->user->name }}
                                            @endif
                                        </p>
                                        <p class="text-blue-600 text-xs">
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
                                    <p class="font-mono text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-lg mb-2">
                                        {{ $apt->appointment_id }}
                                    </p>
                                    <!-- Status Badge -->
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($apt->status === 'confirmed') bg-green-100 text-green-700
                                        @elseif($apt->status === 'pending') bg-yellow-100 text-yellow-700
                                        @elseif($apt->status === 'cancelled') bg-red-100 text-red-700
                                        @else bg-gray-100 text-gray-600 @endif">
                                        @if($apt->status === 'confirmed') ✅ {{ __('messages.confirmed') }}
                                        @elseif($apt->status === 'pending') ⏳ {{ __('messages.pending') }}
                                        @elseif($apt->status === 'cancelled') ❌ {{ app()->getLocale() === 'sw' ? 'Imefutwa' : 'Cancelled' }}
                                        @else 🏁 {{ ucfirst($apt->status) }}
                                        @endif
                                    </span>
                                    <!-- Payment Status -->
                                    @if($apt->payment)
                                        <p class="text-xs mt-1 {{ $apt->payment->status === 'paid' ? 'text-green-600' : 'text-red-500' }} font-semibold">
                                            💳 {{ $apt->payment->status === 'paid'
                                                    ? (app()->getLocale() === 'sw' ? 'Imelipwa' : 'Paid')
                                                    : (app()->getLocale() === 'sw' ? 'Haijalipiwa' : 'Unpaid') }}
                                        </p>
                                    @else
                                        @if($apt->status !== 'cancelled')
                                        <a href="{{ route('payment.create', $apt->id) }}"
                                           class="text-xs text-red-500 font-semibold hover:underline mt-1 block">
                                            💳 {{ __('messages.pay_now') }}
                                        </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <!-- Action Buttons -->
                            <div class="mt-3 flex gap-2">
                                <a href="{{ route('appointments.show', $apt->id) }}"
                                   class="text-xs bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg hover:bg-blue-100 font-semibold transition">
                                    👁️ {{ __('messages.view_details') }}
                                </a>
                                @if(in_array($apt->status, ['pending', 'confirmed']))
                                <form method="POST" action="{{ route('appointments.cancel', $apt->id) }}">
                                    @csrf
                                    <button type="submit"
                                            onclick="return confirm('{{ app()->getLocale() === 'sw' ? 'Je, una uhakika wa kufuta miadi hii?' : 'Cancel this appointment?' }}')"
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
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-bold text-gray-800 text-lg mb-4">{{ __('messages.quick_actions') }}</h3>
                <div class="space-y-3">
                    <a href="{{ route('doctors.index') }}"
                       class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 transition group">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-xl group-hover:bg-blue-200 transition">
                            🔍
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">{{ __('messages.find_a_doctor') }}</p>
                            <p class="text-gray-400 text-xs">{{ __('messages.browse_specialists') }}</p>
                        </div>
                        <span class="ml-auto text-gray-400">→</span>
                    </a>

                    <a href="{{ route('appointments.my') }}"
                       class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-50 transition group">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center text-xl group-hover:bg-green-200 transition">
                            📋
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">{{ __('messages.my_appointments') }}</p>
                            <p class="text-gray-400 text-xs">{{ __('messages.view_all_bookings') }}</p>
                        </div>
                        <span class="ml-auto text-gray-400">→</span>
                    </a>

                    @if($pendingAppointments > 0)
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3">
                        <p class="text-yellow-700 text-sm font-semibold">
                            ⚠️ {{ app()->getLocale() === 'sw'
                                ? 'Una miadi '.$pendingAppointments.' inayosubiri malipo'
                                : 'You have '.$pendingAppointments.' pending payment(s)' }}
                        </p>
                        <a href="{{ route('appointments.my') }}"
                           class="text-yellow-600 text-xs hover:underline font-medium">
                            {{ __('messages.complete_payment') }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- How to Book -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-bold text-gray-800 text-lg mb-4">{{ __('messages.how_to_book') }}</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0"
                             style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                            1
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700 text-sm">{{ __('messages.step1_title') }}</p>
                            <p class="text-gray-400 text-xs">{{ __('messages.step1_desc') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0"
                             style="background: linear-gradient(135deg, #059669, #10b981);">
                            2
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700 text-sm">{{ __('messages.step2_title') }}</p>
                            <p class="text-gray-400 text-xs">{{ __('messages.step2_desc') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0"
                             style="background: linear-gradient(135deg, #d97706, #f59e0b);">
                            3
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700 text-sm">{{ __('messages.step3_title') }}</p>
                            <p class="text-gray-400 text-xs">{{ __('messages.step3_desc') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0"
                             style="background: linear-gradient(135deg, #7c3aed, #a855f7);">
                            4
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700 text-sm">{{ __('messages.appointment_id') }}</p>
                            <p class="text-gray-400 text-xs">{{ __('messages.show_id_at_hospital') }}</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('doctors.index') }}"
                   class="mt-5 block w-full text-center py-3 rounded-xl font-bold text-white text-sm shadow transition hover:-translate-y-0.5"
                   style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                    📅 {{ __('messages.book_now') }}
                </a>
            </div>

        </div>
    </div>

    <!-- Available Doctors Section -->
    <div class="mt-8">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-2xl font-bold text-gray-800" style="font-family:'Poppins',sans-serif;">
                {{ __('messages.available_doctors') }}
            </h3>
            <a href="{{ route('doctors.index') }}"
               class="text-blue-600 font-semibold text-sm hover:underline">
                {{ __('messages.view_all_doctors') }}
            </a>
        </div>

        @if($doctors->isEmpty())
            <div class="bg-white rounded-2xl shadow p-10 text-center">
                <p class="text-6xl mb-3">👨‍⚕️</p>
                <p class="text-gray-500">{{ __('messages.no_doctors_yet') }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($doctors as $doctor)
                @if(!$doctor->user) @continue @endif
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition-all duration-300 overflow-hidden group">
                    <!-- Card Header -->
                    <div class="h-20 relative"
                         style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                        <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2">
                            @if($doctor->photo)
                                <img src="{{ asset('storage/'.$doctor->photo) }}"
                                     class="w-16 h-16 rounded-full border-4 border-white object-cover shadow-lg">
                            @else
                                <div class="w-16 h-16 rounded-full border-4 border-white bg-blue-100 flex items-center justify-center text-3xl shadow-lg">
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
                        <p class="text-blue-600 text-sm font-semibold">{{ $doctor->specialization }}</p>
                        <p class="text-gray-400 text-xs mt-0.5">{{ $doctor->qualification }}</p>

                        @if($doctor->experience)
                            <p class="text-gray-400 text-xs mt-1">
                                ⭐ {{ $doctor->experience }}
                                {{ $doctor->experience == 1 ? __('messages.year') : __('messages.years') }}
                                {{ __('messages.experience') }}
                            </p>
                        @endif

                        <div class="flex justify-center gap-2 mt-3">
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-semibold">
                                ✅ {{ __('messages.available') }}
                            </span>
                            <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-semibold">
                                TSh {{ number_format($doctor->consultation_fee) }}
                            </span>
                        </div>

                        <a href="{{ route('appointments.create', $doctor->id) }}"
                           class="mt-4 block w-full py-2.5 rounded-xl font-bold text-white text-sm transition hover:-translate-y-0.5 hover:shadow-lg"
                           style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
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
