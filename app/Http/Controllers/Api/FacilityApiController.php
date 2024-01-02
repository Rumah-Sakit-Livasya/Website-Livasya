<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FacilityApiController extends Controller
{
    public function getFacility()
    {
        $facilitys = Facility::all();

        return response()->json($facilitys);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'icon' => 'required|max:255',
            'name' => 'required|max:255',
            'slug' => 'required|unique:facilities',
            'unggulan' => 'required|max:255',
            'image' => 'image|file|max:5120',
            'body' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('img-fasilitas');
        }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        $facility = Facility::create($validatedData);

        return response()->json(['message' => 'Kategori berhasil ditambahkan', 'facility' => $facility]);
    }

    public function show($facilityId)
    {
        $facility = Facility::findOrFail($facilityId);
        // return dd($facility);
        return response()->json($facility);
    }

    public function update(Request $request, $facilityId)
    {
        $facility = Facility::findOrFail($facilityId);
        $rules = [
            'icon' => 'required|max:255',
            'name' => 'required|max:255',
            'slug' => 'required|unique:facilities,slug,' . $facility->id,
            'unggulan' => 'required|max:255',
            'image' => 'image|file|max:5120',
            'body' => 'required',
        ];

        if ($request->slug != $facility->slug) {
            $rules['slug'] = 'required|unique:facilities';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('img-fasilitas');
        }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        $facility->update($validatedData);

        return response()->json(['message' => 'Facility updated successfully']);
    }
}
