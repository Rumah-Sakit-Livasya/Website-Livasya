<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Applier;
use App\Models\Career;
use App\Models\ApplierCertification;
use App\Models\ApplierWork;
use App\Models\ApplierEducation;
use App\Models\ApplierLicense;
use App\Models\ApplierScholarship;
use App\Models\ApplierOther;
use App\Models\ApplierLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HrdController extends Controller
{
    /**
     * Halaman utama HRD: list semua lowongan + jumlah pelamar.
     */
    public function index(Request $request)
    {
        $query = Career::withCount('applier')
            ->orderByDesc('created_at');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%");
        }

        $careers = $query->get();

        return view('hrd.index', [
            'title'   => 'Dashboard HRD',
            'careers' => $careers,
        ]);
    }

    /**
     * Daftar pelamar per lowongan.
     */
    public function appliers(Request $request, $careerId)
    {
        $career = Career::findOrFail($careerId);

        $query = Applier::where('career_id', $careerId)
            ->with('user')
            ->orderByDesc('created_at');

        // Filter status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search nama
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $appliers = $query->paginate(15)->withQueryString();

        return view('hrd.appliers', [
            'title'    => 'Daftar Pelamar - ' . $career->title,
            'career'   => $career,
            'appliers' => $appliers,
        ]);
    }

    /**
     * Detail satu pelamar beserta semua dokumennya.
     */
    public function detail($careerId, $applierId)
    {
        $career  = Career::findOrFail($careerId);
        $applier = Applier::with('user')->where('id', $applierId)->where('career_id', $careerId)->firstOrFail();

        $educations     = ApplierEducation::where('applier_id', $applierId)->get();
        $works          = ApplierWork::where('applier_id', $applierId)->get();
        $certifications = ApplierCertification::where('applier_id', $applierId)->get();
        $licenses       = ApplierLicense::where('applier_id', $applierId)->get();
        $scholarships   = ApplierScholarship::where('applier_id', $applierId)->get();
        $others         = ApplierOther::where('applier_id', $applierId)->get();
        $languages      = ApplierLanguage::where('applier_id', $applierId)->get();

        return view('hrd.detail', [
            'title'          => 'Detail Pelamar - ' . $applier->first_name . ' ' . $applier->last_name,
            'career'         => $career,
            'applier'        => $applier,
            'educations'     => $educations,
            'works'          => $works,
            'certifications' => $certifications,
            'licenses'       => $licenses,
            'scholarships'   => $scholarships,
            'others'         => $others,
            'languages'      => $languages,
        ]);
    }

    /**
     * Update status pelamar (Terima / Tolak).
     */
    public function updateStatus(Request $request, $careerId, $applierId)
    {
        $request->validate([
            'status' => 'required|in:processed,accepted,rejected',
        ]);

        $applier = Applier::where('id', $applierId)->where('career_id', $careerId)->firstOrFail();
        $applier->update(['status' => $request->status]);

        return back()->with('success', 'Status pelamar berhasil diperbarui.');
    }

    /**
     * Download dokumen pelamar (CV, KTP, Ijazah, dll).
     */
    public function downloadDoc($careerId, $applierId, $type)
    {
        $applier = Applier::where('id', $applierId)->where('career_id', $careerId)->firstOrFail();

        $fieldMap = [
            'cv'         => $applier->cv,
            'attachment' => $applier->attachment,
        ];

        $path = $fieldMap[$type] ?? null;

        if (!$path || !Storage::exists($path)) {
            abort(404, 'Dokumen tidak ditemukan.');
        }

        $ext      = pathinfo($path, PATHINFO_EXTENSION);
        $filename = strtoupper($type) . ' - ' . $applier->first_name . ' ' . $applier->last_name . '.' . $ext;

        return Storage::download($path, $filename);
    }
}
