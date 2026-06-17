<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    // ==================== SHOW REGISTER FORM ====================
    public function create(): View
    {
        return view('auth.register');
    }

    // ==================== HANDLE REGISTRATION ====================
    public function store(Request $request): RedirectResponse
    {
        // Validate input
        $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'              => ['required', 'confirmed', Rules\Password::defaults()],
            'phone'                 => ['nullable', 'string', 'max:20'],
        ]);

        // Create user as patient by default
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone ?? null,
            'role'     => 'patient',
        ]);

        // Fire registered event
        event(new Registered($user));

        // Login the user
        Auth::login($user);

        // Redirect based on role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('success', '✅ Welcome back Admin!');
        }

        if ($user->isDoctor()) {
            return redirect()->route('home')
                ->with('success', '✅ Welcome Dr. ' . $user->name . '!');
        }

        // Default - patient goes to home
        return redirect()->route('home')
            ->with('success', '✅ Welcome to MedicBook, ' . $user->name . '! You can now book appointments.');
    }
}