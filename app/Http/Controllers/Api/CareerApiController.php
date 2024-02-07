<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Applier;
use App\Models\ApplierCertification;
use App\Models\ApplierLanguage;
use App\Models\ApplierWork;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerApiController extends Controller
{
    public function getCareer()
    {
        $categories = Career::all();

        return response()->json($categories);
    }

    public function store(Request $request)
    {
        if (!$request['status']) {
            $request['status'] = "off";
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'tipe' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        $career = Career::create($validatedData);

        return response()->json(['message' => 'Karir berhasil ditambahkan', 'career' => $career]);
    }

    public function show(Career $career)
    {
        return response()->json($career);
    }

    public function update(Request $request, Career $career)
    {
        if (!$request['status']) {
            $request['status'] = "off";
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'tipe' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        $career->update($validatedData);

        return response()->json(['message' => 'Career updated successfully']);
    }

    public function apply(Request $request)
    {
        // return dd($request->language_name);

        $validatedData = $request->validate([
            'career_id' => 'required',
            'find_vacancy' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_place' => 'required',
            'birth_day' => 'required',
            'email' => 'required',
            'sex' => 'required',
            'marital_status' => 'required',
            'religion' => 'required',
            'id_card' => 'required',
            'suku' => 'required',
            'npwp' => 'nullable',
            'social_security' => 'nullable',
            'ktp_address' => 'required',
            'permanent_address' => 'nullable',
            'family_name' => 'required',
            'family_sex' => 'required',
            'family_relationship' => 'required',
            'family_occupation' => 'required',
            'family_contact' => 'required',
            'emergency_name' => 'required',
            'emergency_relation' => 'required',
            'emergency_phone' => 'required',
            'emergency_address' => 'required',
            'school_name' => 'required',
            'school_city' => 'required',
            'school_major' => 'required',
            'school_year' => 'required',
            'school_qual' => 'required',
            'school_gpa' => 'required',
            'compensation_salary' => 'required',
            'compensation_benefit' => 'required',
            'compensation_workdate' => 'required',
            'declare_family_member' => 'required',
            'declare_suspended' => 'required',
            'declare_criminal' => 'required',
            'declare_lvs' => 'required',
            'declare_lvs_when' => 'nullable',
            'declare_lvs_where' => 'nullable',
            'declare_lvs_position' => 'nullable',
            'declare_lvs_stage' => 'nullable',
            'declare_politic' => 'required',
            'declare_government' => 'required',
            'declare_business' => 'required'
        ], [
            'career_id.required' => 'Field Karier ID harus diisi.',
            'find_vacancy.required' => 'Field Cari Lowongan harus diisi.',
            'first_name.required' => 'Field Nama Depan harus diisi.',
            'last_name.required' => 'Field Nama Belakang harus diisi.',
            'birth_place.required' => 'Field Tempat Lahir harus diisi.',
            'birth_day.required' => 'Field Tanggal Lahir harus diisi.',
            'email.required' => 'Field Email harus diisi.',
            'email.email' => 'Field Email harus berupa alamat email yang valid.',
            'sex.required' => 'Field Jenis Kelamin harus diisi.',
            'marital_status.required' => 'Field Status Pernikahan harus diisi.',
            'religion.required' => 'Field Agama harus diisi.',
            'id_card.required' => 'Field Nomor KTP harus diisi.',
            'suku.required' => 'Field Suku harus diisi.',
            'ktp_address.required' => 'Field Alamat KTP harus diisi.',
            'family_name.required' => 'Field Nama Keluarga harus diisi.',
            'family_sex.required' => 'Field Jenis Kelamin Keluarga harus diisi.',
            'family_relationship.required' => 'Field Hubungan Keluarga harus diisi.',
            'family_occupation.required' => 'Field Pekerjaan Keluarga harus diisi.',
            'family_contact.required' => 'Field Kontak Keluarga harus diisi.',
            'emergency_name.required' => 'Field Nama Kontak Darurat harus diisi.',
            'emergency_relation.required' => 'Field Hubungan dengan Kontak Darurat harus diisi.',
            'emergency_phone.required' => 'Field Nomor Kontak Darurat harus diisi.',
            'emergency_address.required' => 'Field Alamat Kontak Darurat harus diisi.',
            'school_name.required' => 'Field Nama Sekolah harus diisi.',
            'school_city.required' => 'Field Kota Sekolah harus diisi.',
            'school_major.required' => 'Field Jurusan Sekolah harus diisi.',
            'school_year.required' => 'Field Tahun Lulus Sekolah harus diisi.',
            'school_qual.required' => 'Field Kualifikasi Sekolah harus diisi.',
            'school_gpa.required' => 'Field IPK/GPA Sekolah harus diisi.',
            'compensation_salary.required' => 'Field Gaji yang Diinginkan harus diisi.',
            'compensation_benefit.required' => 'Field Manfaat yang Diinginkan harus diisi.',
            'compensation_workdate.required' => 'Field Tanggal Mulai Bekerja yang Diinginkan harus diisi.',
            'declare_family_member.required' => 'Field Anggota Keluarga bekerja di perusahaan ini harus diisi.',
            'declare_suspended.required' => 'Field Pernah dipecat atau di-suspend harus diisi.',
            'declare_criminal.required' => 'Field Pernah dihukum pidana harus diisi.',
            'declare_lvs.required' => 'Field Hubungan dengan LVS harus diisi.',
            'declare_politic.required' => 'Field Terlibat Politik harus diisi.',
            'declare_government.required' => 'Field Pekerjaan di Pemerintahan harus diisi.',
            'declare_business.required' => 'Field Memiliki Bisnis Sendiri harus diisi.',
        ]);

        if ($request->file('attachment')) {
            $validatedData['attachment'] = $request->file('attachment')->store('cv');
        }


        if ($request->cb_address) {
            $validatedData['permanent_address'] = $request->ktp_address;
        }

        $applier = Applier::create($validatedData);

        // Validasi data jika diperlukan
        $request->validate([
            'language_name.*' => 'nullable',
            'language_spoken.*' => 'nullable',
            'language_written.*' => 'nullable',
            'language_reading.*' => 'nullable',
        ]);

        // Loop melalui data yang dikirimkan melalui formulir
        foreach ($request->language_name as $key => $value) {
            ApplierLanguage::create([
                'applier_id' => $applier->id,
                'language_name' => $request->language_name[$key],
                'language_spoken' => $request->language_spoken[$key],
                'language_written' => $request->language_written[$key],
                'language_reading' => $request->language_reading[$key],
            ]);
        }

        $request->validate([
            'certification_name.*' => 'nullable',
            'certification_institution.*' => 'nullable',
            'certification_obtained.*' => 'nullable',
        ]);

        // Loop melalui data yang dikirimkan melalui formulir
        foreach ($request->certification_name as $key => $value) {
            ApplierCertification::create([
                'applier_id' => $applier->id,
                'certification_name' => $request->certification_name[$key],
                'certification_institution' => $request->certification_institution[$key],
                'certification_obtained' => $request->certification_obtained[$key],
            ]);
        }

        // Validasi data jika diperlukan
        $request->validate([
            'work_name.*' => 'required|string',
            'work_position.*' => 'required|string',
            'work_address.*' => 'required|string',
            'work_start.*' => 'required',
            'work_end.*' => 'required',
            'work_start_salary.*' => 'required',
            'work_latest_salary.*' => 'required',
            'work_reason.*' => 'required|string',
            'work_contact_employer.*' => 'required|string',
            'work_contact_yes.*' => 'nullable|string',
            'work_achievement.*' => 'nullable|string',
        ]);

        // Loop melalui data yang dikirimkan melalui formulir
        foreach ($request->work_name as $key => $value) {
            ApplierWork::create([
                'applier_id' => $applier->id,
                'work_name' => $request->work_name[$key],
                'work_position' => $request->work_position[$key],
                'work_address' => $request->work_address[$key],
                'work_start' => $request->work_start[$key],
                'work_end' => $request->work_end[$key],
                'work_start_salary' => $request->work_start_salary[$key],
                'work_latest_salary' => $request->work_latest_salary[$key],
                'work_reason' => $request->work_reason[$key],
                'work_contact_employer' => $request->work_contact_employer[$key],
                'work_contact_yes' => $request->work_contact_yes[$key] ?? null,
                'work_achievement' => $request->work_achievement[$key] ?? null,
            ]);
        }

        return response()->json(['message' => 'Career updated successfully']);
    }
}
