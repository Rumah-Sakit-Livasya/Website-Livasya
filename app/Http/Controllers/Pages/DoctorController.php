<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Doctor;
use App\Models\Identity;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        $departements = Departement::where('is_active', 1)->get();

        return view('pages.doctors.index', compact('doctors', 'departements'), [
            'title' => 'Dokter'
        ]);
    }
}
