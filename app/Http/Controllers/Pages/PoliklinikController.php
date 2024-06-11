<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Poliklinik;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    public function index()
    {
        $polikliniks = Poliklinik::all();

        return view('pages.poliklinik.index', compact('polikliniks'), [
            'title' => 'Poliklinik',
        ]);
    }
}
