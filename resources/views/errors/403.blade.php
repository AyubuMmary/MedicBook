<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied — MedicBook</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4"
      style="font-family:'Inter',sans-serif;">

    <div class="max-w-lg w-full text-center">

        <!-- Icon -->
        <div class="text-9xl mb-6">🚫</div>

        <!-- Error Code -->
        <h1 class="text-8xl font-black mb-4"
            style="font-family:'Poppins',sans-serif;
                   background: linear-gradient(135deg, #dc2626, #ef4444);
                   -webkit-background-clip: text;
                   -webkit-text-fill-color: transparent;">
            403
        </h1>

        <!-- Title -->
        <h2 class="text-3xl font-bold text-gray-800 mb-3"
            style="font-family:'Poppins',sans-serif;">
            Access Denied!
        </h2>

        <!-- Message -->
        <p class="text-gray-500 text-lg mb-8 leading-relaxed">
            Sorry, you don't have permission to access this page.
            This area is restricted to <strong>Administrators only</strong>.
        </p>

        <!-- User Info -->
        @auth
        <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-8 inline-block">
            <p class="text-red-600 text-sm">
                You are logged in as <strong>{{ auth()->user()->name }}</strong>
                with role <strong class="uppercase">{{ auth()->user()->role }}</strong>
            </p>
        </div>
        @endauth

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}"
               class="px-8 py-3 rounded-xl font-bold text-white shadow-lg transition hover:-translate-y-0.5"
               style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                🏠 Go to Home
            </a>
            <a href="javascript:history.back()"
               class="px-8 py-3 rounded-xl font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 transition">
                ← Go Back
            </a>
        </div>

        <!-- Logo -->
        <div class="mt-10">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                <svg width="32" height="32" viewBox="0 0 48 48" fill="none">
                    <circle cx="24" cy="24" r="23" fill="#1d4ed8" fill-opacity="0.15"/>
                    <rect x="10" y="21" width="28" height="6.5" rx="3.25" fill="#1d4ed8"/>
                    <rect x="21" y="10" width="6.5" height="28" rx="3.25" fill="#1d4ed8"/>
                    <circle cx="37" cy="37" r="9" fill="#F59E0B"/>
                    <path d="M37 41C37 41 32 37.5 32 34.8C32 33 33.3 31.5 35 31.5C35.9 31.5 36.7 31.9 37 32.6C37.3 31.9 38.1 31.5 39 31.5C40.7 31.5 42 33 42 34.8C42 37.5 37 41 37 41Z" fill="white"/>
                </svg>
                <span style="font-family:'Poppins',sans-serif;font-weight:800;font-size:1.2rem;color:#1d4ed8;">
                    Medic<span style="color:#f59e0b;">Book</span>
                </span>
            </a>
        </div>
    </div>

</body>
</html>