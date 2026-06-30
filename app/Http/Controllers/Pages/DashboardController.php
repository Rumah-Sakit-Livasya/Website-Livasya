<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Applier;
use App\Models\Post;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\Departement;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $data = [];

        if ($user->hasRole('super-admin') || $user->hasRole('user')) {
            $data = [
                'total_careers' => Career::count(),
                'total_posts' => Post::count(),
                'total_doctors' => Doctor::count(),
                'total_users' => User::count(),
                'total_appliers' => Applier::count(),
            ];
        } elseif ($user->hasRole('hrd')) {
            $data = [
                'total_careers' => Career::where('status', 'on')->count(),
                'total_appliers' => Applier::count(),
                'processed_appliers' => Applier::where('status', 'processed')->count(),
                'accepted_appliers' => Applier::where('status', 'accepted')->count(),
                'rejected_appliers' => Applier::where('status', 'rejected')->count(),
                'latest_appliers' => Applier::with(['career', 'user'])->latest()->limit(5)->get(),
            ];
        } elseif ($user->hasRole('marketing')) {
            $data = [
                'total_posts' => Post::count(),
                'total_categories' => Category::count(),
                'total_doctors' => Doctor::count(),
                'total_departments' => Departement::count(),
                'total_facilities' => Facility::count(),
                'latest_posts' => Post::latest()->limit(5)->get(),
            ];
        }

        return view('dashboard', compact('data', 'user'));
    }
}
