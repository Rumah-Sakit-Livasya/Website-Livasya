<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        if ($request->file('header')) {
            $validatedData['header'] = $request->file('header')->store('img-header');
        }

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
        // return dd($request->file('header')->store('img-header'));
        $pelayanan = Pelayanan::findOrFail($pelayananId);
        $rules = [
            'header' => 'image|file|max:5120',
            'icon' => 'required|max:255',
            'title' => 'required|max:255',
            'slug' => 'required|unique:pelayanans,slug,' . $pelayanan->id,
            'body' => 'required',
        ];


        $validatedData = $request->validate($rules);

        if ($request->file('header')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['header'] = $request->file('header')->store('img-header');
        }

        $pelayanan->update($validatedData);

        return response()->json(['message' => 'Pelayanan updated successfully']);
    }
}
