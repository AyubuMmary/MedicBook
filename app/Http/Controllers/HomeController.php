<?php
namespace App\Http\Controllers;

use App\Models\Doctor;

class HomeController extends Controller
{
   public function index()
{
    $doctors = Doctor::with('user')
        ->whereHas('user')
        ->where('is_available', true)
        ->latest()
        ->take(6)
        ->get();

    return view('home', compact('doctors'));
}

public function doctors()
{
    $doctors = Doctor::with('user')
        ->whereHas('user')
        ->where('is_available', true)
        ->paginate(9);

    return view('doctors.index', compact('doctors'));
}
    public function doctorShow($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('doctors.show', compact('doctor'));
    }
}