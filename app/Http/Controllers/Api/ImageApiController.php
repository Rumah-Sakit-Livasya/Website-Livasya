<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ImagePelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageApiController extends Controller
{
    public function getGalery()
    {
        $galery = ImagePelayanan::all();

        return response()->json($galery);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pelayanan_id' => 'required',
            'image' => 'required|image|file',
            'thumbnail' => 'required|image|file',
            'caption' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('img-pelayanan');
        }

        if ($request->file('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnail-pelayanan');
        }

        $galery = ImagePelayanan::create($validatedData);

        return response()->json(['message' => 'Galeri berhasil ditambahkan', 'galery' => $galery]);
    }

    public function show($galeryId)
    {
        $galery = ImagePelayanan::findOrFail($galeryId);
        return response()->json($galery);
    }

    public function update(Request $request, $galeryId)
    {
        $galery = ImagePelayanan::findOrFail($galeryId);
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

            $validatedData['image'] = $request->file('image')->store('img-pelayanan');
        }
        if ($request->file('thumbnail')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnail-pelayanan');
        }

        $galery->update($validatedData);

        return response()->json(['message' => 'Galery updated successfully']);
    }

    public function destroy($id)
    {
        try {
            // Find the gallery by ID
            $gallery = ImagePelayanan::findOrFail($id);
            Storage::delete($gallery->image);
            Storage::delete($gallery->thumbnail);

            // Delete the gallery
            $gallery->delete();

            return response()->json(['message' => 'Gallery deleted successfully'], 200);
        } catch (\Exception $e) {
            // Handle exception, e.g., gallery not found
            return response()->json(['error' => 'Gallery not found or could not be deleted'], 404);
        }
    }
}
