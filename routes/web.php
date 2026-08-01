<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDoctorController;
use App\Http\Controllers\Admin\AdminAppointmentController;
use App\Http\Controllers\Admin\AdminPatientController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ContactController;
// Language Switcher
Route::get('/lang/{lang}', [LanguageController::class, 'switch'])->name('lang.switch');

// ========== DASHBOARD REDIRECT ==========
Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

// ========== PUBLIC ROUTES ==========
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/doctors', [HomeController::class, 'doctors'])->name('doctors.index');
Route::get('/doctors/{id}', [HomeController::class, 'doctorShow'])->name('doctors.show');

// ========== AUTH ROUTES ==========
require __DIR__.'/auth.php';

// ========== PATIENT ROUTES ==========
Route::middleware('auth')->group(function () {
    Route::get('/book/{doctorId}', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/my-appointments', [AppointmentController::class, 'myAppointments'])->name('appointments.my');
    Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::post('/appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

    // Patient Dashboard
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');


    Route::get('/payment/{appointmentId}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/{appointmentId}/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/{appointmentId}/success', [PaymentController::class, 'success'])->name('payment.success');
});

// ========== ADMIN ROUTES ==========
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Doctors
    Route::get('/doctors', [AdminDoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/create', [AdminDoctorController::class, 'create'])->name('doctors.create');
    Route::post('/doctors', [AdminDoctorController::class, 'store'])->name('doctors.store');
    Route::get('/doctors/{id}', [AdminDoctorController::class, 'show'])->name('doctors.show');
    Route::get('/doctors/{id}/edit', [AdminDoctorController::class, 'edit'])->name('doctors.edit');
    Route::put('/doctors/{id}', [AdminDoctorController::class, 'update'])->name('doctors.update');
    Route::delete('/doctors/{id}', [AdminDoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::post('/doctors/{id}/toggle', [AdminDoctorController::class, 'toggleAvailability'])->name('doctors.toggle');

    // Appointments
    Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments/{id}/status/{status}', [AdminAppointmentController::class, 'updateStatus'])->name('appointments.status');

    // Patients
    Route::get('/patients', [AdminPatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/{id}', [AdminPatientController::class, 'show'])->name('patients.show');
    Route::delete('/patients/{id}', [AdminPatientController::class, 'destroy'])->name('patients.destroy');

    // Payments
    Route::get('/payments', [AdminPaymentController::class, 'index'])->name('payments.index');

    // routes/web.php
Route::get('/login', fn () => view('auth.login-register', ['mode' => 'login']))->name('login');
Route::get('/register', fn () => view('auth.login-register', ['mode' => 'register']))->name('register');

// Add these lines to routes/web.php

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});
