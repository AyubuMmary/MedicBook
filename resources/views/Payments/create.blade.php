@extends('layouts.app')
@section('title', __('messages.complete_payment'))
@section('content')

<div class="max-w-2xl mx-auto">

    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-black text-gray-800" style="font-family:'Poppins',sans-serif;">
            💳 {{ __('messages.complete_payment') }}
        </h2>
        <p class="text-gray-500 mt-2">{{ __('messages.pay_securely') }}</p>
    </div>

    <!-- Appointment Summary Card -->
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-200 p-6 mb-6">
        <h3 class="font-bold text-blue-800 mb-4 text-lg flex items-center gap-2">
            📋 {{ __('messages.apt_summary') }}
        </h3>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">
                    {{ __('messages.appointment_id_label') }}
                </p>
                <p class="font-mono font-bold text-blue-700 text-base mt-0.5">
                    {{ $appointment->appointment_id }}
                </p>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">
                    {{ __('messages.doctor') }}
                </p>
                <p class="font-bold text-gray-800 mt-0.5">
                    @if($appointment->doctor && $appointment->doctor->user)
                        {{ str_starts_with($appointment->doctor->user->name, 'Dr.') ? $appointment->doctor->user->name : 'Dr. '.$appointment->doctor->user->name }}
                    @endif
                </p>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">
                    {{ __('messages.date') }}
                </p>
                <p class="font-bold text-gray-800 mt-0.5">
                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}
                </p>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">
                    {{ __('messages.time') }}
                </p>
                <p class="font-bold text-gray-800 mt-0.5">
                    {{ date('h:i A', strtotime($appointment->appointment_time)) }}
                </p>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-blue-200 flex justify-between items-center">
            <p class="text-gray-600 font-medium">{{ __('messages.consultation_fee') }}</p>
            <p class="text-2xl font-black text-green-600">
                TSh {{ number_format($appointment->doctor->consultation_fee) }}
            </p>
        </div>
    </div>

    <!-- Mobile Money Payment Form -->
    <div class="bg-white rounded-2xl shadow-lg p-6">

        <h3 class="font-bold text-gray-800 text-lg mb-5">
            📱 {{ __('messages.select_network') }}
        </h3>

        <!-- Network Selection -->
        <div class="grid grid-cols-2 gap-3 mb-6">

            <!-- Vodacom M-Pesa -->
            <label class="relative cursor-pointer">
                <input type="radio" name="network" value="vodacom" class="sr-only peer" checked>
                <div class="border-2 border-gray-200 rounded-2xl p-4 text-center transition peer-checked:border-red-500 peer-checked:bg-red-50 hover:border-red-300">
                    <div class="w-16 h-16 mx-auto mb-2 rounded-full flex items-center justify-center font-black text-white text-xl shadow"
                         style="background: linear-gradient(135deg, #dc2626, #ef4444);">
                        M
                    </div>
                    <p class="font-bold text-gray-800 text-sm">Vodacom</p>
                    <p class="text-red-600 text-xs font-semibold">M-Pesa</p>
                </div>
                <div class="hidden peer-checked:flex absolute top-2 right-2 w-6 h-6 bg-red-500 rounded-full items-center justify-center shadow">
                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                </div>
            </label>

            <!-- Tigo Pesa -->
            <label class="relative cursor-pointer">
                <input type="radio" name="network" value="tigo" class="sr-only peer">
                <div class="border-2 border-gray-200 rounded-2xl p-4 text-center transition peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-blue-300">
                    <div class="w-16 h-16 mx-auto mb-2 rounded-full flex items-center justify-center font-black text-white text-xl shadow"
                         style="background: linear-gradient(135deg, #1d4ed8, #3b82f6);">
                        T
                    </div>
                    <p class="font-bold text-gray-800 text-sm">Tigo</p>
                    <p class="text-blue-600 text-xs font-semibold">Tigo Pesa</p>
                </div>
                <div class="hidden peer-checked:flex absolute top-2 right-2 w-6 h-6 bg-blue-500 rounded-full items-center justify-center shadow">
                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                </div>
            </label>

            <!-- Airtel Money -->
            <label class="relative cursor-pointer">
                <input type="radio" name="network" value="airtel" class="sr-only peer">
                <div class="border-2 border-gray-200 rounded-2xl p-4 text-center transition peer-checked:border-red-600 peer-checked:bg-red-50 hover:border-red-400">
                    <div class="w-16 h-16 mx-auto mb-2 rounded-full flex items-center justify-center font-black text-white text-xl shadow"
                         style="background: linear-gradient(135deg, #b91c1c, #dc2626);">
                        A
                    </div>
                    <p class="font-bold text-gray-800 text-sm">Airtel</p>
                    <p class="text-red-700 text-xs font-semibold">Airtel Money</p>
                </div>
                <div class="hidden peer-checked:flex absolute top-2 right-2 w-6 h-6 bg-red-600 rounded-full items-center justify-center shadow">
                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                </div>
            </label>

            <!-- Halotel -->
            <label class="relative cursor-pointer">
                <input type="radio" name="network" value="halotel" class="sr-only peer">
                <div class="border-2 border-gray-200 rounded-2xl p-4 text-center transition peer-checked:border-green-500 peer-checked:bg-green-50 hover:border-green-300">
                    <div class="w-16 h-16 mx-auto mb-2 rounded-full flex items-center justify-center font-black text-white text-xl shadow"
                         style="background: linear-gradient(135deg, #059669, #10b981);">
                        H
                    </div>
                    <p class="font-bold text-gray-800 text-sm">Halotel</p>
                    <p class="text-green-600 text-xs font-semibold">Halo Pesa</p>
                </div>
                <div class="hidden peer-checked:flex absolute top-2 right-2 w-6 h-6 bg-green-500 rounded-full items-center justify-center shadow">
                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                    </svg>
                </div>
            </label>

        </div>

        <!-- Phone Number Input -->
        <div class="mb-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                {{ __('messages.mobile_number') }} <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold text-sm border-r border-gray-300 pr-3">
                    +255
                </span>
                <input type="tel"
                       id="phone_number"
                       maxlength="9"
                       class="w-full pl-20 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition text-lg font-semibold bg-gray-50 focus:bg-white"
                       placeholder="712 345 678"
                       required>
            </div>
            <p class="text-gray-400 text-xs mt-1.5">
                {{ __('messages.enter_number') }}
            </p>
        </div>

        <!-- Instructions -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
            <h4 class="font-bold text-yellow-800 text-sm mb-3 flex items-center gap-2">
                📋 {{ __('messages.payment_instructions') }}
            </h4>
            <ol class="text-yellow-700 text-xs space-y-2 list-decimal list-inside">
                <li>{{ __('messages.instruction_1') }}</li>
                <li>{{ __('messages.instruction_2') }}</li>
                <li>{{ __('messages.instruction_3') }}</li>
                <li>{{ __('messages.instruction_4') }}</li>
                <li>{{ __('messages.instruction_5') }}</li>
                <li>{{ __('messages.instruction_6') }}</li>
            </ol>
        </div>

        <!-- Payment Summary -->
        <div class="bg-gray-50 rounded-xl p-4 mb-6 flex justify-between items-center border border-gray-100">
            <div>
                <p class="text-gray-500 text-sm">{{ __('messages.total_amount') }}</p>
                <p class="text-3xl font-black text-green-600 mt-1">
                    TSh {{ number_format($appointment->doctor->consultation_fee) }}
                </p>
            </div>
            <div class="text-right">
                <p class="text-gray-400 text-xs">{{ __('messages.appointment_id_label') }}</p>
                <p class="font-mono font-bold text-blue-600 text-sm mt-1">
                    {{ $appointment->appointment_id }}
                </p>
            </div>
        </div>

        <!-- Error Message -->
        <div id="payment-error"
             class="hidden bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4 text-sm flex items-center gap-2">
            <span>⚠️</span>
            <span id="error-text"></span>
        </div>

        <!-- Pay Button -->
        <button id="pay-btn"
                onclick="processPayment()"
                class="w-full py-4 rounded-xl font-black text-white text-lg shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl"
                style="background: linear-gradient(135deg, #059669, #10b981);">
            💳 {{ __('messages.pay_now') }} — TSh {{ number_format($appointment->doctor->consultation_fee) }}
        </button>

        <!-- Cancel Link -->
        <a href="{{ route('appointments.my') }}"
           class="block text-center text-gray-400 hover:text-gray-600 text-sm mt-4 transition">
            {{ __('messages.cancel_back') }}
        </a>

    </div>
</div>

<!-- Processing Modal -->
<div id="processing-modal"
     class="hidden fixed inset-0 bg-black/60 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl p-8 text-center max-w-sm w-full shadow-2xl">
        <div class="text-7xl mb-4 animate-bounce">📱</div>
        <h3 class="text-xl font-black text-gray-800 mb-2">
            {{ __('messages.processing_payment') }}
        </h3>
        <p class="text-gray-500 text-sm mb-2">
            {{ __('messages.payment_prompt') }}
        </p>
        <p class="text-gray-500 text-sm mb-6">
            {{ __('messages.enter_pin_msg') }}
        </p>

        <!-- Loading Dots -->
        <div class="flex justify-center gap-2 mb-4">
            <div class="w-3 h-3 bg-blue-500 rounded-full animate-bounce" style="animation-delay:0s"></div>
            <div class="w-3 h-3 bg-blue-500 rounded-full animate-bounce" style="animation-delay:0.2s"></div>
            <div class="w-3 h-3 bg-blue-500 rounded-full animate-bounce" style="animation-delay:0.4s"></div>
        </div>

        <div class="bg-red-50 border border-red-200 rounded-xl p-3">
            <p class="text-red-600 text-xs font-bold">
                ⚠️ {{ __('messages.do_not_close') }}
            </p>
        </div>
    </div>
</div>

<script>
function processPayment() {
    const phone     = document.getElementById('phone_number').value.trim();
    const network   = document.querySelector('input[name="network"]:checked');
    const errorDiv  = document.getElementById('payment-error');
    const errorText = document.getElementById('error-text');
    const btn       = document.getElementById('pay-btn');

    // Reset error
    errorDiv.classList.add('hidden');
    errorText.textContent = '';

    // Validate phone number
    if (!phone || phone.length < 9) {
        errorText.textContent = '{{ __("messages.phone_invalid") }}';
        errorDiv.classList.remove('hidden');
        return;
    }

    if (!phone.match(/^[0-9]{9}$/)) {
        errorText.textContent = '{{ __("messages.digits_only") }}';
        errorDiv.classList.remove('hidden');
        return;
    }

    if (!network) {
        errorText.textContent = '{{ __("messages.select_network_err") }}';
        errorDiv.classList.remove('hidden');
        return;
    }

    // Show processing modal
    document.getElementById('processing-modal').classList.remove('hidden');
    btn.disabled = true;
    btn.textContent = '{{ __("messages.processing") }}';

    // Simulate payment processing then redirect to success
    // In production replace this with your actual mobile money API
    setTimeout(function() {
        window.location.href = '{{ route("payment.success", $appointment->id) }}';
    }, 4000);
}
</script>

@endsection