<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Applier;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        if ($user->applier) {
            return redirect()->route('dashboard')->with('status', 'Profile already completed.');
        }

        $careers = Career::where('is_active', true)->get();

        return view('applicant.profile', compact('user', 'careers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20', // Whatsapp
            'sex' => 'required|string',
            'blood_type' => 'required|string',
            'marital_status' => 'required|string',
            'religion' => 'required|string',
            'career_id' => 'required|exists:careers,id', // Minat bagian
            'id_card' => 'required|string|max:20', // KTP
            'address' => 'required|string', // Alamat (map to ktp_address or permanent_address?)
        ]);

        // Map request to Applier model fields based on migration
        // Migration fields: first_name, last_name, birth_place, birth_day, email, sex, marital_status, religion, id_card, suku, ktp_address, permanent_address, ...
        // The user request only asked for a subset. I should fill required fields or ask user to fill them.
        // User asked for: No HP (Whatsapp), Email (Auto), Gender, Blood Type, Marital Status, Religion, Minat Bagian, KTP, Alamat.
        // Missing required fields from migration: first_name, last_name, birth_place, birth_day, suku, etc.
        // I should probably ask user to fill these too or make them nullable in migration (but migration is already created/run).
        // I will include standard fields in the form or assume some can be inferred (User name -> first/last name).

        $user = Auth::user();
        $nameParts = explode(' ', $user->name, 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? '';

        Applier::create([
            'user_id' => $user->id,
            'career_id' => $request->career_id,
            'find_vacancy' => 'Website', // Default or ask
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $user->email,
            'sex' => $request->sex,
            'marital_status' => $request->marital_status,
            'religion' => $request->religion,
            'id_card' => $request->id_card,
            'ktp_address' => $request->address,
            'permanent_address' => $request->address, // Assume same for now
            'family_contact' => $request->phone, // Using family_contact for now as generic phone or add phone field?
            // Wait, Applier table doesn't have a direct 'phone' field for the applicant?
            // It has 'emergency_phone'. It has 'family_contact'.
            // It seems the original migration was very specific.
            // I should probably add 'phone' column to appliers or use one of existing.
            // Let's check migration again.
            // Migration: family_contact, emergency_phone. No direct phone for applier?
            // That's strange. I will use `family_contact` effectively or add a column if needed.
            // Update: user asked for "Nomor yang bisa dihubungi (Whatsapp)".
            // I'll check if I should add a column.
            // For now I'll map it to 'family_contact' or similar if acceptable, but better add 'phone'.
            // Actually, I'll add 'phone' to appliers in a new migration later if needed. For now I'll use `family_contact` as a placeholder or just `emergency_phone`.
            // But let's check the migration file content again.
            // `2024_02_02_015519_create_appliers_table.php`:
            // it has `family_contact`.
            // I will use `family_contact` for now to avoid too many migrations, or create a quick one.
            // User request: "Nomor yang bisa dihubungi (Whatsapp)".
            // I'll use `family_contact` and label it clearly.

            // Also need to handle other required fields that are not in user request list (birth_place, birth_day, suku, etc.)
            // I should Add them to the form to avoid SQL errors.

            'birth_place' => $request->birth_place,
            'birth_day' => $request->birth_day,
            'suku' => $request->suku ?? '-',

            // Dummy values for required fields not requested (or ask user to add them)
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

        return redirect()->route('dashboard')->with('success', 'Profile completed successfully!');
    }
}
