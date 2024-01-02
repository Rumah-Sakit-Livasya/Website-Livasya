<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return view('pages.doctors.index', [
            'title' => 'Dokter',
            'doctors' => Doctor::all()
        ]);
    }
}
