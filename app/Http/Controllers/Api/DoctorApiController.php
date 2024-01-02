<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorApiController extends Controller
{
    public function getDoctor()
    {
        $doctors = Doctor::all();

        return response()->json($doctors);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'foto' => 'image|file|max:5120',
            'name' => 'required|max:255',
            'jabatan' => 'required|max:255',
        ]);

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('img-dokter');
        }

        $doctor = Doctor::create($validatedData);

        return response()->json(['message' => 'Dokter berhasil ditambahkan', 'doctor' => $doctor]);
    }

    public function show($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        return response()->json($doctor);
    }

    public function update(Request $request, $doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        $rules = [
            'foto' => 'image|file|max:5120',
            'name' => 'required|max:255',
            'jabatan' => 'required|max:255',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['foto'] = $request->file('foto')->store('img-dokter');
        }

        $doctor->update($validatedData);

        return response()->json(['message' => 'Doctor updated successfully']);
    }
}
