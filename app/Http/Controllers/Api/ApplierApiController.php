<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Applier;
use App\Models\ApplierLanguage;
use Illuminate\Http\Request;

class ApplierApiController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
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
            'npwp' => 'required',
            'social_security' => 'required',
            'ktp_address' => 'required',
            'cb_address' => 'required',
            'permanent_address' => 'required',
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
            'declare_lvs_politic' => 'required',
            'declare_government' => 'required',
            'declare_business' => 'required'
        ]);

        $applier = Applier::create($validatedData);

        return response()->json(['message' => 'Lamaran berhasil ditambahkan', 'applier' => $applier]);
    }
}
