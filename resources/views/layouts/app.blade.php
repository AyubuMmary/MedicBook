<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MedicBook')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Stripe -->
    <script src="https://js.stripe.com/v3/"></script>

    <style>
        :root {
            --mnh-navy:    #0a2a5e;
            --mnh-navy-2:  #0e3a7a;
            --ocean-light: #DFF7FF;
            --ocean-mid:   #7FCDFF;
            --ocean-dark:  #4BB8F0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(160deg, #F5F9FF 0%, #E8F1FB 100%);
            min-height: 100vh;
        }

        html { scroll-behavior: smooth; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #E8F1FB; }
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 3px; }

        /* ===== MUHIMBILI-STYLE HEADER ===== */
        .navbar-glass {
            background-image:
                linear-gradient(rgba(255,255,255,0.90), rgba(255,255,255,0.94)),
                url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=1920&q=80');
            background-size: cover;
            background-position: center;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        /* Logo sizing — both crest & MedicBook logo share the same footprint */
        .header-logo {
            height: 6.5rem;      /* enlarged for stronger visual presence */
            width: auto;
            object-fit: contain;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.08));
        }
        @media (max-width: 640px) {
            .header-logo { height: 4rem; }
        }

        .mnh-subtitle {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: #475569;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .mnh-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2.1rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            line-height: 1.15;
            background: linear-gradient(90deg, #0e7490 0%, #22c1dc 35%, #4bb8f0 65%, #7fcdff 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .mnh-tagline {
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
        }

        .mnh-underline {
            width: 70px;
            height: 3px;
            margin: 6px auto 0;
            border-radius: 2px;
            background: linear-gradient(90deg, #0e7490, #7fcdff);
        }

        @media (max-width: 640px) {
            .mnh-title    { font-size: 1.15rem; }
            .mnh-subtitle { font-size: 0.78rem; }
            .mnh-tagline  { font-size: 0.75rem; }
        }

        /* Dark nav links (secondary row) */
        .nav-link-dark {
            font-family: 'Poppins', sans-serif;
            color: #0e7490;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 6px 10px;
            border-radius: 999px;
            transition: all 0.2s;
        }
        .nav-link-dark:hover {
            color: #075985;
            background: #e0f7fb;
        }

        /* CTA-style Register Free button */
        .nav-cta {
            font-family: 'Poppins', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--mnh-navy);
            border: 1.5px solid var(--mnh-navy);
            padding: 5px 14px;
            border-radius: 999px;
            transition: all 0.2s;
        }
        .nav-cta:hover {
            background: var(--mnh-navy);
            color: #fff;
        }

        .lang-btn {
            font-family: 'Poppins', sans-serif;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }
        .lang-active-dark   { background: var(--mnh-navy); color: #fff; }
        .lang-inactive-dark { color: #475569; }
        .lang-inactive-dark:hover { background: #f1f5f9; color: var(--mnh-navy); }

        /* Cards / sections */
        .ocean-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 16px rgba(15, 42, 94, 0.06);
            transition: all 0.3s ease;
            border-radius: 12px;
        }
        .ocean-card:hover {
            box-shadow: 0 8px 24px rgba(15, 42, 94, 0.1);
            transform: translateY(-2px);
        }

        .glass-section {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(8px);
            border: 1px solid #e5e7eb;
        }

        .alert-fade { animation: fadeIn 0.4s ease-in-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Footer */
        .ocean-footer {
            background: linear-gradient(135deg, #0a2a5e 0%, #0e3a7a 60%, #1a56a0 100%);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">

<!-- ==================== NAVBAR ==================== -->
<nav class="navbar-glass sticky top-0 z-50">

    {{-- Top row: Coat of Arms | Title | MedicBook Logo --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-5 flex items-center justify-between gap-4">

        {{-- LEFT LOGO --}}
        <div class="flex items-center shrink-0">
            <img src="{{ asset('images/coat-of-arms.png') }}"
                 alt="Coat of Arms"
                 class="header-logo">
        </div>

        {{-- CENTER TITLE --}}
        <div class="flex-1 text-center px-2">
            <p class="mnh-subtitle">
                {{ app()->getLocale() == 'sw'
                    ? 'Jamhuri ya Muungano wa Tanzania'
                    : 'The United Republic of Tanzania' }}
            </p>

            <h1 class="mnh-title uppercase">
                MedicBook Healthcare Booking System
            </h1>

            <div class="mnh-underline"></div>

            <p class="mnh-tagline mt-1">
                {{ app()->getLocale() == 'sw'
                    ? 'Huduma Bora kwa Wananchi'
                    : 'Quality Healthcare Services' }}
            </p>
        </div>

        {{-- RIGHT LOGO --}}
        <div class="flex items-center shrink-0">
            <img src="{{ asset('images/medicbook-logo.png') }}"
                 alt="MedicBook"
                 class="header-logo">
        </div>
    </div>

    {{-- Bottom row: nav links + language --}}
    <div class="border-t border-gray-200 bg-white/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-2.5 flex flex-wrap items-center justify-end gap-1 sm:gap-2">

            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('home') }}" class="nav-link-dark">{{ __('messages.home') }}</a>
                    <a href="{{ route('doctors.index') }}" class="nav-link-dark">{{ __('messages.doctors') }}</a>
                    <a href="{{ route('admin.dashboard') }}"
                       class="bg-[#0a2a5e] text-white px-4 py-1.5 rounded-full text-sm font-semibold hover:bg-[#0e3a7a] transition">
                        {{ __('messages.admin_panel') }}
                    </a>
                @elseif(auth()->user()->isPatient())
                    <a href="{{ route('patient.dashboard') }}" class="nav-link-dark">{{ __('messages.dashboard') }}</a>
                @else
                    <a href="{{ route('home') }}" class="nav-link-dark">{{ __('messages.home') }}</a>
                @endif

                <div class="flex items-center gap-2 border-l border-gray-300 pl-4">
                    <div class="w-8 h-8 rounded-full bg-[#0a2a5e] text-white flex items-center justify-center text-sm font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden sm:block leading-tight">
                        <div class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-slate-500">{{ auth()->user()->role }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="ml-2">
                        @csrf
                        <button type="submit"
                                class="text-xs text-slate-600 hover:text-white border border-slate-300 hover:bg-[#0a2a5e] hover:border-[#0a2a5e] px-3 py-1.5 rounded-full transition">
                            {{ __('messages.logout') }}
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('home') }}"     class="nav-link-dark">{{ __('messages.home') }}</a>
                <a href="{{ route('login') }}"    class="nav-link-dark">{{ __('messages.login') }}</a>
                <a href="{{ route('register') }}" class="nav-link-dark">
                    {{ __('messages.register_free') }}
                </a>
            @endauth

            {{-- Contact --}}
            @if(Route::has('contact'))
                <a href="{{ route('contact') }}" class="nav-link-dark">{{ __('messages.contact') }}</a>
            @else
                <a href="{{ url('/contact') }}" class="nav-link-dark">{{ __('messages.contact') }}</a>
            @endif

            {{-- Language switcher --}}
            <div class="flex items-center gap-1 border-l border-gray-300 pl-4">
                <a href="{{ url('lang/en') }}"
                   class="lang-btn {{ app()->getLocale()==='en' ? 'lang-active-dark' : 'lang-inactive-dark' }}">
                    🇬🇧 EN
                </a>
                <a href="{{ url('lang/sw') }}"
                   class="lang-btn {{ app()->getLocale()==='sw' ? 'lang-active-dark' : 'lang-inactive-dark' }}">
                    🇹🇿 SW
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- ==================== FLASH MESSAGES ==================== -->
<div class="max-w-7xl mx-auto w-full px-4 pt-4 space-y-3">
    @if(session('success'))
        <div class="alert-fade flex items-center gap-2 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            <span>✅</span><span class="flex-1">{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">×</button>
        </div>
    @endif
    @if(session('info'))
        <div class="alert-fade flex items-center gap-2 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg">
            <span>ℹ️</span><span class="flex-1">{{ session('info') }}</span>
            <button onclick="this.parentElement.remove()" class="text-blue-600 hover:text-blue-800">×</button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert-fade flex items-center gap-2 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <span>❌</span><span class="flex-1">{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800">×</button>
        </div>
    @endif
    @if(session('warning'))
        <div class="alert-fade flex items-center gap-2 bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg">
            <span>⚠️</span><span class="flex-1">{{ session('warning') }}</span>
            <button onclick="this.parentElement.remove()" class="text-yellow-600 hover:text-yellow-800">×</button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert-fade bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <div class="flex items-center gap-2 font-semibold mb-2">
                <span>⚠️</span>
                <span class="flex-1">
                    {{ app()->getLocale() === 'sw' ? 'Tafadhali rekebisha makosa yafuatayo:' : 'Please fix the following errors:' }}
                </span>
            </div>
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<!-- ==================== MAIN CONTENT ==================== -->
<main class="max-w-7xl mx-auto w-full px-4 py-6 flex-grow">
    @yield('content')
</main>

<!-- ==================== FOOTER ==================== -->
<footer class="ocean-footer text-white mt-12">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- Brand --}}
        <div>
            <h3 class="text-xl font-bold mb-2">MedicBook</h3>
            <p class="text-white/80 text-sm mb-4">{{ __('messages.trusted_platform') }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs text-white/70">{{ app()->getLocale() === 'sw' ? 'Lugha:' : 'Language:' }}</span>
                <a href="{{ url('lang/en') }}" class="text-xs bg-white/10 hover:bg-white/20 px-2 py-1 rounded">🇬🇧 English</a>
                <a href="{{ url('lang/sw') }}" class="text-xs bg-white/10 hover:bg-white/20 px-2 py-1 rounded">🇹🇿 Kiswahili</a>
            </div>
        </div>

        {{-- Quick Links --}}
        <div>
            <h4 class="font-semibold mb-3">{{ __('messages.quick_links') }}</h4>
            <ul class="space-y-2 text-sm text-white/80">
                <li><a href="{{ route('home') }}" class="hover:text-white">{{ __('messages.home') }}</a></li>
                @auth
                    @if(auth()->user()->isPatient())
                        <li><a href="{{ route('patient.dashboard') }}" class="hover:text-white">{{ __('messages.dashboard') }}</a></li>
                    @endif
                    @if(auth()->user()->isAdmin())
                        <li><a href="{{ route('doctors.index') }}" class="hover:text-white">{{ __('messages.doctors') }}</a></li>
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:text-white">{{ __('messages.admin_panel') }}</a></li>
                    @endif
                @else
                    <li><a href="{{ route('login') }}" class="hover:text-white">{{ __('messages.login') }}</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white">{{ __('messages.register') }}</a></li>
                @endauth
            </ul>
        </div>

        {{-- Contact --}}
        <div>
            <h4 class="font-semibold mb-3">{{ __('messages.contact') }}</h4>
            <ul class="space-y-2 text-sm text-white/80">
                <li>📧 support@medicbook.com</li>
                <li>📞 +255 712 345 678</li>
                <li>📍 Dar es Salaam, Tanzania</li>
                <li>🕐 {{ app()->getLocale() === 'sw' ? 'Jumatatu - Jumamosi: 9AM - 6PM' : 'Mon - Sat: 9AM - 6PM' }}</li>
            </ul>
        </div>
    </div>

    <div class="border-t border-white/20">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row items-center justify-between gap-2 text-xs text-white/70">
            <p>© {{ date('Y') }} MedicBook. {{ __('messages.all_rights') }}</p>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-white">{{ app()->getLocale() === 'sw' ? 'Sera ya Faragha' : 'Privacy Policy' }}</a>
                <a href="#" class="hover:text-white">{{ app()->getLocale() === 'sw' ? 'Masharti ya Huduma' : 'Terms of Service' }}</a>
                <a href="#" class="hover:text-white">{{ app()->getLocale() === 'sw' ? 'Wasiliana Nasi' : 'Contact Us' }}</a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
