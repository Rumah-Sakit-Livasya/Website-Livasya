<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\Identity;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    public function index()
    {
        $galeries = Galery::all();

        return view('pages.galery.index', compact('galeries'), [
            'title' => 'Galeri',
        ]);
    }
}
