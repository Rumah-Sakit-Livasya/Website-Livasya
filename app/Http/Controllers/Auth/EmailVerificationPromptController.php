<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $identity = \App\Models\Identity::first();
        $pelayanan = \App\Models\Pelayanan::all();
        $mitras = \App\Models\Mitra::where('is_primary', 1)->get();
        $title = "Verifikasi Email";

        return view('auth.verify-email', compact('identity', 'pelayanan', 'mitras', 'title'));
    }
}
