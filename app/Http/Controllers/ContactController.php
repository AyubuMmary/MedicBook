<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Show the contact page.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Handle the contact form submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        // Option A: send an email notification to the support team.
        // Uncomment and configure a Mailable once your mail driver is set up.
        //
        // Mail::to('support@medicbook.com')->send(new \App\Mail\ContactFormSubmitted($validated));

        // Option B (simple fallback): log the submission so nothing is lost
        // even before email sending is configured.
        Log::info('New contact form submission', $validated);

        return back()->with('success', app()->getLocale() === 'sw'
            ? 'Asante! Ujumbe wako umetumwa. Tutakujibu hivi karibuni.'
            : 'Thank you! Your message has been sent. We will get back to you shortly.'
        );
    }
}
