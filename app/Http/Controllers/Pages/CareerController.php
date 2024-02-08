<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Applier;
use App\Models\ApplierCertification;
use App\Models\ApplierLanguage;
use App\Models\ApplierWork;
use App\Models\Career;
use App\Models\Doctor;
use App\Models\Galery;
use App\Models\Identity;
use App\Models\Pelayanan;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function index()
    {
        $medis = Career::where('status', 'on')
            ->where('tipe', 'medis')
            ->get()
            ->count();
        $nonMedis = Career::where('status', 'on')
            ->where('tipe', 'non-medis')
            ->get()
            ->count();

        $about = Identity::first();
        return view('career', [
            'name' => $about->name,
            'title' => 'Lowongan Kerja',
            'dokter' => Doctor::all(),
            'about' => $about,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all(),
            'medis' => $medis,
            'nonMedis' => $nonMedis,
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
        $career = Career::where('id', $id)->where('status', 'on')->where('tipe', $tipe)->first();

        if ($career) {
            return view('career-apply', [
                'name' => $about->name,
                'title' => "Formulir Data Pelamar - $career->title",
                'tipe' => $tipe,
                'about' => $about,
                'career' => $career,
                'pelayanan' => Pelayanan::all(),
                'galleries' => Galery::all()
            ]);
        } else {
            return abort(404);
        }
    }

    public function appliers($career)
    {
        $applier = Applier::where('career_id', $career)->orderBy('created_at', 'desc')->get();

        // return $career;

        return view('pages.careers.partials.applier-list', [
            'appliers' => $applier
        ]);
    }

    public function applier($career, $applierId)
    {
        $applier = Applier::where('id', $applierId)->first();
        $languages = ApplierLanguage::where('applier_id', $applier->id)->get();
        $certifications = ApplierCertification::where('applier_id', $applier->id)->get();
        $works = ApplierWork::where('applier_id', $applier->id)->get();

        return view('pages.careers.partials.applier-detail', [
            'applier' => $applier,
            'languages' => $languages,
            'certifications' => $certifications,
            'works' => $works
        ]);
    }

    public function downloadCV($careerId, $applierId)
    {
        // Ambil data applier berdasarkan ID
        $applier = Applier::find($applierId);

        if (!$applier) {
            abort(404, 'Applier not found');
        }

        // Ambil path file CV dari data applier
        $cvPath = $applier->attachment;

        // Lakukan validasi apakah path file CV ada
        if ($cvPath) {
            // Mendapatkan nama file dari path
            $filename = "CV " . $applier->first_name . " " . $applier->last_name . " - " . $applier->career->title;

            // Mendapatkan ekstensi file dari path
            $extension = pathinfo($cvPath, PATHINFO_EXTENSION);

            // Nama file untuk di-download
            $downloadFilename = $filename . '.' . $extension;

            // Download file
            return Storage::download($cvPath, $downloadFilename);
        } else {
            // Jika path file CV tidak ada
            abort(404, 'CV not found');
        }
    }
}
