<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Switch the application locale.
     *
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switch($locale)
    {
        // List of supported locales
        $supportedLocales = ['en', 'km', 'zh'];

        // Check if the locale is supported
        if (in_array($locale, $supportedLocales)) {
            // Store the locale in session
            session(['locale' => $locale]);

            // Set the application locale
            app()->setLocale($locale);
        }

        // Redirect back to the previous page
        return redirect()->back();
    }
}
