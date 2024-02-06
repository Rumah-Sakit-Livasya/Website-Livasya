<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\Identity;
use App\Models\Pelayanan;
use Illuminate\Http\Request;

class PagePelayananController extends Controller
{
    public function index($slug)
    {
        $pelayanan = Pelayanan::where('slug', $slug)->first();
        $about = Identity::first();

        return view('pelayanan', [
            'name' => $about->name,
            'title' => "$pelayanan->title",
            'about' => $about,
            'pel' => $pelayanan,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }
}
