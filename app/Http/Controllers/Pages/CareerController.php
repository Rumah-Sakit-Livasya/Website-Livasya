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
use App\Models\Mitra;
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
        $identity = Identity::first();

        $mitras = Mitra::where('is_primary', 1)->get();

        return view('career', [
            'name' => $identity->name,
            'title' => 'Lowongan Kerja',
            'dokter' => Doctor::all(),
            'identity' => $identity,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all(),
            'medis' => $medis,
            'mitras' => $mitras,
            'nonMedis' => $nonMedis,
        ]);
    }

    public function admin()
    {
        $careers = Career::all();
        $identity = Identity::first();

        return view('pages.careers.index', [
            'title' => 'Kategori',
            'careers' => $careers,
            'identity' => $identity,
        ]);
    }

    public function career($tipe)
    {
        $identity = Identity::first();

        return view('career-open', [
            'name' => $identity->name,
            // 'careers' => Career::where('status', 'on')->get(),
            'title' => "Lowongan tenaga $tipe",
            'tipe' => $tipe,
            'identity' => $identity,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    public function apply($tipe, $id)
    {
        $identity = Identity::first();
        $career = Career::where('id', $id)->where('status', 'on')->where('tipe', $tipe)->first();

        if ($career) {
            return view('career-apply', [
                'name' => $identity->name,
                'title' => "Formulir Data Pelamar - $career->title",
                'tipe' => $tipe,
                'identity' => $identity,
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
