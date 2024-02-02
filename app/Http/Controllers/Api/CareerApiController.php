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
            'declare_lvs_when' => 'required',
            'declare_lvs_where' => 'required',
            'declare_lvs_position' => 'required',
            'declare_lvs_stage' => 'required',
            'declare_politic' => 'required',
            'declare_government' => 'required',
            'declare_business' => 'required'
        ]);

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
            'work_start_salary.*' => 'required|numeric',
            'work_latest_salary.*' => 'required|numeric',
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
