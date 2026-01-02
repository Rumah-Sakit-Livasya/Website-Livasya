<?php

namespace App\Http\Controllers;

use App\Models\Identity;
use App\Models\Mitra;
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'name' => 'Rumah Sakit Livasya',
            'title' => 'Login Admin',
        ]);
    }

    public function applicantLogin()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        return view('auth.login-pelamar', [
            'title' => 'Login Pelamar',
            'identity' => $identity,
            'pelayanan' => $pelayanan,
            'mitras' => $mitras,
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|min:5|max:255',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);
        unset($credentials['captcha']); // Remove captcha from credentials for Auth::attempt

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
