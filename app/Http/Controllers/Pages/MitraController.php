<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = Mitra::all();

        return view('pages.mitra.index', compact('mitras'), [
            'title' => 'Mitra Perusahaan',
        ]);
    }
}
