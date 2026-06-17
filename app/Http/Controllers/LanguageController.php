<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request, $lang)
    {
        // Only allow English and Swahili
        if (!in_array($lang, ['en', 'sw'])) {
            $lang = 'en';
        }

        session(['locale' => $lang]);

        return back()->with('success',
            $lang === 'sw'
                ? '🇹🇿 Lugha imebadilishwa kuwa Kiswahili!'
                : '🇬🇧 Language switched to English!'
        );
    }
}