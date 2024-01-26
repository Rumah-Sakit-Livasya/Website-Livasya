<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JadwalApiController extends Controller
{
    public function getJadwal()
    {
        $jadwal = Jadwal::all();

        return response()->json($jadwal);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|file',
            'thumbnail' => 'required|image|file',
            'caption' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('img-jadwal');
        }

        if ($request->file('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('img-jadwal');
        }

        $jadwal = Jadwal::create($validatedData);

        return response()->json(['message' => 'Galeri berhasil ditambahkan', 'jadwal' => $jadwal]);
    }

    public function show()
    {
        $jadwal = Jadwal::first();
        return response()->json($jadwal);
    }

    public function update(Request $request, $jadwalId)
    {
        $jadwal = Jadwal::findOrFail($jadwalId);
        $rules = [
            'image' => 'image|file',
            'thumbnail' => 'image|file',
            'caption' => 'required',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('img-jadwal');
        }
        if ($request->file('thumbnail')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['thumbnail'] = $request->file('thumbnail')->store('img-thumbnail');
        }

        $jadwal->update($validatedData);

        return response()->json(['message' => 'Jadwal updated successfully']);
    }

    public function destroy($id)
    {
        try {
            // Find the jadwal by ID
            $jadwal = Jadwal::findOrFail($id);
            Storage::delete($jadwal->image);
            Storage::delete($jadwal->thumbnail);

            // Delete the jadwal
            $jadwal->delete();

            return response()->json(['message' => 'Jadwal deleted successfully'], 200);
        } catch (\Exception $e) {
            // Handle exception, e.g., jadwal not found
            return response()->json(['error' => 'Jadwal not found or could not be deleted'], 404);
        }
    }
}
