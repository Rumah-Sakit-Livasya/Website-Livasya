<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Poliklinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PoliklinikApiController extends Controller
{
    public function getPoliklinik()
    {
        $polikliniks = Poliklinik::all();

        return response()->json($polikliniks);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|file',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('img-poli');
        }

        $poliklinik = Poliklinik::create($validatedData);

        return response()->json(['message' => 'Poli berhasil ditambahkan', 'poliklinik' => $poliklinik]);
    }

    public function show($poliklinikId)
    {
        $poliklinik = Poliklinik::findOrFail($poliklinikId);
        return response()->json($poliklinik);
    }

    public function update(Request $request, $poliklinikId)
    {
        $poliklinik = Poliklinik::findOrFail($poliklinikId);
        $rules = [
            'name' => 'required|max:255',
            'image' => 'image|file',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('img-poli');
        }

        $poliklinik->update($validatedData);

        return response()->json(['message' => 'Poliklinik updated successfully']);
    }
}
