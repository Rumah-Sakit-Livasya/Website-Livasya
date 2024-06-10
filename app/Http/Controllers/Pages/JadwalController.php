<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Identity;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::first();
        $identity = Identity::first();
        return view('pages.jadwal.index', compact('jadwal'), [
            'title' => 'Jadwal',
        ]);
    }
}
