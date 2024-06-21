<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Identity;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();

        return view('pages.doctors.index', compact('doctors'), [
            'title' => 'Dokter'
        ]);
    }
}
