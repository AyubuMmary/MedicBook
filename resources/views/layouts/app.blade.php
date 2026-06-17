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
        body { font-family: 'Inter', sans-serif; }
        html { scroll-behavior: smooth; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #3b82f6; border-radius: 3px; }

        .navbar-glass {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .logo-medic {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            background: linear-gradient(135deg, #ffffff 0%, #bfdbfe 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }
        .logo-book {
            background: linear-gradient(135deg, #fde68a 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .logo-tagline {
            font-family: 'Inter', sans-serif;
            font-size: 0.6rem;
            color: #bfdbfe;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            font-weight: 500;
        }
        .nav-link {
            position: relative;
            transition: color 0.2s;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #fbbf24;
            transition: width 0.3s;
        }
        .nav-link:hover::after { width: 100%; }

        .lang-btn {
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
        .lang-active {
            background: white;
            color: #1d4ed8;
        }
        .lang-inactive {
            color: #bfdbfe;
        }
        .lang-inactive:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }

        .alert-fade {
            animation: fadeIn 0.4s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

<!-- ==================== NAVBAR ==================== -->
<nav class="bg-gradient-to-r from-blue-800 via-blue-700 to-indigo-700 text-white shadow-lg sticky top-0 z-50 navbar-glass">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">

        <!-- LOGO -->
        <a href="{{ auth()->check() && auth()->user()->isPatient() ? route('patient.dashboard') : route('home') }}"
           class="flex items-center gap-3 group">
            <div class="relative flex-shrink-0">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <circle cx="24" cy="24" r="23" fill="white" fill-opacity="0.1"
                            stroke="white" stroke-opacity="0.2" stroke-width="1"/>
                    <circle cx="24" cy="24" r="18" fill="white" fill-opacity="0.15"/>
                    <rect x="10" y="21" width="28" height="6.5" rx="3.25" fill="white"/>
                    <rect x="21" y="10" width="6.5" height="28" rx="3.25" fill="white"/>
                    <circle cx="37" cy="37" r="9" fill="#F59E0B"/>
                    <circle cx="37" cy="37" r="7.5" fill="#FBBF24"/>
                    <path d="M37 41C37 41 32 37.5 32 34.8C32 33 33.3 31.5 35 31.5C35.9 31.5 36.7 31.9 37 32.6C37.3 31.9 38.1 31.5 39 31.5C40.7 31.5 42 33 42 34.8C42 37.5 37 41 37 41Z"
                          fill="white"/>
                </svg>
            </div>
            <div class="flex flex-col leading-none">
                <span class="logo-medic">Medic<span class="logo-book">Book</span></span>
                <span class="logo-tagline">Healthcare Booking</span>
            </div>
        </a>

        <!-- DESKTOP NAV LINKS -->
        <div class="hidden md:flex items-center gap-6">

            @auth
                @if(auth()->user()->isAdmin())
                    <!-- ===== ADMIN LINKS ===== -->
                    <a href="{{ route('home') }}"
                       class="nav-link text-blue-100 hover:text-white font-medium transition flex items-center gap-1.5 text-sm">
                            {{ __('messages.home') }}
                    </a>
                    <a href="{{ route('doctors.index') }}"
                       class="nav-link text-blue-100 hover:text-white font-medium transition flex items-center gap-1.5 text-sm">
                           {{ __('messages.doctors') }}
                    </a>
                    <a href="{{ route('admin.dashboard') }}"
                       class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-full font-bold hover:bg-yellow-300 transition flex items-center gap-1.5 text-sm shadow">
                           {{ __('messages.admin_panel') }}
                    </a>

                @elseif(auth()->user()->isPatient())
                    <!-- ===== PATIENT LINKS - Dashboard Only ===== -->
                    <a href="{{ route('patient.dashboard') }}"
                       class="nav-link text-blue-100 hover:text-white font-medium transition flex items-center gap-1.5 text-sm">
                         {{ __('messages.dashboard') }}
                    </a>

                @else
                    <!-- ===== DOCTOR LINKS ===== -->
                    <a href="{{ route('home') }}"
                       class="nav-link text-blue-100 hover:text-white font-medium transition flex items-center gap-1.5 text-sm">
                         {{ __('messages.home') }}
                    </a>
                @endif

                <!-- USER AVATAR & LOGOUT -->
                <div class="flex items-center gap-3 border-l border-blue-500 pl-5">
                    <div class="w-9 h-9 bg-gradient-to-br from-yellow-400 to-orange-400 rounded-full flex items-center justify-center font-bold text-gray-900 text-sm shadow">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden lg:block">
                        <p class="text-sm font-semibold leading-none text-white">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-blue-200 capitalize mt-0.5">
                            {{ auth()->user()->role }}
                        </p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline ml-1">
                        @csrf
                        <button type="submit"
                                class="text-xs text-blue-200 hover:text-white border border-blue-400 hover:border-white px-3 py-1.5 rounded-full transition">
                            {{ __('messages.logout') }}
                        </button>
                    </form>
                </div>

            @else
                <!-- ===== GUEST LINKS - Home, Login, Register Only ===== -->
                <a href="{{ route('home') }}"
                   class="nav-link text-blue-100 hover:text-white font-medium transition text-sm">
                     {{ __('messages.home') }}
                </a>
                <a href="{{ route('login') }}"
                   class="nav-link text-blue-100 hover:text-white font-medium transition text-sm">
                    {{ __('messages.login') }}
                </a>
                <a href="{{ route('register') }}"
                   class="bg-yellow-400 text-gray-900 px-5 py-2.5 rounded-full font-bold hover:bg-yellow-300 transition shadow text-sm">
                    {{ __('messages.register_free') }}
                </a>
            @endauth

            <!-- LANGUAGE SWITCHER - Always Visible -->
            <div class="flex items-center gap-1 border-l border-blue-500 pl-5">
                <a href="{{ route('lang.switch', 'en') }}"
                   class="lang-btn {{ app()->getLocale() === 'english' ? 'lang-active' : 'lang-inactive' }}">
                    🇬🇧 EN
                </a>
                <a href="{{ route('lang.switch', 'sw') }}"
                   class="lang-btn {{ app()->getLocale() === 'swahili' ? 'lang-active' : 'lang-inactive' }}">
                    🇹🇿 SWAHILI
                </a>
            </div>

        </div>

        <!-- MOBILE MENU BUTTON -->
        <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                class="md:hidden text-white focus:outline-none p-1">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobile-menu" class="hidden md:hidden bg-blue-900 border-t border-blue-600">
        <div class="px-6 py-4 space-y-1">

            @auth
                @if(auth()->user()->isAdmin())
                    <!-- Admin Mobile Links -->
                    <a href="{{ route('home') }}"
                       class="flex items-center gap-2 text-blue-100 hover:text-white py-3 border-b border-blue-700 text-sm font-medium">
                        🏠 {{ __('messages.home') }}
                    </a>
                    <a href="{{ route('doctors.index') }}"
                       class="flex items-center gap-2 text-blue-100 hover:text-white py-3 border-b border-blue-700 text-sm font-medium">
                        👨‍⚕️ {{ __('messages.doctors') }}
                    </a>
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-2 text-yellow-400 font-bold py-3 border-b border-blue-700 text-sm">
                        ⚙️ {{ __('messages.admin_panel') }}
                    </a>

                @elseif(auth()->user()->isPatient())
                    <!-- Patient Mobile - Dashboard Only -->
                    <a href="{{ route('patient.dashboard') }}"
                       class="flex items-center gap-2 text-blue-100 hover:text-white py-3 border-b border-blue-700 text-sm font-medium">
                        📋 {{ __('messages.dashboard') }}
                    </a>

                @else
                    <!-- Doctor Mobile Links -->
                    <a href="{{ route('home') }}"
                       class="flex items-center gap-2 text-blue-100 hover:text-white py-3 border-b border-blue-700 text-sm font-medium">
                        🏠 {{ __('messages.home') }}
                    </a>
                @endif

                <!-- User Info -->
                <div class="flex items-center gap-3 py-3 border-b border-blue-700">
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-400 rounded-full flex items-center justify-center font-bold text-gray-900 text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-white font-semibold text-sm">{{ auth()->user()->name }}</p>
                        <p class="text-blue-300 text-xs capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left text-red-300 hover:text-red-200 py-3 font-medium text-sm border-b border-blue-700">
                        🚪 {{ __('messages.logout') }}
                    </button>
                </form>

            @else
                <!-- ===== GUEST MOBILE - Home, Login, Register Only ===== -->
                <a href="{{ route('home') }}"
                   class="flex items-center gap-2 text-blue-100 hover:text-white py-3 border-b border-blue-700 text-sm font-medium">
                    🏠 {{ __('messages.home') }}
                </a>
                <a href="{{ route('login') }}"
                   class="flex items-center gap-2 text-blue-100 hover:text-white py-3 border-b border-blue-700 text-sm font-medium">
                    🔐 {{ __('messages.login') }}
                </a>
                <a href="{{ route('register') }}"
                   class="flex items-center gap-2 text-yellow-400 font-bold hover:text-yellow-300 py-3 border-b border-blue-700 text-sm">
                    ✨ {{ __('messages.register_free') }}
                </a>
            @endauth

            <!-- Mobile Language Switcher -->
            <div class="flex items-center gap-3 py-3">
                <p class="text-blue-300 text-xs font-semibold uppercase tracking-wider">
                    {{ app()->getLocale() === 'sw' ? 'Lugha:' : 'Language:' }}
                </p>
                <div class="flex gap-2">
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="lang-btn {{ app()->getLocale() === 'en' ? 'lang-active' : 'lang-inactive' }}">
                        🇬🇧 English
                    </a>
                    <a href="{{ route('lang.switch', 'sw') }}"
                       class="lang-btn {{ app()->getLocale() === 'sw' ? 'lang-active' : 'lang-inactive' }}">
                        🇹🇿 Kiswahili
                    </a>
                </div>
            </div>

        </div>
    </div>
</nav>

<!-- ==================== ALERTS ==================== -->
<div class="max-w-7xl mx-auto w-full px-4 pt-4">

    @if(session('success'))
        <div class="alert-fade bg-green-50 text-green-800 border border-green-200 px-5 py-4 rounded-xl mb-4 flex items-center gap-3 shadow-sm">
            <span class="text-2xl">✅</span>
            <span class="font-medium flex-1">{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()"
                    class="text-green-400 hover:text-green-600 text-xl font-bold ml-auto">×</button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert-fade bg-blue-50 text-blue-800 border border-blue-200 px-5 py-4 rounded-xl mb-4 flex items-center gap-3 shadow-sm">
            <span class="text-2xl">ℹ️</span>
            <span class="font-medium flex-1">{{ session('info') }}</span>
            <button onclick="this.parentElement.remove()"
                    class="text-blue-400 hover:text-blue-600 text-xl font-bold ml-auto">×</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert-fade bg-red-50 text-red-800 border border-red-200 px-5 py-4 rounded-xl mb-4 flex items-center gap-3 shadow-sm">
            <span class="text-2xl">❌</span>
            <span class="font-medium flex-1">{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()"
                    class="text-red-400 hover:text-red-600 text-xl font-bold ml-auto">×</button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert-fade bg-yellow-50 text-yellow-800 border border-yellow-200 px-5 py-4 rounded-xl mb-4 flex items-center gap-3 shadow-sm">
            <span class="text-2xl">⚠️</span>
            <span class="font-medium flex-1">{{ session('warning') }}</span>
            <button onclick="this.parentElement.remove()"
                    class="text-yellow-400 hover:text-yellow-600 text-xl font-bold ml-auto">×</button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-fade bg-red-50 text-red-800 border border-red-200 px-5 py-4 rounded-xl mb-4 shadow-sm">
            <div class="flex items-center gap-2 mb-2">
                <span class="text-2xl">⚠️</span>
                <span class="font-bold flex-1">
                    {{ app()->getLocale() === 'sw' ? 'Tafadhali rekebisha makosa yafuatayo:' : 'Please fix the following errors:' }}
                </span>
                <button onclick="this.parentElement.parentElement.remove()"
                        class="text-red-400 hover:text-red-600 text-xl font-bold">×</button>
            </div>
            <ul class="list-disc list-inside space-y-1 ml-2">
                @foreach($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
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
<footer class="bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">

            <!-- Brand -->
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <svg width="40" height="40" viewBox="0 0 48 48" fill="none">
                        <circle cx="24" cy="24" r="23" fill="white" fill-opacity="0.1"/>
                        <circle cx="24" cy="24" r="18" fill="white" fill-opacity="0.15"/>
                        <rect x="10" y="21" width="28" height="6.5" rx="3.25" fill="white"/>
                        <rect x="21" y="10" width="6.5" height="28" rx="3.25" fill="white"/>
                        <circle cx="37" cy="37" r="9" fill="#F59E0B"/>
                        <path d="M37 41C37 41 32 37.5 32 34.8C32 33 33.3 31.5 35 31.5C35.9 31.5 36.7 31.9 37 32.6C37.3 31.9 38.1 31.5 39 31.5C40.7 31.5 42 33 42 34.8C42 37.5 37 41 37 41Z"
                              fill="white"/>
                    </svg>
                    <div>
                        <p style="font-family:'Poppins',sans-serif;font-weight:800;font-size:1.4rem;background:linear-gradient(135deg,#fff,#bfdbfe);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                            Medic<span style="background:linear-gradient(135deg,#fde68a,#f59e0b);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Book</span>
                        </p>
                        <p style="font-size:0.6rem;color:#93c5fd;letter-spacing:2px;text-transform:uppercase;">
                            Healthcare Booking
                        </p>
                    </div>
                </div>
                <p class="text-blue-200 text-sm leading-relaxed max-w-xs">
                    {{ __('messages.trusted_platform') }}
                </p>

                <!-- Language Switcher in Footer -->
                <div class="flex items-center gap-2 mt-5">
                    <p class="text-blue-300 text-xs font-semibold uppercase tracking-wider">
                        {{ app()->getLocale() === 'sw' ? 'Lugha:' : 'Language:' }}
                    </p>
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="lang-btn {{ app()->getLocale() === 'en' ? 'lang-active' : 'lang-inactive' }}">
                        🇬🇧 English
                    </a>
                    <a href="{{ route('lang.switch', 'sw') }}"
                       class="lang-btn {{ app()->getLocale() === 'sw' ? 'lang-active' : 'lang-inactive' }}">
                        🇹🇿 Kiswahili
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-bold text-white mb-4 text-sm uppercase tracking-wider">
                    {{ __('messages.quick_links') }}
                </h4>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}"
                           class="text-blue-300 hover:text-white text-sm transition">
                            🏠 {{ __('messages.home') }}
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->isPatient())
                            <li>
                                <a href="{{ route('patient.dashboard') }}"
                                   class="text-blue-300 hover:text-white text-sm transition">
                                    📋 {{ __('messages.dashboard') }}
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->isAdmin())
                            <li>
                                <a href="{{ route('doctors.index') }}"
                                   class="text-blue-300 hover:text-white text-sm transition">
                                    👨‍⚕️ {{ __('messages.doctors') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.dashboard') }}"
                                   class="text-blue-300 hover:text-white text-sm transition">
                                    ⚙️ {{ __('messages.admin_panel') }}
                                </a>
                            </li>
                        @endif
                    @else
                        <li>
                            <a href="{{ route('login') }}"
                               class="text-blue-300 hover:text-white text-sm transition">
                                🔐 {{ __('messages.login') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}"
                               class="text-blue-300 hover:text-white text-sm transition">
                                ✨ {{ __('messages.register') }}
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-bold text-white mb-4 text-sm uppercase tracking-wider">
                    {{ __('messages.contact') }}
                </h4>
                <ul class="space-y-3">
                    <li class="text-blue-300 text-sm flex items-center gap-2">
                         mmaryayub@gmail.com
                    </li>
                    <li class="text-blue-300 text-sm flex items-center gap-2">
                        📞 +255 757 178 421
                    </li>
                    <li class="text-blue-300 text-sm flex items-center gap-2">
                        📍 Dodoma , Tanzania
                    </li>
                    <li class="text-blue-300 text-sm flex items-center gap-2">
                        🕐 {{ app()->getLocale() === 'sw' ? 'Jumatatu - Jumamosi: 9AM - 6PM' : 'Mon - Sat: 9AM - 6PM' }}
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-blue-700 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-blue-300 text-sm">
                &copy; {{ date('Y') }} MedicBook. {{ __('messages.all_rights') }}
            </p>
            <div class="flex gap-6">
                <a href="#" class="text-blue-300 hover:text-white text-sm transition">
                    {{ app()->getLocale() === 'sw' ? 'Sera ya Faragha' : 'Privacy Policy' }}
                </a>
                <a href="#" class="text-blue-300 hover:text-white text-sm transition">
                    {{ app()->getLocale() === 'sw' ? 'Masharti ya Huduma' : 'Terms of Service' }}
                </a>
                <a href="#" class="text-blue-300 hover:text-white text-sm transition">
                    {{ app()->getLocale() === 'sw' ? 'Wasiliana Nasi' : 'Contact Us' }}
                </a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>