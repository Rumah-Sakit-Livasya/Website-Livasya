<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\Identity;
use App\Models\Mitra;
use App\Models\Pelayanan;
use Illuminate\Http\Request;

class PagePelayananController extends Controller
{
    public function index($slug)
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        $pelayananPage = Pelayanan::where('slug', $slug)->first();

        return view('pelayanan', compact('identity', 'pelayanan', 'mitras', 'pelayananPage'), [
            'title' => $pelayananPage->title,
        ]);
    }
}
