<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminDoctorController extends Controller
{
  public function index()
{
    $doctors = Doctor::with('user')
        ->whereHas('user')
        ->latest()
        ->paginate(10);

    return view('admin.doctors.index', compact('doctors'));
}
    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|min:8',
            'phone'            => 'required|string|max:20',
            'gender'           => 'nullable|in:male,female',
            'specialization'   => 'required|string',
            'qualification'    => 'required|string|max:255',
            'experience'       => 'nullable|integer|min:0|max:60',
            'consultation_fee' => 'required|numeric|min:0',
            'bio'              => 'nullable|string|max:1000',
            'photo'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'role'     => 'doctor',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('doctors', 'public');
        }

        Doctor::create([
            'user_id'          => $user->id,
            'specialization'   => $request->specialization,
            'qualification'    => $request->qualification,
            'experience'       => $request->experience ?? null,
            'consultation_fee' => $request->consultation_fee,
            'bio'              => $request->bio,
            'photo'            => $photoPath,
            'gender'           => $request->gender,
            'is_available'     => $request->has('is_available') ? true : false,
        ]);

        return redirect()->route('admin.doctors.index')
            ->with('success', '✅ Doctor ' . $request->name . ' added successfully!');
    }

    public function edit($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);

        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $doctor->user->id,
            'phone'            => 'required|string|max:20',
            'gender'           => 'nullable|in:male,female',
            'specialization'   => 'required|string',
            'qualification'    => 'required|string|max:255',
            'experience'       => 'nullable|integer|min:0|max:60',
            'consultation_fee' => 'required|numeric|min:0',
            'bio'              => 'nullable|string|max:1000',
            'photo'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $doctor->user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if ($request->filled('password')) {
            $doctor->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $photoPath = $doctor->photo;
        if ($request->hasFile('photo')) {
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $photoPath = $request->file('photo')->store('doctors', 'public');
        }

        $doctor->update([
            'specialization'   => $request->specialization,
            'qualification'    => $request->qualification,
            'experience'       => $request->experience ?? null,
            'consultation_fee' => $request->consultation_fee,
            'bio'              => $request->bio,
            'photo'            => $photoPath,
            'gender'           => $request->gender,
            'is_available'     => $request->has('is_available') ? true : false,
        ]);

        return redirect()->route('admin.doctors.index')
            ->with('success', '✅ Doctor updated successfully!');
    }

    public function destroy($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);

        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }

        $doctor->user->delete();

        return back()->with('success', '✅ Doctor deleted successfully.');
    }

    public function toggleAvailability($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update(['is_available' => !$doctor->is_available]);
        $status = $doctor->is_available ? 'Available' : 'Unavailable';
        return back()->with('success', "✅ Doctor marked as {$status}.");
    }

    public function show($id)
    {
        $doctor = Doctor::with(['user', 'appointments.patient'])->findOrFail($id);
        $totalAppointments     = $doctor->appointments()->count();
        $completedAppointments = $doctor->appointments()->where('status', 'completed')->count();
        $pendingAppointments   = $doctor->appointments()->where('status', 'pending')->count();

        return view('admin.doctors.show', compact(
            'doctor',
            'totalAppointments',
            'completedAppointments',
            'pendingAppointments'
        ));
    }
}