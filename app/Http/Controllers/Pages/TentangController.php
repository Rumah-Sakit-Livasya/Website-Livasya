<?php

namespace App\Http\Controllers\Pages;

use App\Models\About;
use App\Models\Identity;
use App\Models\Pelayanan;
use Illuminate\Routing\Controller;

class TentangController extends Controller
{
    public function index()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();

        return view('about.index', compact('pelayanan'), [
            'title' => 'Tentang Kami',
            'about' => $identity,
        ]);
    }
}
