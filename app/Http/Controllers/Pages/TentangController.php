<?php

namespace App\Http\Controllers\Pages;

use App\Models\Identity;
use App\Models\Mitra;
use App\Models\Pelayanan;
use App\Models\Timeline;
use Illuminate\Routing\Controller;

class TentangController extends Controller
{
    public function index()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $timelines = Timeline::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        return view('about.index', compact('pelayanan', 'timelines'), [
            'mitras' => $mitras,
            'title' => 'Tentang Kami',
            'identity' => $identity,
        ]);
    }
}
