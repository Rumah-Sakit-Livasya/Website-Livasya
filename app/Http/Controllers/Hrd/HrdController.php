<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Mail\InterviewInvitation;
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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
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
            ->with(['user', 'educations'])
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
            'status' => 'required|in:processed,interview_1,interview_2,accepted,rejected',
        ]);

        $applier = Applier::where('id', $applierId)->where('career_id', $careerId)
                          ->with('career')
                          ->firstOrFail();

        $newStatus = $request->status;

        // Ketika admin menerima dari tahap processed -> ubah ke interview_1 + simpan jadwal + kirim email
        if ($applier->status == 'processed' && $newStatus == 'accepted') {
            $newStatus = 'interview_1';

            $request->validate([
                'interview_date'     => 'required|date',
                'interview_time'     => 'required|string|max:10',
                'interview_type'     => 'required|in:online,offline',
                'interview_location' => 'nullable|string|max:255',
            ]);

            // Simpan data jadwal ke tabel appliers
            $applier->update([
                'status'             => $newStatus,
                'interview_date'     => $request->interview_date,
                'interview_time'     => $request->interview_time,
                'interview_type'     => $request->interview_type,
                'interview_location' => $request->interview_location,
            ]);

            // Hitung link video conference jika interview online
            $vconLink = null;
            if ($request->interview_type === 'online') {
                $roomSlug  = Str::slug('Wawancara - ' . $applier->first_name . ' ' . $applier->last_name);
                $vconBase  = rtrim(config('services.vcon.url'), '/');
                $vconLink  = $vconBase . '/?code=' . $roomSlug;
            }

            // Kirim email undangan ke pelamar
            try {
                $applier->refresh(); // pastikan relasi terbaru
                Mail::to($applier->user?->email ?? $applier->email)
                    ->send(new InterviewInvitation($applier, $vconLink));
            } catch (\Exception $e) {
                \Log::error('Gagal kirim email undangan wawancara: ' . $e->getMessage());
            }

            return back()->with('success', 'Pelamar diterima. Jadwal wawancara telah disimpan dan email undangan telah dikirimkan.');
        }

        $applier->update(['status' => $newStatus]);

        return back()->with('success', 'Status pelamar berhasil diperbarui.');
    }

    /**
     * Tampilkan formulir wawancara (Lembar Penilaian Wawancara).
     */
    public function interviewForm($careerId, $applierId)
    {
        $career = Career::findOrFail($careerId);
        $applier = Applier::with(['user', 'interview', 'educations'])->where('id', $applierId)->where('career_id', $careerId)->firstOrFail();

        // Get candidate's main education details from relation or appliers table
        $latestEduRecord = $applier->educations->first();
        if ($latestEduRecord) {
            $latestEdu = (object) [
                'level' => $latestEduRecord->level ?? '-',
                'school_name' => $latestEduRecord->institution ?? '-',
                'graduation_year' => $latestEduRecord->gpa ? 'IPK: ' . $latestEduRecord->gpa : '-',
            ];
        } else {
            $latestEdu = (object) [
                'level' => $applier->school_qual ?? '-',
                'school_name' => $applier->school_name ?? '-',
                'graduation_year' => $applier->school_year ?? '-',
            ];
        }

        return view('hrd.wawancara', [
            'title'     => 'Lembar Penilaian Wawancara - ' . $applier->first_name . ' ' . $applier->last_name,
            'career'    => $career,
            'applier'   => $applier,
            'latestEdu' => $latestEdu,
            'interview' => $applier->interview,
        ]);
    }

    /**
     * Simpan data wawancara.
     */
    public function storeInterview(Request $request, $careerId, $applierId)
    {
        $applier = Applier::where('id', $applierId)->where('career_id', $careerId)->firstOrFail();

        // Validation based on input values (scale 40-100 for rated factors)
        $rules = [
            // Keadaan Fisik
            'tinggi_badan'    => 'nullable|string|max:50',
            'berat_badan'     => 'nullable|string|max:50',
            'riwayat_penyakit'=> 'nullable|string|max:255',
            'kacamata'        => 'nullable|in:YA,TIDAK',
            'hobi'            => 'nullable|string|max:255',
            'olahraga'        => 'nullable|string|max:255',

            // 10 Faktor Penilaian
            'f_penampilan'                  => 'nullable|integer|between:40,100',
            'f_kematangan_emosi'            => 'nullable|integer|between:40,100',
            'f_kemampuan_mengungkap_pikiran'=> 'nullable|integer|between:40,100',
            'f_motivasi_inisiatif'          => 'nullable|integer|between:40,100',
            'f_keterampilan_pemecahan_masalah' => 'nullable|integer|between:40,100',
            'f_kemampuan_komunikasi_persuasi' => 'nullable|integer|between:40,100',
            'f_rasa_percaya_diri'           => 'nullable|integer|between:40,100',
            'f_kesesuaian_persyaratan'      => 'nullable|integer|between:40,100',
            'f_pengetahuan_bidang'          => 'nullable|integer|between:40,100',
            'f_kemampuan_kerjasama'         => 'nullable|integer|between:40,100',
            
            'rekomendasi' => 'nullable|in:MEMENUHI SYARAT,PERTIMBANGAN,TIDAK DISARANKAN',
        ];

        if ($applier->status == 'interview_1') {
            $rules['interviewer_name_1'] = 'required|string|max:255';
            $rules['interview_date_1']   = 'required|date';
        } elseif ($applier->status == 'interview_2') {
            $rules['interviewer_name_2'] = 'required|string|max:255';
            $rules['interview_date_2']   = 'required|date';
            $rules['final_decision']     = 'required|in:accepted,rejected';
        }

        $validated = $request->validate($rules);

        // Calculate average score
        $factors = [
            $request->f_penampilan,
            $request->f_kematangan_emosi,
            $request->f_kemampuan_mengungkap_pikiran,
            $request->f_motivasi_inisiatif,
            $request->f_keterampilan_pemecahan_masalah,
            $request->f_kemampuan_komunikasi_persuasi,
            $request->f_rasa_percaya_diri,
            $request->f_kesesuaian_persyaratan,
            $request->f_pengetahuan_bidang,
            $request->f_kemampuan_kerjasama
        ];
        
        $total = 0;
        $count = 0;
        foreach ($factors as $val) {
            if ($val !== null && $val !== '') {
                $total += intval($val);
                $count++;
            }
        }
        $validated['rata_rata'] = $count > 0 ? round($total / $count, 2) : null;

        // Upsert interview details record
        $applier->interview()->updateOrCreate(
            ['applier_id' => $applier->id],
            $validated
        );

        // Update applicant status
        if ($applier->status == 'interview_1') {
            $applier->update(['status' => 'interview_2']);
            $msg = 'Wawancara Tahap 1 berhasil disimpan. Pelamar dialihkan ke Tahap 2 (Direktur).';
        } elseif ($applier->status == 'interview_2') {
            $applier->update(['status' => $request->final_decision]);
            $msg = 'Wawancara Tahap 2 berhasil disimpan dan keputusan akhir status pelamar telah ditetapkan.';
        } else {
            $msg = 'Formulir Wawancara berhasil diperbarui.';
        }

        return redirect()->route('hrd.appliers', $careerId)->with('success', $msg);
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
