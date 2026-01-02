<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => Hash::make(Str::random(16)), // Dummy password
                    'username' => explode('@', $googleUser->getEmail())[0] . rand(100, 999), // Generate username
                ]);
                $user->assignRole('pelamar');
            } else {
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
                // Ensure they have the role if they login again (optional, but good for returning users)
                if (!$user->hasRole('pelamar') && !$user->hasRole('super-admin') && !$user->hasRole('user')) {
                    $user->assignRole('pelamar');
                }
            }

            Auth::login($user);

            if (!$user->applier) {
                return redirect()->route('applicant.profile.create');
            }

            return redirect()->intended('/dashboard');
        } catch (\Exception $e) {
            return redirect('/bukan-login')->withErrors(['email' => 'Google Login failed: ' . $e->getMessage()]);
        }
    }
}
