<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MitraApiController extends Controller
{
    public function getMitra()
    {
        $mitras = Mitra::all();

        return response()->json($mitras);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|file',
            'is_primary' => 'max:255',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('img-mitra');
        }

        // Check if 'is_primary' is 'on' and set it to 1
        if ($request->has('is_primary') && $request->is_primary === 'on') {
            $validatedData['is_primary'] = 1;
        } else {
            $validatedData['is_primary'] = 0;
        }

        $mitra = Mitra::create($validatedData);

        return response()->json(['message' => 'Mitra berhasil ditambahkan', 'mitra' => $mitra]);
    }

    public function show($mitraId)
    {
        $mitra = Mitra::findOrFail($mitraId);
        return response()->json($mitra);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|file',
            'is_primary' => 'max:255',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('img-mitra');
        } else {
            $validatedData['image'] = $request->oldImage;
        }

        // Check if 'is_primary' is 'on' and set it to 1, otherwise set it to 0
        $validatedData['is_primary'] = $request->has('is_primary') && $request->is_primary === 'on' ? 1 : 0;

        $mitra = Mitra::find($id);
        $mitra->update($validatedData);

        return response()->json(['message' => 'Mitra berhasil diubah', 'mitra' => $mitra]);
    }


    public function activate($id)
    {
        try {
            $mitra = Mitra::findOrFail($id);
            $mitra->is_active = 1;
            $mitra->save();

            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Mitra not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred'], 500);
        }
    }

    public function deactivate($id)
    {
        try {
            $mitra = Mitra::findOrFail($id);
            $mitra->is_active = 0;
            $mitra->save();

            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Mitra not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred'], 500);
        }
    }
}
