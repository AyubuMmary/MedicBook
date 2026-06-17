@extends('layouts.app')
@section('title', 'All Payments')
@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800" style="font-family:'Poppins',sans-serif;">
                💰 All Payments
            </h2>
            <p class="text-gray-500 text-sm mt-1">Track all payment transactions</p>
        </div>
        <a href="{{ route('admin.dashboard') }}"
           class="bg-gray-100 text-gray-700 px-4 py-2.5 rounded-xl hover:bg-gray-200 transition font-semibold text-sm">
            ← Dashboard
        </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="rounded-2xl p-5 text-white shadow"
             style="background: linear-gradient(135deg, #d97706, #f59e0b);">
            <p class="text-sm font-medium text-yellow-100">Total Revenue</p>
            <p class="text-2xl font-extrabold mt-1">TSh {{ number_format($totalRevenue) }}</p>
        </div>
        <div class="rounded-2xl p-5 text-white shadow"
             style="background: linear-gradient(135deg, #059669, #10b981);">
            <p class="text-sm font-medium text-green-100">Paid</p>
            <p class="text-4xl font-extrabold mt-1">{{ $totalPaid }}</p>
        </div>
        <div class="rounded-2xl p-5 text-white shadow"
             style="background: linear-gradient(135deg, #ea580c, #f97316);">
            <p class="text-sm font-medium text-orange-100">Pending</p>
            <p class="text-4xl font-extrabold mt-1">{{ $totalPending }}</p>
        </div>
        <div class="rounded-2xl p-5 text-white shadow"
             style="background: linear-gradient(135deg, #dc2626, #ef4444);">
            <p class="text-sm font-medium text-red-100">Failed</p>
            <p class="text-4xl font-extrabold mt-1">{{ $totalFailed }}</p>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-700">All Transactions ({{ $payments->total() }})</h3>
        </div>

        @if($payments->isEmpty())
            <div class="text-center py-16">
                <div class="text-6xl mb-4">💳</div>
                <p class="text-gray-500 text-lg">No payments yet</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Apt ID</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Patient</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Doctor</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Amount</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($payments as $payment)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono text-blue-600 text-xs font-bold bg-blue-50 px-2 py-1 rounded-lg">
                                    {{ $payment->appointment->appointment_id ?? '—' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-800">
                                    {{ $payment->appointment->patient->name ?? '—' }}
                                </p>
                                <p class="text-gray-400 text-xs">
                                    {{ $payment->appointment->patient->email ?? '' }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                @if($payment->appointment->doctor && $payment->appointment->doctor->user)
                                    Dr. {{ $payment->appointment->doctor->user->name }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-green-700 font-bold">
                                    TSh {{ number_format($payment->amount) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($payment->status === 'paid') bg-green-100 text-green-700
                                    @elseif($payment->status === 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($payment->status === 'failed') bg-red-100 text-red-700
                                    @else bg-gray-100 text-gray-700 @endif">
                                    @if($payment->status === 'paid') ✅
                                    @elseif($payment->status === 'pending') ⏳
                                    @elseif($payment->status === 'failed') ❌
                                    @endif
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">
                                {{ $payment->created_at->format('M d, Y h:i A') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t">
                {{ $payments->links() }}
            </div>
        @endif
    </div>
</div>

@endsection