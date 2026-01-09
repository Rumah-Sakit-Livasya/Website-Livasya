<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Applier;
use App\Models\ApplierCertification;
use App\Models\ApplierLanguage;
use App\Models\ApplierWork;
use App\Models\ApplierEducation;
use App\Models\ApplierLicense;
use App\Models\ApplierScholarship;
use App\Models\ApplierOther;
use App\Models\Career;
use App\Models\Doctor;
use App\Models\Galery;
use App\Models\Identity;
use App\Models\Mitra;
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::where('status', 'on')->get();
        $identity = Identity::first();
        $mitras = Mitra::where('is_primary', 1)->get();

        return view('career', [
            'name' => $identity->name,
            'title' => 'Lowongan Kerja',
            'dokter' => Doctor::all(),
            'identity' => $identity,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all(),
            'careers' => $careers,
            'mitras' => $mitras,
        ]);
    }

    public function admin()
    {
        $careers = Career::withCount('applier')->get();
        $identity = Identity::first();
        $mitras = Mitra::where('is_primary', 1)->get();

        return view('pages.careers.index', [
            'mitras' => $mitras,
            'title' => 'Kategori',
            'careers' => $careers,
            'identity' => $identity,
        ]);
    }

    public function career($tipe)
    {
        $identity = Identity::first();
        $mitras = Mitra::where('is_primary', 1)->get();

        return view('career-open', [
            'mitras' => $mitras,
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
        $mitras = Mitra::where('is_primary', 1)->get();

        if ($career) {
            return view('career-apply', [
                'mitras' => $mitras,
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
        $mitras = Mitra::where('is_primary', 1)->get();
        $applier = Applier::where('career_id', $career)->orderBy('created_at', 'desc')->get();

        // return $career;

        return view('pages.careers.partials.applier-list', [
            'mitras' => $mitras,
            'appliers' => $applier
        ]);
    }

    public function applier($career, $applierId)
    {
        $mitras = Mitra::where('is_primary', 1)->get();
        $applier = Applier::with('user')->where('id', $applierId)->first();

        $languages = ApplierLanguage::where('applier_id', $applier->id)->get();
        $certifications = ApplierCertification::where('applier_id', $applier->id)->get();
        $works = ApplierWork::where('applier_id', $applier->id)->get();

        // Added relations
        $educations = ApplierEducation::where('applier_id', $applier->id)->get();
        $licenses = ApplierLicense::where('applier_id', $applier->id)->get();
        $scholarships = ApplierScholarship::where('applier_id', $applier->id)->get();
        $others = ApplierOther::where('applier_id', $applier->id)->get();

        return view('pages.careers.partials.applier-detail', [
            'mitras' => $mitras,
            'applier' => $applier,
            'languages' => $languages,
            'certifications' => $certifications,
            'works' => $works,
            'educations' => $educations,
            'licenses' => $licenses,
            'scholarships' => $scholarships,
            'others' => $others
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

    public function updateStatus(Request $request, $careerId, $applierId)
    {
        $applier = Applier::findOrFail($applierId);
        $applier->update(['status' => $request->input('status')]);

        return back()->with('success', 'Status pelamar berhasil diperbarui.');
    }
}
