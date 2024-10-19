<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DoctorApiController extends Controller
{
    public function getDoctor()
    {
        $doctors = Doctor::all();

        return response()->json($doctors);
    }

    public function getDepartement($id)
    {
        $doctors = Doctor::all();

        return response()->json($doctors);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'foto' => 'image|file',
            'name' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'departement_id' => 'required|max:255',
            'deskripsi' => 'required',
            'poster' => 'image|file',
            'jadwal' => 'image|file',
        ]);

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('img-dokter');
        }
        if ($request->file('poster')) {
            $validatedData['poster'] = $request->file('poster')->store('img-poster');
        }
        if ($request->file('jadwal')) {
            $validatedData['jadwal'] = $request->file('jadwal')->store('img-jadwal');
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
            'foto' => 'image|file',
            'name' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'deskripsi' => 'required',
            'poster' => 'image|file',
            'jadwal' => 'image|file',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['foto'] = $request->file('foto')->store('img-dokter');
        }
        if ($request->file('poster')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['poster'] = $request->file('poster')->store('img-poster');
        }
        if ($request->file('jadwal')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['jadwal'] = $request->file('jadwal')->store('img-jadwal');
        }

        $doctor->update($validatedData);

        return response()->json(['message' => 'Doctor updated successfully']);
    }
    public function updateDepartement(Request $request, $doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);

        // Validasi data
        $request->validate([
            'departement_id' => 'required|max:255',
        ]);

        // Update data dokter
        $doctor->update([
            'departement_id' => $request->departement_id,
        ]);

        return response()->json(['message' => 'Departement updated successfully']);
    }

    public function activate($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->is_active = 1;
            $doctor->save();

            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Doctor not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred'], 500);
        }
    }

    public function deactivate($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->is_active = 0;
            $doctor->save();

            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Doctor not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred'], 500);
        }
    }
}
