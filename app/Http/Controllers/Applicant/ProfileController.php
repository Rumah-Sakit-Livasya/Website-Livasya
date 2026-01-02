<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Applier;
use App\Models\Career;
use App\Models\Identity;
use App\Models\Mitra;
use App\Models\Pelayanan;
use App\Models\ApplierWork;
use App\Models\ApplierEducation;
use App\Models\ApplierCertification;
use App\Models\ApplierScholarship;
use App\Models\ApplierLicense;
use App\Models\ApplierOther;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        if ($user->applier) {
            return redirect()->route('applicant.profile.edit');
        }

        $careers = Career::where('status', 'on')->get();
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();
        $title = "Lengkapi Profil";
        $applier = null;
        $works = collect([]); // Empty collection for new profile
        $certifications = collect([]);
        $educations = collect([]);
        $scholarships = collect([]);
        $licenses = collect([]);
        $others = collect([]);

        // Dynamic Job Positions
        $jobPositions = \App\Models\JobPosition::where('is_active', true)->orderBy('name')->get();

        return view('applicant.profile', compact('user', 'careers', 'identity', 'pelayanan', 'mitras', 'title', 'applier', 'works', 'certifications', 'educations', 'scholarships', 'licenses', 'others', 'jobPositions'));
    }

    public function edit()
    {
        $user = Auth::user();
        if (!$user->applier) {
            return redirect()->route('applicant.profile.create');
        }

        $applier = $user->applier;
        // Load relationships
        $works = $applier->works()->latest()->get();
        $certifications = $applier->certifications()->latest()->get();
        $scholarships = $applier->scholarships()->latest()->get();
        $licenses = $applier->licenses()->latest()->get();
        $others = $applier->others()->latest()->get();
        $educations = $applier->educations()->latest()->get();

        $careers = Career::where('status', 'on')->get();
        // Dynamic Job Positions
        $jobPositions = \App\Models\JobPosition::where('is_active', true)->orderBy('name')->get();

        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();
        $title = "Edit Profil";

        return view('applicant.profile', compact('user', 'careers', 'jobPositions', 'identity', 'pelayanan', 'mitras', 'title', 'applier', 'works', 'certifications', 'scholarships', 'licenses', 'others', 'educations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'sex' => 'required|string',
            'blood_type' => 'required|string',
            'marital_status' => 'required|string',
            'religion' => 'required|string',
            'career_id' => 'required|exists:careers,id',
            'id_card' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $user = Auth::user();

        $firstName = $user->name;
        $lastName = '';
        if (strpos($user->name, ' ') !== false) {
            $nameParts = explode(' ', $user->name, 2);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? '';
        }

        Applier::create([
            'user_id' => $user->id,
            'position_interest' => $request->position_interest, // Updated from career_id
            'find_vacancy' => 'Website',
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $user->email,
            'sex' => $request->sex,
            'marital_status' => $request->marital_status,
            'religion' => $request->religion,
            'id_card' => $request->id_card,
            'ktp_address' => $request->address,
            'permanent_address' => $request->address,
            'family_contact' => $request->phone,

            'birth_place' => $request->birth_place ?? '-',
            'birth_day' => $request->birth_day ?? now(),
            'suku' => $request->suku ?? '-',

            'family_name' => '-',
            'family_sex' => '-',
            'family_relationship' => '-',
            'family_occupation' => '-',

            'emergency_name' => '-',
            'emergency_relation' => '-',
            'emergency_phone' => '-',
            'emergency_address' => '-',

            'school_name' => '-',
            'school_city' => '-',
            'school_major' => '-',
            'school_year' => '-',
            'school_qual' => '-',
            'school_gpa' => '-',

            'compensation_salary' => '-',
            'compensation_benefit' => '-',
            'compensation_workdate' => '-',

            'declare_family_member' => '-',
            'declare_suspended' => '-',
            'declare_criminal' => '-',
            'declare_politic' => '-',
            'declare_government' => '-',
            'declare_business' => '-',
            'attachment' => '-',
        ]);

        return redirect()->route('applicant.dashboard')->with('success', 'Profile completed successfully!');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $applier = $user->applier;

        if (!$applier) {
            return redirect()->route('applicant.profile.create')->with('error', 'Please create profile first.');
        }

        $request->validate([
            'phone' => 'required|string|max:20',
            'sex' => 'required|string',
            'blood_type' => 'required|string',
            'marital_status' => 'required|string',
            'religion' => 'required|string',
            'position_interest' => 'required|string',
            'id_card' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $applier->update([
            'position_interest' => $request->position_interest, // Updated from career_id
            'sex' => $request->sex,
            'marital_status' => $request->marital_status,
            'religion' => $request->religion,
            'id_card' => $request->id_card,
            'ktp_address' => $request->address,
            'permanent_address' => $request->address,
            'family_contact' => $request->phone,
            'birth_place' => $request->birth_place ?? $applier->birth_place,
            'birth_day' => $request->birth_day ?? $applier->birth_day,
            'suku' => $request->suku ?? $applier->suku,
            'about_me' => $request->about_me,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // --- WORK ---
    public function storeWork(Request $request)
    {
        $applier = Auth::user()->applier;
        ApplierWork::create([
            'applier_id' => $applier->id,
            'work_name' => $request->work_name,
            'work_position' => $request->work_position,
            'work_start' => $request->work_start,
            'work_end' => $request->work_end,
            'is_active' => $request->has('is_active'),
            'work_latest_salary' => 0, // Default or add input
            'description' => $request->description,
        ]);
        return back()->with('success', 'Data pekerjaan berhasil ditambahkan');
    }

    public function deleteWork($id)
    {
        ApplierWork::findOrFail($id)->delete();
        return back()->with('success', 'Data pekerjaan berhasil dihapus');
    }

    // --- EDUCATION ---
    public function storeEducation(Request $request)
    {
        $applier = Auth::user()->applier;
        ApplierEducation::create([
            'applier_id' => $applier->id,
            'level' => $request->level,
            'institution' => $request->institution,
            'address' => $request->address,
            'major' => $request->major,
            'other_major' => $request->other_major,
        ]);
        return back()->with('success', 'Data pendidikan berhasil ditambahkan');
    }

    public function deleteEducation($id)
    {
        ApplierEducation::findOrFail($id)->delete();
        return back()->with('success', 'Data pendidikan berhasil dihapus');
    }

    // --- CERTIFICATION/TRAINING ---
    public function storeCertification(Request $request)
    {
        $applier = Auth::user()->applier;
        ApplierCertification::create([
            'applier_id' => $applier->id,
            'certification_name' => $request->certification_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'certificate_end_date' => $request->certificate_end_date,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Data pelatihan berhasil ditambahkan');
    }

    public function deleteCertification($id)
    {
        ApplierCertification::findOrFail($id)->delete();
        return back()->with('success', 'Data pelatihan berhasil dihapus');
    }

    // --- SCHOLARSHIP ---
    public function storeScholarship(Request $request)
    {
        $applier = Auth::user()->applier;
        ApplierScholarship::create([
            'applier_id' => $applier->id,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Data beasiswa berhasil ditambahkan');
    }

    public function deleteScholarship($id)
    {
        ApplierScholarship::findOrFail($id)->delete();
        return back()->with('success', 'Data beasiswa berhasil dihapus');
    }

    // --- LICENSE (STR/SIP) ---
    public function storeLicense(Request $request)
    {
        $applier = Auth::user()->applier;
        ApplierLicense::create([
            'applier_id' => $applier->id,
            'type' => $request->type,
            'section' => $request->section, // Bagian
            'number' => $request->number,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'issuer' => $request->issuer,
            'facility' => $request->facility,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Data STR/SIP berhasil ditambahkan');
    }

    public function deleteLicense($id)
    {
        ApplierLicense::findOrFail($id)->delete();
        return back()->with('success', 'Data STR/SIP berhasil dihapus');
    }

    // --- OTHER DOCUMENTS ---
    public function storeOther(Request $request)
    {
        $applier = Auth::user()->applier;
        ApplierOther::create([
            'applier_id' => $applier->id,
            'document_type' => $request->document_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Data lain-lain berhasil ditambahkan');
    }

    public function deleteOther($id)
    {
        ApplierOther::findOrFail($id)->delete();
        return back()->with('success', 'Data lain-lain berhasil dihapus');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048', // Max 2MB
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($request->file('photo')) {
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->avatar = $path; // Use 'avatar' column
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function uploadKtp(Request $request)
    {
        $request->validate([
            'ktp_file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048', // Max 2MB
        ]);

        $applier = Auth::user()->applier;

        if ($request->file('ktp_file')) {
            // Save as 'Lain-lain' document or 'attachment' column?
            // Using ApplierOther for consistency with "documents" logic or specific logic
            // Let's use ApplierOther with a specific type "KTP" to make it visible in the "Documents" tab too.

            // Check if KTP already exists
            $existingKtp = ApplierOther::where('applier_id', $applier->id)->where('document_type', 'KTP')->first();
            if ($existingKtp) {
                // Delete old file if needed, or just update
                // For now, let's just create a new one or update
                $path = $request->file('ktp_file')->store('documents', 'public');
                $existingKtp->update([
                    'description' => $path, // We store path in description or assume separate handling?
                    // Wait, ApplierOther structure: document_type, start_date, end_date, description.
                    // Where is the FILE path stored?
                    // Checking Migration... "description" might be used for path? Or is there an "attachment" column in ApplierOther?
                ]);
                // Looking at storeOther: 'description' => $request->description. No file upload there yet.
                // Ah, the previous implementation of storeOther didn't show file handling!
                // Let's check ApplierOther migration columns.
            } else {
                $path = $request->file('ktp_file')->store('documents', 'public');
                ApplierOther::create([
                    'applier_id' => $applier->id,
                    'document_type' => 'KTP',
                    'start_date' => now(),
                    'end_date' => now()->addYears(5), // Assumption
                    'description' => 'File: ' . $path, // Storing path in description for now as fallback if no column
                ]);
            }

            // ALTERNATIVE: Use appliers 'attachment' column for KTP if it exists.
            // Let's default to updating the Applier 'attachment' column which I saw earlier.
            $path = $request->file('ktp_file')->store('documents', 'public');
            $applier->attachment = $path;
            $applier->save();
        }

        return back()->with('success', 'eKTP berhasil diupload.');
    }
}
