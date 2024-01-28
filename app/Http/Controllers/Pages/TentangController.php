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
        return view('about.index', [
            'name' => 'RSIA Livasya',
            'title' => 'Tentang Kami',
            'about' => Identity::first(),
            'pelayanan' => Pelayanan::all()

        ]);
    }
}
