<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        return view('pages.jadwal.index', [
            'title' => 'Jadwal',
            'jadwal' => Jadwal::first()
        ]);
    }
}
