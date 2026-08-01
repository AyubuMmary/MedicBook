<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('messages.register_free') }} — MedicBook</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --ocean-light:  #DFF7FF;
            --ocean-mid:    #7FCDFF;
            --ocean-dark:   #4BB8F0;
            --ocean-deeper: #1A8FCC;
            --ocean-deepest:#0e6fa3;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(160deg, #DFF7FF 0%, #B8ECFF 40%, #7FCDFF 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        h1, .display-font { font-family: 'Poppins', sans-serif; }

        /* ---------- Back to home ---------- */
        .back-home {
            position: fixed;
            top: 24px;
            left: 24px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--ocean-deepest);
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(8px);
            padding: 8px 16px;
            border-radius: 999px;
            border: 1px solid rgba(127,205,255,0.4);
            transition: transform 0.2s ease;
            text-decoration: none;
            z-index: 50;
        }
        .back-home:hover { transform: translateX(-3px); }

        /* ---------- Auth container ---------- */
        .auth-container {
            position: relative;
            width: 100%;
            max-width: 900px;
            min-height: 560px;
            border-radius: 32px;
            overflow: hidden;
            background: rgba(255,255,255,0.85);
            box-shadow: 0 30px 60px -15px rgba(26,143,204,0.35);
            backdrop-filter: blur(10px);
            display: flex;
        }

        .form-panel {
            width: 50%;
            display: flex;
            align-items: center;
            padding: 3rem 3.25rem;
        }

        /* ---------- Promo / overlay panel ---------- */
        .promo-panel {
            width: 50%;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 2.75rem;
            color: white;
            background: linear-gradient(135deg, #1A8FCC 0%, #4BB8F0 45%, #7FCDFF 100%);
            clip-path: polygon(12% 0%, 100% 0%, 100% 100%, 0% 100%, 0% 18%);
            overflow: hidden;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.18);
            animation: float 7s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-18px); }
        }

        /* ---------- Inputs ---------- */
        .field {
            position: relative;
            margin-bottom: 1rem;
        }
        .field input {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.75rem;
            border-radius: 14px;
            border: 1px solid rgba(127,205,255,0.5);
            background: rgba(223,247,255,0.4);
            font-size: 0.9rem;
            color: #0e2a3d;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .field input:focus {
            outline: none;
            border-color: var(--ocean-deeper);
            box-shadow: 0 0 0 3px rgba(75,184,240,0.25);
            background: white;
        }
        .field svg {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: var(--ocean-deeper);
        }
        .field-error {
            color: #e11d48;
            font-size: 0.75rem;
            margin-top: 0.3rem;
        }

        .btn-solid {
            width: 100%;
            padding: 0.9rem;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.95rem;
            color: white;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-solid:hover { transform: translateY(-2px); }

        .btn-register {
            background: linear-gradient(135deg, #059669, #10b981);
            box-shadow: 0 10px 25px -8px rgba(5,150,105,0.5);
        }

        .btn-ghost {
            padding: 0.75rem 2.25rem;
            border-radius: 999px;
            border: 1.5px solid rgba(255,255,255,0.8);
            background: transparent;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            transition: background 0.2s ease, transform 0.2s ease;
        }
        .btn-ghost:hover { background: rgba(255,255,255,0.15); transform: translateY(-2px); }

        @media (max-width: 768px) {
            .auth-container { flex-direction: column-reverse; min-height: auto; }
            .form-panel, .promo-panel { width: 100%; }
            .form-panel { padding: 2.25rem 1.75rem; }
            .promo-panel {
                padding: 2.5rem 1.75rem;
                clip-path: none;
            }
        }
    </style>
</head>
<body>

<a href="{{ route('home') }}" class="back-home">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
    </svg>
    {{ app()->getLocale() === 'sw' ? 'Rudi Nyumbani' : 'Back to home' }}
</a>

<div class="auth-container">

    <!-- ============ SIGN UP FORM ============ -->
    <div class="form-panel">
        <div class="w-full">
            <p class="text-xs font-bold tracking-widest uppercase mb-1" style="color:#10b981;">
                {{ app()->getLocale() === 'sw' ? 'Mgeni Hapa' : 'New around here' }}
            </p>
            <h1 class="text-3xl font-extrabold mb-1" style="color:var(--ocean-deepest);">
                {{ __('messages.register_free') }}
            </h1>
            <p class="text-sm text-gray-500 mb-6">
                {{ app()->getLocale() === 'sw' ? 'Fungua akaunti na uanze kuweka miadi leo.' : 'Create your account and start booking in minutes.' }}
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="field">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ app()->getLocale() === 'sw' ? 'Jina kamili' : 'Full name' }}" required autofocus>
                    @error('name') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div class="field">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ app()->getLocale() === 'sw' ? 'Barua pepe' : 'Email address' }}" required>
                    @error('email') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div class="field">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <input type="password" name="password" placeholder="{{ app()->getLocale() === 'sw' ? 'Nenosiri' : 'Password' }}" required>
                    @error('password') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div class="field">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <input type="password" name="password_confirmation" placeholder="{{ app()->getLocale() === 'sw' ? 'Thibitisha Nenosiri' : 'Confirm password' }}" required>
                </div>

                <button type="submit" class="btn-solid btn-register mt-2">{{ __('messages.register_free') }}</button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                {{ app()->getLocale() === 'sw' ? 'Una akaunti tayari?' : 'Already have an account?' }}
                <a href="{{ route('login') }}" class="font-semibold" style="color:var(--ocean-deeper);">
                    {{ __('messages.login') }}
                </a>
            </p>
        </div>
    </div>

    <!-- ============ PROMO PANEL ============ -->
    <div class="promo-panel">
        <div class="bubble" style="width:70px; height:70px; top:14%; left:18%; animation-delay:.2s;"></div>
        <div class="bubble" style="width:36px; height:36px; top:60%; left:70%; animation-delay:1.3s;"></div>
        <div class="bubble" style="width:22px; height:22px; top:80%; left:30%; animation-delay:.7s;"></div>

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-10 h-10 mb-4 opacity-90">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
        </svg>
        <h1 class="text-2xl font-extrabold mb-3">
            {{ app()->getLocale() === 'sw' ? 'Karibu MedicBook!' : 'Welcome to MedicBook!' }}
        </h1>
        <p class="text-sm mb-7" style="color:#DFF7FF;">
            {{ app()->getLocale() === 'sw' ? 'Tayari una akaunti? Ingia ili kuendelea na miadi yako.' : 'Already have an account? Sign in to continue booking with your doctors.' }}
        </p>
        <a href="{{ route('login') }}" class="btn-ghost">{{ __('messages.login') }}</a>
    </div>

</div>

</body>
</html>