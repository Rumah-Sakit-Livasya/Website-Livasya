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
        $identity = Identity::first();

        return view('pelayanan', [
            'name' => $identity->name,
            'title' => "$pelayanan->title",
            'identity' => $identity,
            'pel' => $pelayanan,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }
}
