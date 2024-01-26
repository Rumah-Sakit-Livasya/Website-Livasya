<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleryApiController extends Controller
{
    public function getGalery()
    {
        $galery = Galery::all();

        return response()->json($galery);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|file',
            'thumbnail' => 'required|image|file',
            'caption' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('img-galery');
        }

        if ($request->file('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('img-thumbnail');
        }

        $galery = Galery::create($validatedData);

        return response()->json(['message' => 'Galeri berhasil ditambahkan', 'galery' => $galery]);
    }

    public function show($galeryId)
    {
        $galery = Galery::findOrFail($galeryId);
        return response()->json($galery);
    }

    public function update(Request $request, $galeryId)
    {
        $galery = Galery::findOrFail($galeryId);
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

            $validatedData['image'] = $request->file('image')->store('img-galery');
        }
        if ($request->file('thumbnail')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['thumbnail'] = $request->file('thumbnail')->store('img-thumbnail');
        }

        $galery->update($validatedData);

        return response()->json(['message' => 'Galery updated successfully']);
    }

    public function destroy($id)
    {
        try {
            // Find the gallery by ID
            $gallery = Galery::findOrFail($id);
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
