@extends('layouts.app')
@section('title', 'Manage Doctors')
@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800" style="font-family:'Poppins',sans-serif;">
                👨‍⚕️ Manage Doctors
            </h2>
            <p class="text-gray-500 text-sm mt-1">Add, edit and manage all doctors</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.dashboard') }}"
               class="bg-gray-100 text-gray-700 px-4 py-2.5 rounded-xl hover:bg-gray-200 transition font-semibold text-sm">
                ← Dashboard
            </a>
            <a href="{{ route('admin.doctors.create') }}"
               class="text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow transition hover:-translate-y-0.5 hover:shadow-lg"
               style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                + Add New Doctor
            </a>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl shadow p-4 text-center border-b-4 border-blue-500">
            <p class="text-3xl font-extrabold text-blue-700">{{ $doctors->total() }}</p>
            <p class="text-gray-500 text-sm mt-1">Total Doctors</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-4 text-center border-b-4 border-green-500">
            <p class="text-3xl font-extrabold text-green-600">
                {{ $doctors->filter(fn($d) => $d->is_available)->count() }}
            </p>
            <p class="text-gray-500 text-sm mt-1">Available</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-4 text-center border-b-4 border-red-500">
            <p class="text-3xl font-extrabold text-red-600">
                {{ $doctors->filter(fn($d) => !$d->is_available)->count() }}
            </p>
            <p class="text-gray-500 text-sm mt-1">Unavailable</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-4 text-center border-b-4 border-purple-500">
            <p class="text-3xl font-extrabold text-purple-600">
                {{ $doctors->pluck('specialization')->unique()->count() }}
            </p>
            <p class="text-gray-500 text-sm mt-1">Specializations</p>
        </div>
    </div>

    <!-- Doctors Table -->
    @if($doctors->isEmpty())
        <div class="bg-white rounded-2xl shadow p-16 text-center">
            <div class="text-8xl mb-6">👨‍⚕️</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">No Doctors Yet</h3>
            <p class="text-gray-500 mb-6">Start by adding your first doctor to the system.</p>
            <a href="{{ route('admin.doctors.create') }}"
               class="inline-block text-white px-8 py-3 rounded-xl font-bold shadow"
               style="background: linear-gradient(135deg, #1d4ed8, #4f46e5);">
                + Add First Doctor
            </a>
        </div>

    @else
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-700">All Doctors ({{ $doctors->total() }})</h3>
                <p class="text-sm text-gray-400">Page {{ $doctors->currentPage() }} of {{ $doctors->lastPage() }}</p>
            </div>

            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">#</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Doctor</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Specialization</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Qualification</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Experience</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Fee</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($doctors as $index => $doctor)
                        <tr class="hover:bg-blue-50 transition">

                            <!-- Number -->
                            <td class="px-6 py-4 text-gray-400 font-medium">
                                {{ ($doctors->currentPage() - 1) * $doctors->perPage() + $loop->iteration }}
                            </td>

                            <!-- Doctor Info -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($doctor->photo)
                                        <img src="{{ asset('storage/' . $doctor->photo) }}"
                                             alt="{{ $doctor->user->name }}"
                                             class="w-12 h-12 rounded-full object-cover border-2 border-blue-100 shadow-sm">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-100 to-indigo-200 flex items-center justify-center text-2xl shadow-sm">
                                            {{ $doctor->gender === 'female' ? '👩‍⚕️' : '👨‍⚕️' }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-gray-800">
                                            {{ str_starts_with($doctor->user->name, 'Dr.') ? $doctor->user->name : 'Dr. ' . $doctor->user->name }}
                                        </p>
                                        <p class="text-gray-400 text-xs">{{ $doctor->user->email }}</p>
                                        <p class="text-gray-400 text-xs">{{ $doctor->user->phone }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Specialization -->
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $doctor->specialization }}
                                </span>
                            </td>

                            <!-- Qualification -->
                            <td class="px-6 py-4 text-gray-600 font-medium">
                                {{ $doctor->qualification }}
                            </td>

                            <!-- Experience -->
                            <td class="px-6 py-4 text-gray-600">
                                @if($doctor->experience)
                                    <span class="flex items-center gap-1">
                                        ⭐ {{ $doctor->experience }} {{ $doctor->experience == 1 ? 'yr' : 'yrs' }}
                                    </span>
                                @else
                                    <span class="text-gray-300">—</span>
                                @endif
                            </td>

                            <!-- Fee -->
                            <td class="px-6 py-4">
                                <span class="text-green-700 font-bold">
                                    TSh {{ number_format($doctor->consultation_fee) }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4">
                                @if($doctor->is_available)
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit">
                                        <span class="w-2 h-2 bg-green-500 rounded-full inline-block"></span>
                                        Available
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit">
                                        <span class="w-2 h-2 bg-red-500 rounded-full inline-block"></span>
                                        Unavailable
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4">
                                <div class="flex gap-2 flex-wrap">

                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.doctors.edit', $doctor->id) }}"
                                       class="bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg hover:bg-blue-200 font-semibold text-xs transition flex items-center gap-1">
                                        ✏️ Edit
                                    </a>

                                    <!-- Toggle Availability -->
                                    <form method="POST" action="{{ route('admin.doctors.toggle', $doctor->id) }}">
                                        @csrf
                                        <button type="submit"
                                                class="text-xs font-semibold px-3 py-1.5 rounded-lg transition flex items-center gap-1
                                                {{ $doctor->is_available
                                                    ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200'
                                                    : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                                            {{ $doctor->is_available ? '🔴 Disable' : '🟢 Enable' }}
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form method="POST"
                                          action="{{ route('admin.doctors.destroy', $doctor->id) }}"
                                          onsubmit="return confirm('⚠️ Are you sure you want to delete Dr. {{ $doctor->user->name }}? This cannot be undone!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-100 text-red-700 px-3 py-1.5 rounded-lg hover:bg-red-200 font-semibold text-xs transition flex items-center gap-1">
                                            🗑️ Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="md:hidden divide-y divide-gray-100">
                @foreach($doctors as $doctor)
                <div class="p-4">
                    <div class="flex items-center gap-3 mb-3">
                        @if($doctor->photo)
                            <img src="{{ asset('storage/' . $doctor->photo) }}"
                                 class="w-14 h-14 rounded-full object-cover border-2 border-blue-100">
                        @else
                            <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-3xl">
                                {{ $doctor->gender === 'female' ? '👩‍⚕️' : '👨‍⚕️' }}
                            </div>
                        @endif
                        <div class="flex-1">
                            <p class="font-bold text-gray-800">
                                {{ str_starts_with($doctor->user->name, 'Dr.') ? $doctor->user->name : 'Dr. ' . $doctor->user->name }}
                            </p>
                            <p class="text-blue-600 text-sm">{{ $doctor->specialization }}</p>
                            <p class="text-gray-400 text-xs">{{ $doctor->user->email }}</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $doctor->is_available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $doctor->is_available ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div class="grid grid-cols-3 gap-2 mb-3 text-xs text-gray-600">
                        <div class="bg-gray-50 rounded-lg p-2 text-center">
                            <p class="font-semibold">{{ $doctor->qualification }}</p>
                            <p class="text-gray-400">Qualification</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-2 text-center">
                            <p class="font-semibold">{{ $doctor->experience ?? '—' }} {{ $doctor->experience ? 'yrs' : '' }}</p>
                            <p class="text-gray-400">Experience</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-2 text-center">
                            <p class="font-semibold text-green-700">TSh {{ number_format($doctor->consultation_fee) }}</p>
                            <p class="text-gray-400">Fee</p>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}"
                           class="flex-1 text-center bg-blue-100 text-blue-700 py-2 rounded-lg font-semibold text-xs hover:bg-blue-200 transition">
                            ✏️ Edit
                        </a>
                        <form method="POST" action="{{ route('admin.doctors.toggle', $doctor->id) }}" class="flex-1">
                            @csrf
                            <button type="submit"
                                    class="w-full py-2 rounded-lg font-semibold text-xs transition
                                    {{ $doctor->is_available ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                {{ $doctor->is_available ? '🔴 Disable' : '🟢 Enable' }}
                            </button>
                        </form>
                        <form method="POST"
                              action="{{ route('admin.doctors.destroy', $doctor->id) }}"
                              class="flex-1"
                              onsubmit="return confirm('Delete this doctor?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full bg-red-100 text-red-700 py-2 rounded-lg font-semibold text-xs hover:bg-red-200 transition">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($doctors->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $doctors->links() }}
            </div>
            @endif

        </div>
    @endif
</div>

@endsection