<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.create_account') }} — MedicBook</title>
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
        .btn-register {
            background: linear-gradient(135deg, #1d4ed8 0%, #4f46e5 100%);
            transition: all 0.3s;
        }
        .btn-register:hover {
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
        .lang-active { background: white; color: #1d4ed8; }
        .lang-inactive { color: #bfdbfe; }
        .lang-inactive:hover { color: white; }
    </style>
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center p-4">

<div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden flex min-h-[650px]">

    <!-- ===== LEFT PANEL ===== -->
    <div class="left-panel hidden md:flex flex-col justify-between w-5/12 p-10 text-white relative overflow-hidden">

        <!-- Background decorations -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24"></div>

        <!-- Logo -->
        <div class="relative z-10">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <circle cx="24" cy="24" r="23" fill="white" fill-opacity="0.15"/>
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
        </div>

        <!-- Floating illustration -->
        <div class="relative z-10 flex-1 flex items-center justify-center py-8">
            <div class="float-animation">
                <svg width="200" height="200" viewBox="0 0 200 200" fill="none">
                    <circle cx="100" cy="100" r="90" fill="white" fill-opacity="0.08"/>
                    <circle cx="100" cy="100" r="68" fill="white" fill-opacity="0.08"/>
                    <rect x="55" y="60" width="90" height="110" rx="10" fill="white" fill-opacity="0.9"/>
                    <rect x="75" y="50" width="50" height="25" rx="8" fill="#bfdbfe"/>
                    <rect x="70" y="95" width="60" height="4" rx="2" fill="#93c5fd"/>
                    <rect x="70" y="108" width="60" height="4" rx="2" fill="#93c5fd"/>
                    <rect x="70" y="121" width="45" height="4" rx="2" fill="#93c5fd"/>
                    <rect x="70" y="134" width="50" height="4" rx="2" fill="#93c5fd"/>
                    <circle cx="150" cy="150" r="25" fill="#10b981"/>
                    <path d="M138 150 L147 159 L163 143" stroke="white" stroke-width="4" fill="none"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <!-- Bottom text -->
        <div class="relative z-10">
            <h2 class="text-2xl font-bold mb-3">
                {{ app()->getLocale() === 'sw' ? 'Jiunge na MedicBook Leo!' : 'Join MedicBook Today!' }}
            </h2>
            <p class="text-blue-200 text-sm leading-relaxed">
                {{ __('messages.join_medicbook') }}
            </p>
            <div class="mt-6 space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-white/15 rounded-full flex items-center justify-center text-sm">🆓</div>
                    <p class="text-blue-100 text-sm">
                        {{ app()->getLocale() === 'sw' ? 'Bure kujisajili' : 'Free to register' }}
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-white/15 rounded-full flex items-center justify-center text-sm">📅</div>
                    <p class="text-blue-100 text-sm">
                        {{ app()->getLocale() === 'sw' ? 'Weka miadi haraka' : 'Book instantly' }}
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-white/15 rounded-full flex items-center justify-center text-sm">🔒</div>
                    <p class="text-blue-100 text-sm">
                        {{ app()->getLocale() === 'sw' ? '100% salama na ya siri' : '100% secure & private' }}
                    </p>
                </div>
            </div>

            <!-- Language Switcher on Left Panel -->
            <div class="flex items-center gap-2 mt-6">
                <p class="text-blue-300 text-xs">
                    {{ app()->getLocale() === 'sw' ? 'Lugha:' : 'Language:' }}
                </p>
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
    </div>

    <!-- ===== RIGHT PANEL - REGISTER FORM ===== -->
    <div class="flex-1 flex items-center justify-center p-8 md:p-10 overflow-y-auto">
        <div class="w-full max-w-md">

            <!-- Header -->
            <div class="fade-in mb-6">
                <!-- Mobile Logo -->
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
                    <div class="flex gap-1">
                        <a href="{{ route('lang.switch', 'en') }}"
                           class="lang-btn {{ app()->getLocale() === 'en' ? 'lang-active' : 'lang-inactive' }}"
                           style="{{ app()->getLocale() !== 'en' ? 'color:#6b7280;' : '' }}">
                            🇬🇧 EN
                        </a>
                        <a href="{{ route('lang.switch', 'sw') }}"
                           class="lang-btn {{ app()->getLocale() === 'sw' ? 'lang-active' : 'lang-inactive' }}"
                           style="{{ app()->getLocale() !== 'sw' ? 'color:#6b7280;' : '' }}">
                            🇹🇿 SW
                        </a>
                    </div>
                </div>

                <h1 class="text-3xl font-bold text-gray-900" style="font-family:'Poppins',sans-serif;">
                    {{ __('messages.create_account') }}
                </h1>
                <p class="text-gray-500 mt-2">{{ __('messages.join_medicbook') }}</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
            <div class="fade-in bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-5 flex items-start gap-3">
                <span class="text-lg mt-0.5">⚠️</span>
                <div>
                    @foreach($errors->all() as $error)
                        <p class="text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- REGISTER FORM -->
            <form method="POST" action="{{ route('register') }}" class="fade-in-delay space-y-4">
                @csrf

                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.full_name') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="input-field @error('name') border-red-400 @enderror"
                               placeholder="{{ app()->getLocale() === 'sw' ? 'Jina Kamili' : 'John Smith' }}"
                               required
                               autofocus
                               autocomplete="name">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.email_address') }} <span class="text-red-500">*</span>
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
                               placeholder="{{ app()->getLocale() === 'sw' ? 'wewe@mfano.com' : 'you@example.com' }}"
                               required
                               autocomplete="email">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.phone_number') }}
                        <span class="text-gray-400 font-normal">({{ __('messages.optional') }})</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </span>
                        <input type="text"
                               name="phone"
                               value="{{ old('phone') }}"
                               class="input-field"
                               placeholder="+255 712 345 678">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.password') }} <span class="text-red-500">*</span>
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
                               placeholder="{{ app()->getLocale() === 'sw' ? 'Angalau herufi 8' : 'Min. 8 characters' }}"
                               required
                               autocomplete="new-password">
                        <button type="button"
                                onclick="togglePassword('password', 'eye1')"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                            <svg id="eye1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.confirm_password') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </span>
                        <input type="password"
                               name="password_confirmation"
                               id="password_confirmation"
                               class="input-field"
                               placeholder="{{ app()->getLocale() === 'sw' ? 'Rudia nywila yako' : 'Repeat your password' }}"
                               required
                               autocomplete="new-password">
                        <button type="button"
                                onclick="togglePassword('password_confirmation', 'eye2')"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                            <svg id="eye2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start gap-3">
                    <input type="checkbox"
                           id="terms"
                           required
                           class="w-4 h-4 mt-0.5 rounded border-gray-300 text-blue-600 cursor-pointer">
                    <label for="terms" class="text-sm text-gray-600 cursor-pointer">
                        {{ __('messages.agree_terms') }}
                        <a href="#" class="text-blue-600 font-semibold hover:underline">
                            {{ __('messages.terms_of_service') }}
                        </a>
                        {{ __('messages.and') }}
                        <a href="#" class="text-blue-600 font-semibold hover:underline">
                            {{ __('messages.privacy_policy') }}
                        </a>
                    </label>
                </div>

                <!-- Register Button -->
                <button type="submit"
                        class="btn-register w-full text-white py-3.5 rounded-xl font-bold text-base tracking-wide shadow-lg">
                    {{ __('messages.create_account_btn') }}
                </button>

                <!-- Divider -->
                <div class="relative flex items-center gap-4">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-gray-400 text-sm">
                        {{ app()->getLocale() === 'sw' ? 'au' : 'or' }}
                    </span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-gray-600 text-sm">
                        {{ __('messages.already_account') }}
                        <a href="{{ route('login') }}"
                           class="text-blue-600 font-bold hover:text-blue-800 transition ml-1">
                            {{ __('messages.sign_in_link') }}
                        </a>
                    </p>
                </div>

                <!-- Back to Home -->
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
function togglePassword(fieldId, iconId) {
    const input = document.getElementById(fieldId);
    const icon  = document.getElementById(iconId);
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