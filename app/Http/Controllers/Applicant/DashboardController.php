<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Redirect to profile completion if data is missing
        if (!$user->applier) {
            return redirect()->route('applicant.profile.create')->with('warning', 'Silahkan lengkapi data diri Anda terlebih dahulu.');
        }

        if (empty($user->applier->id_card) || empty($user->applier->phone)) {
            return redirect()->route('applicant.profile.edit')->with('warning', 'Silahkan lengkapi data diri Anda terlebih dahulu.');
        }

        $careers = \App\Models\Career::where('status', 'on')->latest()->get();
        return view('applicant.dashboard', compact('user', 'careers'));
    }

    public function vacancies()
    {
        $user = Auth::user();
        $careers = \App\Models\Career::where('status', 'on')->latest()->get();
        return view('applicant.vacancies', compact('user', 'careers'));
    }

    public function storeApply(Request $request)
    {
        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'education_id' => 'required',
            'expected_salary' => 'required',
        ]);

        $applier = Auth::user()->applier;

        if (!$applier) {
            return back()->with('error', 'Silahkan lengkapi profil terlebih dahulu.');
        }

        // Update Career and Salary
        $applier->update([
            'career_id' => $request->career_id,
            'compensation_salary' => $request->expected_salary,
            'status' => 'processed',
        ]);

        return back()->with('success', 'Lamaran berhasil dikirim! Semoga sukses.');
    }
}
