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
                // User baru: buat akun dan assign role pelamar
                $user = User::create([
                    'name'      => $googleUser->getName(),
                    'email'     => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar'    => $googleUser->getAvatar(),
                    'password'  => Hash::make(Str::random(16)),
                    'username'  => explode('@', $googleUser->getEmail())[0] . rand(100, 999),
                ]);
                $user->email_verified_at = now();
                $user->save();
            } else {
                // User sudah ada: update data Google
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar'    => $googleUser->getAvatar(),
                ]);

                if (is_null($user->email_verified_at)) {
                    $user->email_verified_at = now();
                    $user->save();
                }
            }

            // Login Google SELALU jadi pelamar
            $user->syncRoles(['pelamar']);

            Auth::login($user);

            if (!$user->applier) {
                return redirect()->route('applicant.profile.create');
            }

            return redirect()->route('applicant.dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login.pelamar')->withErrors(['email' => 'Google Login gagal. Silakan coba lagi. Error: ' . $e->getMessage()]);
        }
    }
}
