<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Identity;
use App\Models\ImagePelayanan;
use App\Models\Pelayanan;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    public function index()
    {
        $pelayanans = Pelayanan::all();

        return view('pages.pelayanan.index', compact('pelayanans'), [
            'title' => 'Pelayanan',
        ]);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Pelayanan::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function images($id)
    {
        $pelayanan = Pelayanan::where('id', $id)->first();
        $identity = Identity::first();
        $images = ImagePelayanan::where('pelayanan_id', $pelayanan->id)->get();

        return view('pages.pelayanan.partials.image', compact('pelayanan', 'identity', 'images'), [
            'title' => 'Pelayanan',
        ]);
    }
}
