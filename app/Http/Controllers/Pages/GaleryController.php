<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    public function index()
    {
        return view('pages.galery.index', [
            'title' => 'Galeri',
            'galeries' => Galery::all()
        ]);
    }
}
