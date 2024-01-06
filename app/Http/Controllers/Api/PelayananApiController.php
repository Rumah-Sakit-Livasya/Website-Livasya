<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelayanan;
use Illuminate\Http\Request;

class PelayananApiController extends Controller
{
    public function getPelayanan()
    {
        $pelayanans = Pelayanan::all();

        return response()->json($pelayanans);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'icon' => 'required|max:255',
            'title' => 'required|max:255',
            'slug' => 'required|unique:pelayanans',
            'body' => 'required',
        ]);

        $pelayanan = Pelayanan::create($validatedData);

        return response()->json(['message' => 'Kategori berhasil ditambahkan', 'pelayanan' => $pelayanan]);
    }

    public function show($pelayananId)
    {
        $pelayanan = Pelayanan::findOrFail($pelayananId);
        return response()->json($pelayanan);
    }

    public function update(Request $request, $pelayananId)
    {
        $pelayanan = Pelayanan::findOrFail($pelayananId);
        $rules = [
            'icon' => 'required|max:255',
            'title' => 'required|max:255',
            'slug' => 'required|unique:pelayanans,slug,' . $pelayanan->id,
            'body' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $pelayanan->update($validatedData);

        return response()->json(['message' => 'Pelayanan updated successfully']);
    }
}
