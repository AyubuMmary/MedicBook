@extends('layouts.app')
@section('title', 'Add New Doctor')
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
                Add New Doctor
            </h2>
            <p class="text-gray-500 text-sm">Fill in all details to register a new doctor</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEFT COLUMN - Photo Upload -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow p-6 sticky top-24">
                    <h3 class="font-bold text-gray-700 mb-4 text-center">Doctor Photo</h3>

                    <!-- Photo Preview -->
                    <div class="relative mb-4">
                        <div id="photo-preview"
                             class="w-40 h-40 rounded-full mx-auto bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center overflow-hidden border-4 border-blue-200 shadow-lg">
                            <span id="preview-placeholder" class="text-6xl">👨‍⚕️</span>
                            <img id="preview-img" src="" alt="" class="hidden w-full h-full object-cover">
                        </div>
                        <!-- Upload button overlay -->
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

                    <p class="text-center text-xs text-gray-400 mt-4">
                        Click the camera icon to upload<br>
                        JPG, PNG — Max 2MB
                    </p>

                    <!-- Doctor ID Preview -->
                    <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-100">
                        <p class="text-xs text-blue-600 font-semibold mb-2 text-center">
                            Doctor will receive login credentials
                        </p>
                        <div class="text-xs text-blue-500 space-y-1">
                            <p>✅ Can login to system</p>
                            <p>✅ Has doctor dashboard</p>
                            <p>✅ Patients can book them</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN - Form Fields -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Personal Information -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h3 class="font-bold text-gray-700 mb-5 flex items-center gap-2 text-lg">
                        <span class="w-8 h-8 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center text-sm">👤</span>
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
                                       value="{{ old('name') }}"
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white @error('name') border-red-400 @enderror"
                                       placeholder="Dr. John Smith"
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
                                       value="{{ old('email') }}"
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white @error('email') border-red-400 @enderror"
                                       placeholder="doctor@medicbook.com"
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
                                       value="{{ old('phone') }}"
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white @error('phone') border-red-400 @enderror"
                                       placeholder="+255 712 345 678"
                                       required>
                            </div>
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">⚠️ {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Login Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">🔒</span>
                                <input type="password"
                                       name="password"
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white @error('password') border-red-400 @enderror"
                                       placeholder="Min. 8 characters"
                                       required>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">⚠️ {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Gender <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-3">
                                <label class="flex-1 flex items-center gap-2 border-2 border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-blue-400 transition has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                                    <input type="radio" name="gender" value="male" class="text-blue-600" {{ old('gender') === 'male' ? 'checked' : '' }}>
                                    <span class="text-sm font-medium">👨 Male</span>
                                </label>
                                <label class="flex-1 flex items-center gap-2 border-2 border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-pink-400 transition has-[:checked]:border-pink-500 has-[:checked]:bg-pink-50">
                                    <input type="radio" name="gender" value="female" class="text-pink-600" {{ old('gender') === 'female' ? 'checked' : '' }}>
                                    <span class="text-sm font-medium">👩 Female</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h3 class="font-bold text-gray-700 mb-5 flex items-center gap-2 text-lg">
                        <span class="w-8 h-8 bg-green-100 text-green-700 rounded-lg flex items-center justify-center text-sm">🩺</span>
                        Professional Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Specialization -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Specialization <span class="text-red-500">*</span>
                            </label>
                            <select name="specialization"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white @error('specialization') border-red-400 @enderror"
                                    required>
                                <option value="">-- Select Specialization --</option>
                                <optgroup label="Common Specialties">
                                    <option value="General Physician" {{ old('specialization') === 'General Physician' ? 'selected' : '' }}>🩺 General Physician</option>
                                    <option value="Cardiologist" {{ old('specialization') === 'Cardiologist' ? 'selected' : '' }}>❤️ Cardiologist</option>
                                    <option value="Dermatologist" {{ old('specialization') === 'Dermatologist' ? 'selected' : '' }}>🧴 Dermatologist</option>
                                    <option value="Neurologist" {{ old('specialization') === 'Neurologist' ? 'selected' : '' }}>🧠 Neurologist</option>
                                    <option value="Orthopedic" {{ old('specialization') === 'Orthopedic' ? 'selected' : '' }}>🦴 Orthopedic</option>
                                    <option value="Pediatrician" {{ old('specialization') === 'Pediatrician' ? 'selected' : '' }}>🧒 Pediatrician</option>
                                    <option value="Psychiatrist" {{ old('specialization') === 'Psychiatrist' ? 'selected' : '' }}>🧘 Psychiatrist</option>
                                    <option value="Gynecologist" {{ old('specialization') === 'Gynecologist' ? 'selected' : '' }}>👶 Gynecologist</option>
                                </optgroup>
                                <optgroup label="Other Specialties">
                                    <option value="ENT Specialist" {{ old('specialization') === 'ENT Specialist' ? 'selected' : '' }}>👂 ENT Specialist</option>
                                    <option value="Ophthalmologist" {{ old('specialization') === 'Ophthalmologist' ? 'selected' : '' }}>👁️ Ophthalmologist</option>
                                    <option value="Dentist" {{ old('specialization') === 'Dentist' ? 'selected' : '' }}>🦷 Dentist</option>
                                    <option value="Urologist" {{ old('specialization') === 'Urologist' ? 'selected' : '' }}>🔬 Urologist</option>
                                    <option value="Endocrinologist" {{ old('specialization') === 'Endocrinologist' ? 'selected' : '' }}>⚗️ Endocrinologist</option>
                                    <option value="Radiologist" {{ old('specialization') === 'Radiologist' ? 'selected' : '' }}>🔭 Radiologist</option>
                                    <option value="Surgeon" {{ old('specialization') === 'Surgeon' ? 'selected' : '' }}>🔪 Surgeon</option>
                                </optgroup>
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
                                       value="{{ old('qualification') }}"
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white @error('qualification') border-red-400 @enderror"
                                       placeholder="MBBS, MD, PhD..."
                                       required>
                            </div>
                            @error('qualification')
                                <p class="text-red-500 text-xs mt-1">⚠️ {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Experience -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Years of Experience <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">⭐</span>
                                <select name="experience"
                                        class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white">
                                    <option value="">-- Select --</option>
                                    @for($i = 1; $i <= 40; $i++)
                                        <option value="{{ $i }}" {{ old('experience') == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i === 1 ? 'Year' : 'Years' }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Consultation Fee -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Consultation Fee ($) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 font-bold">$</span>
                                <input type="number"
                                       name="consultation_fee"
                                       value="{{ old('consultation_fee') }}"
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-50 transition bg-gray-50 focus:bg-white @error('consultation_fee') border-red-400 @enderror"
                                       placeholder="50"
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
                                      placeholder="Write a short bio about the doctor — experience, expertise, achievements...">{{ old('bio') }}</textarea>
                        </div>

                        <!-- Availability Toggle -->
                        <div class="md:col-span-2">
                            <label class="flex items-center gap-4 cursor-pointer p-4 bg-green-50 rounded-xl border-2 border-green-200 hover:border-green-400 transition">
                                <input type="checkbox"
                                       name="is_available"
                                       value="1"
                                       checked
                                       class="w-5 h-5 text-green-600 rounded">
                                <div>
                                    <p class="font-semibold text-green-700">✅ Mark as Available</p>
                                    <p class="text-green-600 text-xs">Doctor will be visible to patients for booking</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex gap-4">
                    <button type="submit"
                            class="flex-1 py-4 rounded-xl font-bold text-white text-lg shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl"
                            style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                        ✅ Add Doctor
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
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('preview-img').classList.remove('hidden');
            document.getElementById('preview-placeholder').classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection