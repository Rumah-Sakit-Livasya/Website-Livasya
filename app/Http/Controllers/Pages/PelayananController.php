<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\ImagePelayanan;
use App\Models\Pelayanan;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    public function index()
    {
        return view('pages.pelayanan.index', [
            'title' => 'Pelayanan',
            'pelayanans' => Pelayanan::all()
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
        // $images = ImagePelayanan::all();

        return view('pages.pelayanan.partials.image', [
            'title' => 'Pelayanan',
            'pelayanan' => $pelayanan,
            'images' => ImagePelayanan::where('pelayanan_id', $pelayanan->id)->get()
        ]);
    }
}
