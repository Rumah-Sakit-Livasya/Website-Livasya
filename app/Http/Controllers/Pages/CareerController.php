<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Applier;
use App\Models\Career;
use App\Models\Doctor;
use App\Models\Galery;
use App\Models\Identity;
use App\Models\Pelayanan;
use GuzzleHttp\Psr7\Request;

class CareerController extends Controller
{
    public function index()
    {
        $about = Identity::first();
        return view('career', [
            'name' => $about->name,
            'title' => 'Lowongan Kerja',
            'dokter' => Doctor::all(),
            'about' => $about,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    public function admin()
    {
        $careers = Career::all();

        return view('pages.careers.index', [
            'title' => 'Kategori',
            'careers' => $careers,
        ]);
    }

    public function career($tipe)
    {
        $about = Identity::first();

        return view('career-open', [
            'name' => $about->name,
            // 'careers' => Career::where('status', 'on')->get(),
            'title' => "Lowongan tenaga $tipe",
            'tipe' => $tipe,
            'about' => $about,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    public function apply($tipe, $id)
    {
        $about = Identity::first();
        $career = Career::where('id', $id)->first();

        return view('career-apply', [
            'name' => $about->name,
            'title' => "Formulir Data Pelamar - $career->title",
            'tipe' => $tipe,
            'about' => $about,
            'career' => $career,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    public function applier($career)
    {
        $applier = Applier::where('career_id', $career)->orderBy('created_at', 'asc')->get();

        // return $career;

        return view('pages.careers.partials.applier-list', [
            'appliers' => $applier
        ]);
    }
}
