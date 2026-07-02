<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Mail\InterviewInvitation;
use App\Models\Applier;
use App\Models\ApplierCertification;
use App\Models\ApplierLanguage;
use App\Models\ApplierWork;
use App\Models\ApplierEducation;
use App\Models\ApplierLicense;
use App\Models\ApplierScholarship;
use App\Models\ApplierOther;
use App\Models\Career;
use App\Models\Identity;
use App\Models\Mitra;
use App\Services\Frontend\CareerPageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function __construct(private CareerPageService $careerPageService)
    {
    }

    public function index()
    {
        return view('career', $this->careerPageService->list());
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
        return view('career-open', $this->careerPageService->byType($tipe));
    }

    public function apply($tipe, $id)
    {
        return view('career-apply', $this->careerPageService->apply($tipe, $id));
    }

    public function appliers($career)
    {
        $mitras = Mitra::where('is_primary', 1)->get();
        $applier = Applier::with(['educations', 'career'])->where('career_id', $career)->orderBy('created_at', 'desc')->get();

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
        $applier = Applier::findOrFail($applierId)->load('career');

        $newStatus = $request->input('status');

        // Ketika admin menerima dari tahap processed -> ubah ke interview_1 + simpan jadwal + kirim email
        if ($applier->status == 'processed' && $newStatus == 'accepted') {
            $newStatus = 'interview_1';

            $request->validate([
                'interview_date'     => 'required|date',
                'interview_time'     => 'required|string|max:10',
                'interview_type'     => 'required|in:online,offline',
                'interview_location' => 'nullable|string|max:255',
            ]);

            $applier->update([
                'status'             => $newStatus,
                'interview_date'     => $request->interview_date,
                'interview_time'     => $request->interview_time,
                'interview_type'     => $request->interview_type,
                'interview_location' => $request->interview_location,
            ]);

            $vconLink = null;
            if ($request->interview_type === 'online') {
                $roomSlug = Str::slug('Wawancara - ' . $applier->first_name . ' ' . $applier->last_name);
                $vconBase = rtrim(config('services.vcon.url'), '/');
                $vconLink = $vconBase . '/?code=' . $roomSlug;
            }

            $emailSent = true;
            $errorMsg = '';
            try {
                $applier->refresh();
                Mail::mailer('interview_smtp')
                    ->to($applier->user?->email ?? $applier->email)
                    ->send(new InterviewInvitation($applier, $vconLink));
            } catch (\Exception $e) {
                $emailSent = false;
                $errorMsg = $e->getMessage();
                \Log::error('Gagal kirim email undangan wawancara: ' . $errorMsg);
            }

            if ($emailSent) {
                return back()->with('success', 'Pelamar diterima. Jadwal wawancara telah disimpan dan email undangan telah dikirimkan.');
            } else {
                return back()->with('warning', 'Jadwal wawancara disimpan, tetapi GAGAL mengirim email undangan. Silakan periksa pengaturan SMTP Anda. Detail error: ' . $errorMsg);
            }
        }

        $applier->update(['status' => $newStatus]);

        return back()->with('success', 'Status pelamar berhasil diperbarui.');
    }
}
