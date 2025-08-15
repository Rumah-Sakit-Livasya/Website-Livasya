<?php

namespace App\Http\Controllers\Pages;

use App\Models\Identity;
use App\Models\Mitra;
use App\Models\Pelayanan;
use Illuminate\Routing\Controller;

class livasyaleagueController extends Controller
{
    public function index()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        return view('livasya-league', [
            'title' => 'Livasya League',
            'identity' => $identity,
            'pelayanan' => $pelayanan,
            'mitras' => $mitras,
        ]);
    }
}
