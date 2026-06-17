@extends('layouts.app')
@section('title', __('messages.hero_title'))
@section('content')

<!-- HERO SECTION -->
<div class="relative bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-700 text-white rounded-3xl overflow-hidden mb-16">
    <div class="absolute inset-0 opacity-10">
        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=1400"
             class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 text-center py-24 px-6">
        <span class="bg-white/20 text-white text-sm font-semibold px-4 py-2 rounded-full mb-6 inline-block">
            {{ __('messages.trusted_by') }}
        </span>
        <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight">
            {{ __('messages.hero_title') }}
        </h1>
        <p class="text-xl md:text-2xl text-blue-100 mb-10 max-w-2xl mx-auto">
            {{ __('messages.hero_subtitle') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('doctors.index') }}"
               class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-full text-lg font-bold hover:bg-yellow-300 transition shadow-lg">
                🔍 {{ __('messages.find_doctor') }}
            </a>
            @guest
            <a href="{{ route('register') }}"
               class="bg-white/20 border-2 border-white text-white px-8 py-4 rounded-full text-lg font-bold hover:bg-white hover:text-blue-700 transition">
                {{ __('messages.register_free') }}
            </a>
            @endguest
        </div>
    </div>
</div>

<!-- STATS -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
    <div class="bg-white rounded-2xl shadow p-6 text-center border-b-4 border-blue-500">
        <p class="text-4xl font-extrabold text-blue-700">50+</p>
        <p class="text-gray-500 mt-1 font-medium">{{ __('messages.specialist_doctors') }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 text-center border-b-4 border-green-500">
        <p class="text-4xl font-extrabold text-green-600">10K+</p>
        <p class="text-gray-500 mt-1 font-medium">{{ __('messages.happy_patients') }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 text-center border-b-4 border-yellow-500">
        <p class="text-4xl font-extrabold text-yellow-600">15+</p>
        <p class="text-gray-500 mt-1 font-medium">{{ __('messages.specializations') }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 text-center border-b-4 border-purple-500">
        <p class="text-4xl font-extrabold text-purple-600">24/7</p>
        <p class="text-gray-500 mt-1 font-medium">{{ __('messages.online_booking') }}</p>
    </div>
</div>

<!-- HOW IT WORKS -->
<div class="mb-16">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold text-gray-800">{{ __('messages.how_it_works') }}</h2>
        <p class="text-gray-500 mt-2 text-lg">{{ __('messages.how_subtitle') }}</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl shadow p-8 text-center relative">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">🔍</div>
            <div class="absolute -top-3 -left-3 w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-bold text-sm">1</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ __('messages.step1_title') }}</h3>
            <p class="text-gray-500">{{ __('messages.step1_desc') }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-8 text-center relative">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">📅</div>
            <div class="absolute -top-3 -left-3 w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-sm">2</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ __('messages.step2_title') }}</h3>
            <p class="text-gray-500">{{ __('messages.step2_desc') }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-8 text-center relative">
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">💳</div>
            <div class="absolute -top-3 -left-3 w-8 h-8 bg-yellow-500 text-white rounded-full flex items-center justify-center font-bold text-sm">3</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ __('messages.step3_title') }}</h3>
            <p class="text-gray-500">{{ __('messages.step3_desc') }}</p>
        </div>
    </div>
</div>

<!-- FEATURED DOCTORS -->
<div class="mb-16">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold text-gray-800">{{ __('messages.featured_doctors') }}</h2>
        <p class="text-gray-500 mt-2 text-lg">{{ __('messages.featured_subtitle') }}</p>
    </div>

    @if($doctors->isEmpty())
    <div class="text-center py-16 bg-white rounded-2xl shadow">
        <p class="text-6xl mb-4">👨‍⚕️</p>
        <p class="text-xl text-gray-500">{{ __('messages.no_doctors_yet') }}</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($doctors as $doctor)
        @if(!$doctor->user) @continue @endif
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition-all duration-300 overflow-hidden group">
            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 h-24 relative">
                <div class="absolute -bottom-10 left-1/2 transform -translate-x-1/2">
                    @if($doctor->photo)
                        <img src="{{ asset('storage/'.$doctor->photo) }}"
                             class="w-20 h-20 rounded-full border-4 border-white object-cover shadow-lg">
                    @else
                        <div class="w-20 h-20 rounded-full border-4 border-white bg-blue-100 flex items-center justify-center text-4xl shadow-lg">
                            {{ $doctor->gender === 'female' ? '👩‍⚕️' : '👨‍⚕️' }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="pt-14 pb-6 px-6 text-center">
                <h3 class="text-xl font-bold text-gray-800">
                    {{ str_starts_with($doctor->user->name, 'Dr.') ? $doctor->user->name : 'Dr. '.$doctor->user->name }}
                </h3>
                <p class="text-blue-600 font-semibold">{{ $doctor->specialization }}</p>
                <p class="text-gray-400 text-sm mt-1">{{ $doctor->qualification }}</p>
                @if($doctor->experience)
                    <p class="text-gray-400 text-xs mt-1">⭐ {{ $doctor->experience }} {{ __('messages.years') }} {{ __('messages.experience') }}</p>
                @endif
                <div class="flex justify-center gap-2 mt-3">
                    <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-semibold">
                        ✅ {{ __('messages.available') }}
                    </span>
                    <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full font-semibold">
                        TSh {{ number_format($doctor->consultation_fee) }}
                    </span>
                </div>
                <a href="{{ route('doctors.show', $doctor->id) }}"
                   class="mt-5 inline-block w-full bg-blue-700 text-white py-2.5 rounded-xl font-semibold hover:bg-blue-800 transition">
                    {{ __('messages.book_appointment') }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="text-center mt-10">
        <a href="{{ route('doctors.index') }}"
           class="inline-block border-2 border-blue-700 text-blue-700 px-8 py-3 rounded-full font-bold hover:bg-blue-700 hover:text-white transition">
            {{ __('messages.view_all_doctors') }}
        </a>
    </div>
    @endif
</div>

<!-- SPECIALIZATIONS -->
<div class="mb-16">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold text-gray-800">{{ __('messages.our_specializations') }}</h2>
        <p class="text-gray-500 mt-2 text-lg">{{ __('messages.spec_subtitle') }}</p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach([
            ['icon' => '❤️', 'key' => 'cardiology'],
            ['icon' => '🧠', 'key' => 'neurology'],
            ['icon' => '🦴', 'key' => 'orthopedic'],
            ['icon' => '👁️', 'key' => 'ophthalmology'],
            ['icon' => '🧒', 'key' => 'pediatrics'],
            ['icon' => '🦷', 'key' => 'dentistry'],
            ['icon' => '🩺', 'key' => 'general_medicine'],
            ['icon' => '👂', 'key' => 'ent'],
        ] as $spec)
        <div class="bg-white rounded-2xl shadow p-5 text-center hover:shadow-lg transition cursor-pointer hover:-translate-y-1 duration-200">
            <div class="text-4xl mb-2">{{ $spec['icon'] }}</div>
            <p class="font-semibold text-gray-700 text-sm">{{ __('messages.'.$spec['key']) }}</p>
        </div>
        @endforeach
    </div>
</div>

<!-- WHY CHOOSE US -->
<div class="bg-gradient-to-br from-blue-700 to-indigo-700 rounded-3xl p-10 mb-16 text-white">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold">{{ __('messages.why_choose_us') }}</h2>
        <p class="text-blue-200 mt-2 text-lg">{{ __('messages.why_subtitle') }}</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center">
            <div class="text-5xl mb-4">🔒</div>
            <h3 class="text-xl font-bold mb-2">{{ __('messages.secure_payments') }}</h3>
            <p class="text-blue-200">{{ __('messages.secure_desc') }}</p>
        </div>
        <div class="text-center">
            <div class="text-5xl mb-4">⚡</div>
            <h3 class="text-xl font-bold mb-2">{{ __('messages.instant_booking') }}</h3>
            <p class="text-blue-200">{{ __('messages.instant_desc') }}</p>
        </div>
        <div class="text-center">
            <div class="text-5xl mb-4">📋</div>
            <h3 class="text-xl font-bold mb-2">{{ __('messages.appointment_id') }}</h3>
            <p class="text-blue-200">{{ __('messages.appointment_desc') }}</p>
        </div>
    </div>
</div>

<!-- TESTIMONIALS -->
<div class="mb-16">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-extrabold text-gray-800">{{ __('messages.what_patients_say') }}</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach([
            ['name' => 'Sarah Johnson',  'key' => 'review1', 'rating' => 5],
            ['name' => 'Michael Chen',   'key' => 'review2', 'rating' => 5],
            ['name' => 'Amina Hassan',   'key' => 'review3', 'rating' => 5],
        ] as $review)
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="flex gap-1 mb-3">
                @for($i = 0; $i < $review['rating']; $i++)
                    <span class="text-yellow-400">⭐</span>
                @endfor
            </div>
            <p class="text-gray-600 italic mb-4">"{{ __('messages.'.$review['key']) }}"</p>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center font-bold text-blue-700">
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

<!-- CTA -->
@guest
<div class="bg-gradient-to-r from-yellow-400 to-orange-400 rounded-3xl p-10 text-center mb-8">
    <h2 class="text-4xl font-extrabold text-gray-900 mb-4">{{ __('messages.cta_title') }}</h2>
    <p class="text-gray-800 text-lg mb-8">{{ __('messages.cta_subtitle') }}</p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('register') }}"
           class="bg-blue-700 text-white px-10 py-4 rounded-full text-lg font-bold hover:bg-blue-800 transition shadow-lg">
            {{ __('messages.get_started') }}
        </a>
        <a href="{{ route('doctors.index') }}"
           class="bg-white text-gray-800 px-10 py-4 rounded-full text-lg font-bold hover:bg-gray-100 transition shadow-lg">
            {{ __('messages.find_doctor') }}
        </a>
    </div>
</div>
@endguest

@endsection