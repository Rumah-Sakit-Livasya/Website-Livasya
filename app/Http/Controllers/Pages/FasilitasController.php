<?php

namespace App\Http\Controllers\Pages;

use App\Models\About;
use App\Models\Facility;
use App\Models\Fasilitas;
use App\Models\Identity;
use App\Models\Pelayanan;
use Illuminate\Routing\Controller;

class FasilitasController extends Controller
{
    public function index(Identity $about)
    {
        return view('fasilitas.index', [
            'title' => 'Fasilitas Unggulan',
            'name' => $about->nama_instansi,
            'about' => Identity::first(),
            'pelayanan' => Pelayanan::all(),
            'facilities' => Facility::where('unggulan', 1)->get()
        ]);
    }

    public function lainnya(Identity $about)
    {
        return view('fasilitas.index', [
            'title' => 'Fasilitas Lainnya',
            'name' => $about->nama_instansi,
            'about' => Identity::first(),
            'pelayanan' => Pelayanan::all(),
            'facilities' => Facility::where('unggulan', 0)->get()
        ]);
    }

    public function show(Facility $facility)
    {
        return view('fasilitas.show', [
            'title' => $facility->name,
            'name' => 'RSIA Livasya',
            'fasilitas' => $facility,
            'about' => Identity::first(),
            'pelayanan' => Pelayanan::all()
        ]);
    }
}
