<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
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
}
