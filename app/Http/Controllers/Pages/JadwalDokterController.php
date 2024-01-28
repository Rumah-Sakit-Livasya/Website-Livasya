<?php

namespace App\Http\Controllers\Pages;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Dokter;
use App\Models\Identity;
use App\Models\Pelayanan;

class JadwalDokterController extends Controller
{
    public function show(Request $request, Identity $about, Doctor $dokter)
    {
        // return $dokter;
        return view('dokter', [
            'name' => $about->nama_instansi,
            'title' => 'Dokter',
            'about' => Identity::first(),
            'dokter' => $dokter,
            'pelayanan' => Pelayanan::all()
        ]);
    }
}
