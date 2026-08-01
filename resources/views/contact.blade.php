@extends('layouts.app')

@section('title', app()->getLocale() === 'sw' ? 'Wasiliana Nasi - MedicBook' : 'Contact Us - MedicBook')

@section('content')
<style>
    .contact-hero-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        font-size: 2rem;
        letter-spacing: 0.3px;
        background: linear-gradient(90deg, #0e7490 0%, #22c1dc 35%, #4bb8f0 65%, #7fcdff 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    .contact-icon-badge {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        background: linear-gradient(135deg, #DFF7FF 0%, #cdeeff 100%);
        color: #0e7490;
        flex-shrink: 0;
    }
    .contact-input {
        width: 100%;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.9rem;
        font-family: 'Inter', sans-serif;
        color: #1e293b;
        transition: all 0.2s;
        background: #fff;
    }
    .contact-input:focus {
        outline: none;
        border-color: #4bb8f0;
        box-shadow: 0 0 0 3px rgba(75, 184, 240, 0.15);
    }
    .contact-label {
        font-family: 'Poppins', sans-serif;
        font-size: 0.82rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 4px;
        display: block;
    }
    .contact-submit-btn {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 0.95rem;
        color: #fff;
        background: linear-gradient(90deg, #0e7490, #4bb8f0);
        padding: 12px 28px;
        border-radius: 999px;
        transition: all 0.25s;
        box-shadow: 0 4px 14px rgba(14, 116, 144, 0.25);
    }
    .contact-submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(14, 116, 144, 0.35);
    }
</style>

<div class="max-w-6xl mx-auto py-8">

    {{-- Page heading --}}
    <div class="text-center mb-10">
        <h1 class="contact-hero-title">
            {{ app()->getLocale() === 'sw' ? 'Wasiliana Nasi' : 'Contact Us' }}
        </h1>
        <p class="text-slate-500 mt-2 max-w-xl mx-auto">
            {{ app()->getLocale() === 'sw'
                ? 'Tuko hapa kukusaidia. Tuma ujumbe wako na tutakujibu haraka iwezekanavyo.'
                : "We're here to help. Send us a message and our team will get back to you shortly." }}
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

        {{-- Contact info column --}}
        <div class="lg:col-span-2 space-y-4">

            <div class="ocean-card p-5 flex items-start gap-4">
                <div class="contact-icon-badge">📧</div>
                <div>
                    <h3 class="font-semibold text-slate-800 mb-0.5">
                        {{ app()->getLocale() === 'sw' ? 'Barua Pepe' : 'Email' }}
                    </h3>
                    <p class="text-slate-500 text-sm">support@medicbook.com</p>
                </div>
            </div>

            <div class="ocean-card p-5 flex items-start gap-4">
                <div class="contact-icon-badge">📞</div>
                <div>
                    <h3 class="font-semibold text-slate-800 mb-0.5">
                        {{ app()->getLocale() === 'sw' ? 'Simu' : 'Phone' }}
                    </h3>
                    <p class="text-slate-500 text-sm">+255 712 345 678</p>
                </div>
            </div>

            <div class="ocean-card p-5 flex items-start gap-4">
                <div class="contact-icon-badge">📍</div>
                <div>
                    <h3 class="font-semibold text-slate-800 mb-0.5">
                        {{ app()->getLocale() === 'sw' ? 'Anwani' : 'Location' }}
                    </h3>
                    <p class="text-slate-500 text-sm">Dar es Salaam, Tanzania</p>
                </div>
            </div>

            <div class="ocean-card p-5 flex items-start gap-4">
                <div class="contact-icon-badge">🕐</div>
                <div>
                    <h3 class="font-semibold text-slate-800 mb-0.5">
                        {{ app()->getLocale() === 'sw' ? 'Muda wa Kazi' : 'Working Hours' }}
                    </h3>
                    <p class="text-slate-500 text-sm">
                        {{ app()->getLocale() === 'sw' ? 'Jumatatu - Jumamosi: 9AM - 6PM' : 'Mon - Sat: 9AM - 6PM' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Contact form column --}}
        <div class="lg:col-span-3">
            <div class="ocean-card p-6 sm:p-8">
                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="contact-label">
                                {{ app()->getLocale() === 'sw' ? 'Jina Lako' : 'Your Name' }}
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                   class="contact-input" required>
                        </div>
                        <div>
                            <label for="email" class="contact-label">
                                {{ app()->getLocale() === 'sw' ? 'Barua Pepe' : 'Email Address' }}
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="contact-input" required>
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="contact-label">
                            {{ app()->getLocale() === 'sw' ? 'Mada' : 'Subject' }}
                        </label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                               class="contact-input" required>
                    </div>

                    <div>
                        <label for="message" class="contact-label">
                            {{ app()->getLocale() === 'sw' ? 'Ujumbe' : 'Message' }}
                        </label>
                        <textarea id="message" name="message" rows="5"
                                  class="contact-input" required>{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="contact-submit-btn">
                        {{ app()->getLocale() === 'sw' ? 'Tuma Ujumbe' : 'Send Message' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
