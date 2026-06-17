@extends('layouts.app')
@section('title', 'Edit Doctor')
@section('content')

<div class="max-w-4xl mx-auto">

    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.doctors.index') }}"
           class="w-10 h-10 bg-white rounded-full shadow flex items-center justify-center text-gray-600 hover:text-blue-700 transition">
            ←
        </a>
        <div>
            <h2 class="text-3xl font-bold text-gray-800" style="font-family:'Poppins',sans-serif;">
                Edit Doctor
            </h2>
            <p class="text-gray-500 text-sm">Update details for Dr. {{ $doctor->user->name }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.doctors.update', $doctor->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEFT COLUMN - Photo -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow p-6 sticky top-24">
                    <h3 class="font-bold text-gray-700 mb-4 text-center">Doctor Photo</h3>

                    <!-- Current Photo Preview -->
                    <div class="relative mb-4">
                        <div class="w-40 h-40 rounded-full mx-auto overflow-hidden border-4 border-blue-200 shadow-lg">
                            @if($doctor->photo)
                                <img id="preview-img"
                                     src="{{ asset('storage/' . $doctor->photo) }}"
                                     alt="Doctor Photo"
                                     class="w-full h-full object-cover">
                            @else
                                <div id="preview-img"
                                     class="w-full h-full bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center text-6xl">
                                    {{ $doctor->gender === 'female' ? '👩‍⚕️' : '👨‍⚕️' }}
                                </div>
                            @endif
                        </div>

                        <!-- Camera Upload Button -->
                        <label for="photo"
                               class="absolute bottom-0 right-1/2 translate-x-10 translate-y-2 w-10 h-10 bg-blue-700 text-white rounded-full flex items-center justify-center cursor-pointer hover:bg-blue-800 transition shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </label>
                    </div>

                    <input type="file"
                           name="photo"
                           id="photo"
                           accept="image/*"
                           class="hidden"
                           onchange="previewPhoto(this)">

                    <p class="text-center text-xs text-gray-400 mt-6">
                        Click camera to change photo<br>
                        JPG, PNG — Max 2MB
                    </p>

                    <!-- Doctor Info Card -->
                    <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <p class="text-xs text-gray-500 font-semibold mb-2">Current Info</p>
                        <p class="text-sm font-bold text-gray-700">{{ $doctor->user->name }}</p>
                        <p class="text-xs text-blue-600">{{ $doctor->specialization }}</p>
                        <p class="text-xs text-gray-500">{{ $doctor->user->email }}</p>
                        <div class="mt-2">
                            <span class="text-xs px-2 py-1 rounded-full font-semibold
                                {{ $doctor->is_available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $doctor->is_available ? '✅ Available' : '❌ Unavailable' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN - Form Fields -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Personal Information -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h3 class="font-bold text-gray-700 mb-5 flex items-center gap-2 text-lg">
                        <span class="w-8 h-8 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center">👤</span>
                        Personal Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Full Name -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">👤</span>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name', $doctor->user->name) }}"
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white"
                                       required>
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">⚠️ {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">📧</span>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email', $doctor->user->email) }}"
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white"
                                       required>
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">⚠️ {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">📞</span>
                                <input type="text"
                                       name="phone"
                                       value="{{ old('phone', $doctor->user->phone) }}"
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white"
                                       required>
                            </div>
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">⚠️ {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                New Password
                                <span class="text-gray-400 font-normal">(leave blank to keep current)</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">🔒</span>
                                <input type="password"
                                       name="password"
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white"
                                       placeholder="Leave blank to keep current">
                            </div>
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gender</label>
                            <div class="flex gap-3">
                                <label class="flex-1 flex items-center gap-2 border-2 border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-blue-400 transition {{ old('gender', $doctor->gender) === 'male' ? 'border-blue-500 bg-blue-50' : '' }}">
                                    <input type="radio" name="gender" value="male"
                                           {{ old('gender', $doctor->gender) === 'male' ? 'checked' : '' }}
                                           class="text-blue-600">
                                    <span class="text-sm font-medium">👨 Male</span>
                                </label>
                                <label class="flex-1 flex items-center gap-2 border-2 border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-pink-400 transition {{ old('gender', $doctor->gender) === 'female' ? 'border-pink-500 bg-pink-50' : '' }}">
                                    <input type="radio" name="gender" value="female"
                                           {{ old('gender', $doctor->gender) === 'female' ? 'checked' : '' }}
                                           class="text-pink-600">
                                    <span class="text-sm font-medium">👩 Female</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h3 class="font-bold text-gray-700 mb-5 flex items-center gap-2 text-lg">
                        <span class="w-8 h-8 bg-green-100 text-green-700 rounded-lg flex items-center justify-center">🩺</span>
                        Professional Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Specialization -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Specialization <span class="text-red-500">*</span>
                            </label>
                            <select name="specialization"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white"
                                    required>
                                <option value="">-- Select --</option>
                                @foreach([
                                    'General Physician', 'Cardiologist', 'Dermatologist',
                                    'Neurologist', 'Orthopedic', 'Pediatrician',
                                    'Psychiatrist', 'Gynecologist', 'ENT Specialist',
                                    'Ophthalmologist', 'Dentist', 'Urologist',
                                    'Endocrinologist', 'Radiologist', 'Surgeon'
                                ] as $spec)
                                    <option value="{{ $spec }}"
                                        {{ old('specialization', $doctor->specialization) === $spec ? 'selected' : '' }}>
                                        {{ $spec }}
                                    </option>
                                @endforeach
                            </select>
                            @error('specialization')
                                <p class="text-red-500 text-xs mt-1">⚠️ {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Qualification -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Qualification <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">🎓</span>
                                <input type="text"
                                       name="qualification"
                                       value="{{ old('qualification', $doctor->qualification) }}"
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white"
                                       required>
                            </div>
                            @error('qualification')
                                <p class="text-red-500 text-xs mt-1">⚠️ {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Experience -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Years of Experience
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">⭐</span>
                                <select name="experience"
                                        class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white">
                                    <option value="">-- Select --</option>
                                    @for($i = 1; $i <= 40; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('experience', $doctor->experience) == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i === 1 ? 'Year' : 'Years' }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Consultation Fee -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Consultation Fee (TSh) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-xs">TSh</span>
                                <input type="number"
                                       name="consultation_fee"
                                       value="{{ old('consultation_fee', $doctor->consultation_fee) }}"
                                       class="w-full pl-14 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white"
                                       min="0"
                                       step="0.01"
                                       required>
                            </div>
                            @error('consultation_fee')
                                <p class="text-red-500 text-xs mt-1">⚠️ {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Doctor Bio / About
                            </label>
                            <textarea name="bio"
                                      rows="4"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white resize-none"
                                      placeholder="Write a short bio...">{{ old('bio', $doctor->bio) }}</textarea>
                        </div>

                        <!-- Availability Toggle -->
                        <div class="md:col-span-2">
                            <label class="flex items-center gap-4 cursor-pointer p-4 rounded-xl border-2 transition
                                {{ $doctor->is_available ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }}">
                                <input type="checkbox"
                                       name="is_available"
                                       value="1"
                                       {{ old('is_available', $doctor->is_available) ? 'checked' : '' }}
                                       class="w-5 h-5 text-green-600 rounded">
                                <div>
                                    <p class="font-semibold {{ $doctor->is_available ? 'text-green-700' : 'text-red-700' }}">
                                        {{ $doctor->is_available ? '✅ Currently Available' : '❌ Currently Unavailable' }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Check to make doctor visible to patients for booking
                                    </p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <button type="submit"
                            class="flex-1 py-4 rounded-xl font-bold text-white text-lg shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl"
                            style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                        💾 Save Changes
                    </button>
                    <a href="{{ route('admin.doctors.index') }}"
                       class="flex-1 py-4 rounded-xl font-bold text-gray-700 text-lg bg-gray-100 hover:bg-gray-200 transition text-center">
                        ✕ Cancel
                    </a>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview-img');
            preview.src = e.target.result;
            preview.className = 'w-full h-full object-cover';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection