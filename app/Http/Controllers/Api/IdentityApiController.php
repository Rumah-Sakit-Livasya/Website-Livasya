<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Identity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IdentityApiController extends Controller
{
    public function show()
    {
        $identity = Identity::first();
        return response()->json($identity);
    }

    public function update(Request $request, $id)
    {
        $identity = Identity::findOrFail($id);

        $rules = [
            'image' => 'image|file',
            'name' => 'required|max:255',
            'shortname' => 'required|max:255',
            'visi' => 'required|max:255',
            'misi' => 'required',
            'tujuan' => 'required',
            'alamat' => 'required|max:255',
            'facebook' => 'required|max:255',
            'instagram' => 'required|max:255',
            'twitter' => 'required|max:255',
            'youtube' => 'required|max:255',
            'youtube_link_video' => 'nullable',
            'email' => 'required|max:255',
            'no_hp' => 'required|max:255',
            'no_telp' => 'required|max:255',
            'jml_pasien_puas' => 'required|max:255',
            'jml_fasilitas_kamar' => 'required|max:255',
            'sejarah' => 'required',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('img-identity');
        }

        $identity->update($validatedData);

        return response()->json(['message' => 'Identity updated successfully']);
    }
}
