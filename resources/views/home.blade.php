@extends('layouts.app')
@section('title', __('messages.hero_title'))
@section('content')

<!-- HERO SECTION - Ocean Breeze -->
<div class="relative rounded-3xl overflow-hidden mb-16"
     style="background: linear-gradient(135deg, #4BB8F0 0%, #7FCDFF 40%, #4BB8F0 80%, #1A8FCC 100%);">

    <!-- Background Image Overlay -->
    <div class="absolute inset-0 opacity-15">
        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=1400"
             class="w-full h-full object-cover">
    </div>

    <!-- Decorative circles -->
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-20"
         style="background: radial-gradient(circle, #DFF7FF, transparent); transform: translate(30%, -30%);"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full opacity-20"
         style="background: radial-gradient(circle, #DFF7FF, transparent); transform: translate(-30%, 30%);"></div>

    <div class="relative z-10 text-center py-24 px-6">
        <span class="text-white text-sm font-semibold px-5 py-2 rounded-full mb-6 inline-block"
              style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3);">
            {{ __('messages.trusted_by') }}
        </span>
        <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight text-white">
            {{ __('messages.hero_title') }}
        </h1>
        <p class="text-xl md:text-2xl mb-10 max-w-2xl mx-auto" style="color: #DFF7FF;">
            {{ __('messages.hero_subtitle') }}
        </p>
    </div>
</div>

<!-- STATS SECTION -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
    <div class="rounded-2xl p-6 text-center border-b-4 shadow-md hover:-translate-y-1 transition"
         style="background: rgba(255,255,255,0.7); border-bottom-color: #4BB8F0; backdrop-filter: blur(10px);">
        <p class="text-4xl font-extrabold" style="color: #1A8FCC;">50+</p>
        <p class="mt-1 font-medium text-gray-600">{{ __('messages.specialist_doctors') }}</p>
    </div>
    <div class="rounded-2xl p-6 text-center border-b-4 shadow-md hover:-translate-y-1 transition"
         style="background: rgba(255,255,255,0.7); border-bottom-color: #10b981; backdrop-filter: blur(10px);">
        <p class="text-4xl font-extrabold text-green-600">10K+</p>
        <p class="mt-1 font-medium text-gray-600">{{ __('messages.happy_patients') }}</p>
    </div>
    <div class="rounded-2xl p-6 text-center border-b-4 shadow-md hover:-translate-y-1 transition"
         style="background: rgba(255,255,255,0.7); border-bottom-color: #f59e0b; backdrop-filter: blur(10px);">
        <p class="text-4xl font-extrabold text-yellow-500">15+</p>
        <p class="mt-1 font-medium text-gray-600">{{ __('messages.specializations') }}</p>
    </div>
    <div class="rounded-2xl p-6 text-center border-b-4 shadow-md hover:-translate-y-1 transition"
         style="background: rgba(255,255,255,0.7); border-bottom-color: #7FCDFF; backdrop-filter: blur(10px);">
        <p class="text-4xl font-extrabold" style="color: #4BB8F0;">24/7</p>
        <p class="mt-1 font-medium text-gray-600">{{ __('messages.online_booking') }}</p>
    </div>
</div>

<!-- HOW IT WORKS -->
<div class="mb-16">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold" style="color: #0e6fa3;">
            {{ __('messages.how_it_works') }}
        </h2>
        <p class="mt-2 text-lg text-gray-600">{{ __('messages.how_subtitle') }}</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Step 1 -->
        <div class="rounded-2xl p-8 text-center relative shadow-md hover:-translate-y-1 transition"
             style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border: 1px solid rgba(127,205,255,0.3);">
            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                 style="background: #DFF7FF;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8" style="color:#1A8FCC;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <div class="absolute -top-3 -left-3 w-8 h-8 text-white rounded-full flex items-center justify-center font-bold text-sm"
                 style="background: #1A8FCC;">1</div>
            <h3 class="text-xl font-bold mb-2" style="color: #0e6fa3;">{{ __('messages.step1_title') }}</h3>
            <p class="text-gray-500">{{ __('messages.step1_desc') }}</p>
        </div>

        <!-- Step 2 -->
        <div class="rounded-2xl p-8 text-center relative shadow-md hover:-translate-y-1 transition"
             style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border: 1px solid rgba(127,205,255,0.3);">
            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                 style="background: #DFF7FF;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8" style="color:#1A8FCC;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
            </div>
            <div class="absolute -top-3 -left-3 w-8 h-8 text-white rounded-full flex items-center justify-center font-bold text-sm"
                 style="background: #10b981;">2</div>
            <h3 class="text-xl font-bold mb-2" style="color: #0e6fa3;">{{ __('messages.step2_title') }}</h3>
            <p class="text-gray-500">{{ __('messages.step2_desc') }}</p>
        </div>

        <!-- Step 3 -->
        <div class="rounded-2xl p-8 text-center relative shadow-md hover:-translate-y-1 transition"
             style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border: 1px solid rgba(127,205,255,0.3);">
            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                 style="background: #DFF7FF;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8" style="color:#1A8FCC;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>
            </div>
            <div class="absolute -top-3 -left-3 w-8 h-8 text-white rounded-full flex items-center justify-center font-bold text-sm"
                 style="background: #f59e0b;">3</div>
            <h3 class="text-xl font-bold mb-2" style="color: #0e6fa3;">{{ __('messages.step3_title') }}</h3>
            <p class="text-gray-500">{{ __('messages.step3_desc') }}</p>
        </div>

    </div>
</div>

<!-- FEATURED DOCTORS -->
<div class="mb-16">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold" style="color: #0e6fa3;">
            {{ __('messages.featured_doctors') }}
        </h2>
        <p class="mt-2 text-lg text-gray-600">{{ __('messages.featured_subtitle') }}</p>
    </div>

    @if($doctors->isEmpty())
    <div class="text-center py-16 rounded-2xl shadow"
         style="background: rgba(255,255,255,0.7); backdrop-filter: blur(10px);">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-16 h-16 mx-auto mb-4 text-gray-300">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        <p class="text-xl text-gray-500">{{ __('messages.no_doctors_yet') }}</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($doctors as $doctor)
        @if(!$doctor->user) @continue @endif
        <div class="rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group hover:-translate-y-1"
             style="background: rgba(255,255,255,0.8); backdrop-filter: blur(10px); border: 1px solid rgba(127,205,255,0.3);">

            <!-- Card Header -->
            <div class="h-24 relative"
                style="background: linear-gradient(135deg, #059669, #10b981); color: white;">
                <div class="absolute -bottom-10 left-1/2 transform -translate-x-1/2">
                    @if($doctor->photo)
                        <img src="{{ asset('storage/'.$doctor->photo) }}"
                             class="w-20 h-20 rounded-full border-4 border-white object-cover shadow-lg">
                    @else
                        <div class="w-20 h-20 rounded-full border-4 border-white flex items-center justify-center shadow-lg"
                             style="background: #DFF7FF;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10" style="color:#1A8FCC;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Card Body -->
            <div class="pt-14 pb-6 px-6 text-center">
                <h3 class="text-xl font-bold text-gray-800">
                    {{ str_starts_with($doctor->user->name, 'Dr.') ? $doctor->user->name : 'Dr. '.$doctor->user->name }}
                </h3>
                <p class="font-semibold" style="color: #1A8FCC;">{{ $doctor->specialization }}</p>
                <p class="text-gray-400 text-sm mt-1">{{ $doctor->qualification }}</p>
                @if($doctor->experience)
                    <p class="text-gray-400 text-xs mt-1 flex items-center justify-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006Z" clip-rule="evenodd" />
                        </svg>
                        {{ $doctor->experience }} {{ __('messages.years') }} {{ __('messages.experience') }}
                    </p>
                @endif
                <div class="flex justify-center gap-2 mt-3">
                    <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm4.03 7.72a.75.75 0 1 0-1.06-1.06l-4.72 4.72-1.72-1.72a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.06 0l5.25-5.25Z" clip-rule="evenodd" />
                        </svg>
                        {{ __('messages.available') }}
                    </span>
                    <span class="text-xs px-3 py-1 rounded-full font-semibold"
                          style="background: #DFF7FF; color: #1A8FCC;">
                        TSh {{ number_format($doctor->consultation_fee) }}
                    </span>
                </div>
                <a href="{{ route('doctors.show', $doctor->id) }}"
                   class="mt-5 inline-block w-full text-white py-2.5 rounded-xl font-semibold transition hover:-translate-y-0.5 hover:shadow-lg"
                   style="background: linear-gradient(135deg, #4BB8F0, #1A8FCC);">
                    {{ __('messages.book_appointment') }}
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-10">
        <a href="{{ route('doctors.index') }}"
           class="inline-block px-8 py-3 rounded-full font-bold transition hover:-translate-y-1"
           style="border: 2px solid #4BB8F0; color: #1A8FCC; background: rgba(255,255,255,0.6);">
            {{ __('messages.view_all_doctors') }}
        </a>
    </div>
    @endif
</div>

<!-- SPECIALIZATIONS -->
<div class="mb-16">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold" style="color: #0e6fa3;">
            {{ __('messages.our_specializations') }}
        </h2>
        <p class="mt-2 text-lg text-gray-600">{{ __('messages.spec_subtitle') }}</p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach([
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" /></svg>',
                'key' => 'cardiology'
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.5 3.5c-1.5 0-2.5 1-2.5 2.2 0 .3 0 .5.1.8-1 .4-1.6 1.3-1.6 2.4 0 .7.3 1.3.7 1.8-.5.5-.8 1.1-.8 1.9 0 1.2.9 2.2 2 2.4-.1.3-.2.6-.2 1 0 1.5 1.2 2.7 2.7 2.7.4 0 .8-.1 1.1-.3.4.9 1.3 1.6 2.3 1.6V3.5H9.5Z"/><path d="M14.5 3.5c1.5 0 2.5 1 2.5 2.2 0 .3 0 .5-.1.8 1 .4 1.6 1.3 1.6 2.4 0 .7-.3 1.3-.7 1.8.5.5.8 1.1.8 1.9 0 1.2-.9 2.2-2 2.4.1.3.2.6.2 1 0 1.5-1.2 2.7-2.7 2.7-.4 0-.8-.1-1.1-.3-.4.9-1.3 1.6-2.3 1.6V3.5h3.8Z"/></svg>',
                'key' => 'neurology'
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7.5 16.5 16.5 7.5"/><path d="M5.5 4.5a2 2 0 1 1 3 2.6L7 8.5a2 2 0 1 1-2.6-3l1.1-1Z"/><path d="M18.5 19.5a2 2 0 1 1-3-2.6l1.5-1.4a2 2 0 1 1 2.6 3l-1.1 1Z"/></svg>',
                'key' => 'orthopedic'
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>',
                'key' => 'ophthalmology'
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-13.5-3h.008v.008H7.5V9Zm6 0h.008v.008h-.008V9Z" /></svg>',
                'key' => 'pediatrics'
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3.5c-2 0-3.5 1.6-3.5 3.8 0 1.6.4 3.9.9 5.9.5 2 1.1 4.3 1.9 5.7.4.7 1.2 1.1 1.8.6.5-.4.6-1.3.7-2.1.1-1 .3-2.4 1.2-2.4s1.1 1.4 1.2 2.4c.1.8.2 1.7.7 2.1.6.5 1.4.1 1.8-.6.8-1.4 1.4-3.7 1.9-5.7.5-2 .9-4.3.9-5.9 0-2.2-1.5-3.8-3.5-3.8-1 0-1.7.4-2.5.8-.8-.4-1.5-.8-2.5-.8Z"/></svg>',
                'key' => 'dentistry'
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3v5a4 4 0 0 0 8 0V3"/><path d="M9 12v2a5 5 0 0 0 10 0v-2.5"/><circle cx="19" cy="8.5" r="2"/></svg>',
                'key' => 'general_medicine'
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8.5 11.5c0-4.4 3.4-8 7.5-8 3.3 0 5.5 2.4 5.5 5.5 0 2.5-1.5 3.7-1.5 6 0 1.9 1.5 2.5 1.5 4a3 3 0 0 1-3 3c-1.7 0-2.5-1-3-2"/><path d="M8.5 11.5c0 2 .5 3 1.5 4"/></svg>',
                'key' => 'ent'
            ],
        ] as $spec)
        <div class="rounded-2xl p-5 text-center shadow-md hover:shadow-lg transition hover:-translate-y-1 cursor-pointer"
             style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border: 1px solid rgba(127,205,255,0.3);">
            <div class="w-9 h-9 mx-auto mb-2" style="color:#0e6fa3;">{!! $spec['icon'] !!}</div>
            <p class="font-semibold text-sm" style="color: #0e6fa3;">{{ __('messages.'.$spec['key']) }}</p>
        </div>
        @endforeach
    </div>
</div>

<!-- WHY CHOOSE US -->
<div class="rounded-3xl p-10 mb-16 text-white"
     style="background: linear-gradient(135deg, #1A8FCC 0%, #4BB8F0 50%, #7FCDFF 100%);">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold">{{ __('messages.why_choose_us') }}</h2>
        <p class="mt-2 text-lg" style="color: #DFF7FF;">{{ __('messages.why_subtitle') }}</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center p-6 rounded-2xl" style="background: rgba(255,255,255,0.15);">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto mb-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
            <h3 class="text-xl font-bold mb-2">{{ __('messages.secure_payments') }}</h3>
            <p style="color: #DFF7FF;">{{ __('messages.secure_desc') }}</p>
        </div>
        <div class="text-center p-6 rounded-2xl" style="background: rgba(255,255,255,0.15);">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 mx-auto mb-4">
                <path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 0 1 .359.852L12.982 9.75h7.268a.75.75 0 0 1 .548 1.262l-10.5 11.25a.75.75 0 0 1-1.272-.71l1.992-7.302H3.75a.75.75 0 0 1-.548-1.262l10.5-11.25a.75.75 0 0 1 .913-.143Z" clip-rule="evenodd" />
            </svg>
            <h3 class="text-xl font-bold mb-2">{{ __('messages.instant_booking') }}</h3>
            <p style="color: #DFF7FF;">{{ __('messages.instant_desc') }}</p>
        </div>
        <div class="text-center p-6 rounded-2xl" style="background: rgba(255,255,255,0.15);">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto mb-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
            </svg>
            <h3 class="text-xl font-bold mb-2">{{ __('messages.appointment_id') }}</h3>
            <p style="color: #DFF7FF;">{{ __('messages.appointment_desc') }}</p>
        </div>
    </div>
</div>

<!-- TESTIMONIALS -->
<div class="mb-16">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold" style="color: #0e6fa3;">
            {{ __('messages.what_patients_say') }}
        </h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach([
            ['name' => 'Sarah Johnson',  'key' => 'review1', 'rating' => 5],
            ['name' => 'Michael Chen',   'key' => 'review2', 'rating' => 5],
            ['name' => 'Amina Hassan',   'key' => 'review3', 'rating' => 5],
        ] as $review)
        <div class="rounded-2xl p-6 shadow-md hover:-translate-y-1 transition"
             style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border: 1px solid rgba(127,205,255,0.3);">
            <div class="flex gap-1 mb-3">
                @for($i = 0; $i < $review['rating']; $i++)
                    <span class="text-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006Z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @endfor
            </div>
            <p class="text-gray-600 italic mb-4">"{{ __('messages.'.$review['key']) }}"</p>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white"
                     style="background: linear-gradient(135deg, #4BB8F0, #1A8FCC);">
                    {{ substr($review['name'], 0, 1) }}
                </div>
                <div>
                    <p class="font-bold text-gray-800">{{ $review['name'] }}</p>
                    <p class="text-gray-400 text-sm">{{ __('messages.patient') }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- CTA SECTION -->
@guest
<div class="rounded-3xl p-10 text-center mb-8"
     style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 40%, #6ee7b7 100%); border: 1px solid rgba(110,231,183,0.4);">
    <h2 class="text-4xl font-extrabold mb-4" style="color: #065f46;">
        {{ __('messages.cta_title') }}
    </h2>
    <p class="text-lg mb-8" style="color: #047857;">
        {{ __('messages.cta_subtitle') }}
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('register') }}"
           class="px-10 py-4 rounded-full text-lg font-bold transition shadow-lg hover:-translate-y-1 text-white"
           style="background: linear-gradient(135deg, #059669, #10b981);">
            {{ __('messages.get_started') }}
        </a>
        <a href="{{ route('doctors.index') }}"
           class="px-10 py-4 rounded-full text-lg font-bold transition shadow-lg hover:-translate-y-1"
           style="background: rgba(255,255,255,0.8); color: #065f46; border: 2px solid #6ee7b7;">
            {{ __('messages.find_doctor') }}
        </a>
    </div>
</div>
@endguest

@endsection