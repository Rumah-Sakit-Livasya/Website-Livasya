<?php

namespace App\Http\Controllers\Pages;

use App\Models\Facility;
use App\Models\Identity;
use App\Models\Mitra;
use App\Models\Pelayanan;
use Illuminate\Routing\Controller;

class FasilitasController extends Controller
{
    public function index(Identity $identity)
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();
        $facilities = Facility::where('unggulan', 1)->get();

        return view('fasilitas.index', compact('identity', 'pelayanan', 'mitras', 'facilities'), [
            'title' => 'Fasilitas Unggulan',
        ]);
    }

    public function lainnya(Identity $identity)
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();
        $facilities = Facility::where('unggulan', 0)->get();

        return view('fasilitas.index', compact('identity', 'pelayanan', 'mitras', 'facilities'), [
            'title' => 'Fasilitas Lainnya',
        ]);
    }

    public function show($slug)
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();
        $facility = Facility::where('slug', $slug)->first();

        return view('fasilitas.show', compact('identity', 'pelayanan', 'mitras', 'facility'), [
            'title' => $facility->name,
        ]);
    }
}
