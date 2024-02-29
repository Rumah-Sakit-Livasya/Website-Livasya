<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Identity;
use App\Models\Pelayanan;

class JadwalDokterController extends Controller
{
    public function show(Request $request, Identity $identity, Doctor $dokter)
    {
        // return $dokter;
        return view('dokter', [
            'name' => $identity->name,
            'title' => 'Dokter',
            'identity' => Identity::first(),
            'dokter' => $dokter,
            'pelayanan' => Pelayanan::all()
        ]);
    }
}
