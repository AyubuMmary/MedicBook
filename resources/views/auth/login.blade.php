<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.login') }} — MedicBook</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .logo-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 2rem;
            background: linear-gradient(135deg, #ffffff 0%, #bfdbfe 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .logo-book {
            background: linear-gradient(135deg, #fde68a 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .input-field {
            width: 100%;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px 12px 44px;
            font-size: 0.95rem;
            transition: all 0.2s;
            outline: none;
            background: #f9fafb;
        }
        .input-field:focus {
            border-color: #3b82f6;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
        }
        .btn-login {
            background: linear-gradient(135deg, #1d4ed8 0%, #4f46e5 100%);
            transition: all 0.3s;
            transform: translateY(0);
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #1e40af 0%, #4338ca 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(59,130,246,0.4);
        }
        .left-panel {
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 40%, #4f46e5 100%);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        .float-animation { animation: float 4s ease-in-out infinite; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeInUp 0.6s ease-out forwards; }
        .fade-in-delay { animation: fadeInUp 0.6s ease-out 0.2s forwards; opacity: 0; }

        .lang-btn {
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            transition: all 0.2s;
            text-decoration: none;
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
        }
    </style>
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center p-4">

<div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden flex min-h-[600px]">

    <!-- ===== LEFT PANEL ===== -->
    <div class="left-panel hidden md:flex flex-col justify-between w-5/12 p-10 text-white relative overflow-hidden">

        <!-- Background decorations -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24"></div>
        <div class="absolute top-1/2 right-0 w-32 h-32 bg-yellow-400/10 rounded-full translate-x-16"></div>

        <!-- Logo + Language Switcher Row -->
        <div class="relative z-10 flex items-start justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="24" r="23" fill="white" fill-opacity="0.15" stroke="white" stroke-opacity="0.2" stroke-width="1"/>
                    <circle cx="24" cy="24" r="18" fill="white" fill-opacity="0.15"/>
                    <rect x="10" y="21" width="28" height="6.5" rx="3.25" fill="white"/>
                    <rect x="21" y="10" width="6.5" height="28" rx="3.25" fill="white"/>
                    <circle cx="37" cy="37" r="9" fill="#F59E0B"/>
                    <path d="M37 41C37 41 32 37.5 32 34.8C32 33 33.3 31.5 35 31.5C35.9 31.5 36.7 31.9 37 32.6C37.3 31.9 38.1 31.5 39 31.5C40.7 31.5 42 33 42 34.8C42 37.5 37 41 37 41Z" fill="white"/>
                </svg>
                <div>
                    <p class="logo-text">Medic<span class="logo-book">Book</span></p>
                    <p style="font-size:0.6rem;color:#bfdbfe;letter-spacing:2px;text-transform:uppercase;">Healthcare Booking</p>
                </div>
            </a>

            <!-- Language Switcher on Left Panel -->
            <div class="flex items-center gap-1 mt-1">
                <a href="{{ route('lang.switch', 'en') }}"
                   class="lang-btn {{ app()->getLocale() === 'en' ? 'lang-active' : 'lang-inactive' }}">
                    🇬🇧 EN
                </a>
                <a href="{{ route('lang.switch', 'sw') }}"
                   class="lang-btn {{ app()->getLocale() === 'sw' ? 'lang-active' : 'lang-inactive' }}">
                    🇹🇿 SW
                </a>
            </div>
        </div>

        <!-- Floating illustration -->
        <div class="relative z-10 flex-1 flex items-center justify-center py-8">
            <div class="float-animation">
                <svg width="220" height="220" viewBox="0 0 220 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="110" cy="110" r="100" fill="white" fill-opacity="0.08"/>
                    <circle cx="110" cy="110" r="75" fill="white" fill-opacity="0.08"/>
                    <rect x="80" y="120" width="60" height="70" rx="10" fill="white" fill-opacity="0.9"/>
                    <circle cx="110" cy="95" r="28" fill="#fde68a"/>
                    <ellipse cx="110" cy="70" rx="25" ry="12" fill="#1e3a8a"/>
                    <circle cx="101" cy="93" r="3" fill="#1e3a8a"/>
                    <circle cx="119" cy="93" r="3" fill="#1e3a8a"/>
                    <path d="M103 103 Q110 109 117 103" stroke="#1e3a8a" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <path d="M95 130 Q85 145 90 160 Q95 170 105 168" stroke="#3b82f6" stroke-width="3" fill="none" stroke-linecap="round"/>
                    <circle cx="105" cy="170" r="6" fill="#3b82f6"/>
                    <rect x="105" y="135" width="10" height="3" rx="1.5" fill="#3b82f6"/>
                    <rect x="108.5" y="131.5" width="3" height="10" rx="1.5" fill="#3b82f6"/>
                    <rect x="128" y="125" width="25" height="30" rx="4" fill="white" fill-opacity="0.8"/>
                    <rect x="132" y="131" width="17" height="2" rx="1" fill="#93c5fd"/>
                    <rect x="132" y="136" width="17" height="2" rx="1" fill="#93c5fd"/>
                    <rect x="132" y="141" width="12" height="2" rx="1" fill="#93c5fd"/>
                </svg>
            </div>
        </div>

        <!-- Bottom text -->
        <div class="relative z-10">
            <h2 class="text-2xl font-bold mb-3">{{ __('messages.welcome_back') }}!</h2>
            <p class="text-blue-200 text-sm leading-relaxed">
                {{ app()->getLocale() === 'sw'
                    ? 'Ingia kufikia miadi yako, simamia vitabu na kuungana na madaktari bora.'
                    : 'Login to access your appointments, manage bookings and connect with top specialist doctors.' }}
            </p>

            <!-- Features -->
            <div class="mt-6 space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-white/15 rounded-full flex items-center justify-center text-sm">✅</div>
                    <p class="text-blue-100 text-sm">{{ __('messages.instant_booking') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-white/15 rounded-full flex items-center justify-center text-sm">🔒</div>
                    <p class="text-blue-100 text-sm">{{ __('messages.secure_payments') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-white/15 rounded-full flex items-center justify-center text-sm">💳</div>
                    <p class="text-blue-100 text-sm">{{ __('messages.pay_securely') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== RIGHT PANEL - LOGIN FORM ===== -->
    <div class="flex-1 flex items-center justify-center p-8 md:p-12">
        <div class="w-full max-w-md">

            <!-- Header -->
            <div class="fade-in mb-8">
                <!-- Mobile Logo + Language Switcher -->
                <div class="flex md:hidden items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <svg width="36" height="36" viewBox="0 0 48 48" fill="none">
                            <circle cx="24" cy="24" r="23" fill="#1d4ed8" fill-opacity="0.15"/>
                            <rect x="10" y="21" width="28" height="6.5" rx="3.25" fill="#1d4ed8"/>
                            <rect x="21" y="10" width="6.5" height="28" rx="3.25" fill="#1d4ed8"/>
                            <circle cx="37" cy="37" r="9" fill="#F59E0B"/>
                        </svg>
                        <span style="font-family:'Poppins',sans-serif;font-weight:800;font-size:1.4rem;color:#1d4ed8;">
                            Medic<span style="color:#f59e0b;">Book</span>
                        </span>
                    </div>
                    <!-- Mobile Language Switcher -->
                    <div class="flex items-center gap-1">
                        <a href="{{ route('lang.switch', 'en') }}"
                           class="px-2 py-1 rounded-lg text-xs font-bold transition {{ app()->getLocale() === 'en' ? 'bg-blue-600 text-white' : 'text-blue-400 hover:text-blue-600' }}">
                            🇬🇧 EN
                        </a>
                        <a href="{{ route('lang.switch', 'sw') }}"
                           class="px-2 py-1 rounded-lg text-xs font-bold transition {{ app()->getLocale() === 'sw' ? 'bg-blue-600 text-white' : 'text-blue-400 hover:text-blue-600' }}">
                            🇹🇿 SW
                        </a>
                    </div>
                </div>

                <h1 class="text-3xl font-bold text-gray-900" style="font-family:'Poppins',sans-serif;">
                    {{ __('messages.sign_in') }}
                </h1>
                <p class="text-gray-500 mt-2">{{ __('messages.welcome_back_msg') }}</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
            <div class="fade-in bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-start gap-3">
                <span class="text-lg mt-0.5">⚠️</span>
                <div>
                    @foreach($errors->all() as $error)
                        <p class="text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
            @endif

            @if(session('status'))
            <div class="fade-in bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <span>✅</span>
                <p class="text-sm">{{ session('status') }}</p>
            </div>
            @endif

            @if(session('success'))
            <div class="fade-in bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <span>✅</span>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
            @endif

            <!-- LOGIN FORM -->
            <form method="POST" action="{{ route('login') }}" class="fade-in-delay space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.email_address') }}
                    </label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </span>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="input-field @error('email') border-red-400 @enderror"
                               placeholder="you@example.com"
                               required
                               autofocus
                               autocomplete="email">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <span>⚠️</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.password') }}
                    </label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input type="password"
                               name="password"
                               id="password"
                               class="input-field @error('password') border-red-400 @enderror"
                               placeholder="{{ app()->getLocale() === 'sw' ? 'Ingiza nywila yako' : 'Enter your password' }}"
                               required
                               autocomplete="current-password">
                        <button type="button"
                                onclick="togglePassword()"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                            <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <span>⚠️</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember me & Forgot password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox"
                               name="remember"
                               class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                        <span class="text-sm text-gray-600">{{ __('messages.remember_me') }}</span>
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-blue-600 hover:text-blue-800 font-medium transition">
                            {{ __('messages.forgot_password') }}
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit"
                        class="btn-login w-full text-white py-3.5 rounded-xl font-bold text-base tracking-wide shadow-lg">
                    {{ __('messages.sign_in_btn') }}
                </button>

                <!-- Divider -->
                <div class="relative flex items-center gap-4 my-2">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-gray-400 text-sm">{{ app()->getLocale() === 'sw' ? 'au' : 'or' }}</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-gray-600 text-sm">
                        {{ __('messages.no_account') }}
                        <a href="{{ route('register') }}"
                           class="text-blue-600 font-bold hover:text-blue-800 transition ml-1">
                            {{ __('messages.create_free') }}
                        </a>
                    </p>
                </div>

                <!-- Back to home -->
                <div class="text-center">
                    <a href="{{ route('home') }}"
                       class="text-gray-400 hover:text-gray-600 text-sm transition flex items-center justify-center gap-1">
                        ← {{ app()->getLocale() === 'sw' ? 'Rudi Nyumbani' : 'Back to Home' }}
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('eye-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
        `;
    } else {
        input.type = 'password';
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        `;
    }
}
</script>

</body>
</html>
