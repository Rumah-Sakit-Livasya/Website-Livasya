<?php

namespace App\Http\Controllers\Pages;

use App\Models\Facility;
use App\Models\Identity;
use App\Models\Pelayanan;
use Illuminate\Routing\Controller;

class FasilitasController extends Controller
{
    public function index(Identity $identity)
    {
        return view('fasilitas.index', [
            'title' => 'Fasilitas Unggulan',
            'name' => $identity->nama_instansi,
            'identity' => Identity::first(),
            'pelayanan' => Pelayanan::all(),
            'facilities' => Facility::where('unggulan', 1)->get()
        ]);
    }

    public function lainnya(Identity $identity)
    {
        return view('fasilitas.index', [
            'title' => 'Fasilitas Lainnya',
            'name' => $identity->nama_instansi,
            'identity' => Identity::first(),
            'pelayanan' => Pelayanan::all(),
            'facilities' => Facility::where('unggulan', 0)->get()
        ]);
    }

    public function show($slug)
    {
        $facility = Facility::where('slug', $slug)->first();

        return view('fasilitas.show', [
            'title' => $facility->name,
            'name' => 'RSIA Livasya',
            'fasilitas' => $facility,
            'identity' => Identity::first(),
            'pelayanan' => Pelayanan::all()
        ]);
    }
}
