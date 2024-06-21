<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DepartementApiController extends Controller
{
    public function getDepartement()
    {
        $departements = Departement::all();

        return response()->json($departements);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'urutan' => 'required|max:255|numeric',
        ]);

        $departement = Departement::create($validatedData);

        return response()->json(['message' => 'Departement berhasil ditambahkan', 'departement' => $departement]);
    }

    public function show($departementId)
    {
        $departement = Departement::findOrFail($departementId);
        return response()->json($departement);
    }

    public function update(Request $request, $departementId)
    {
        $departement = Departement::findOrFail($departementId);
        $rules = [
            'name' => 'required|max:255',
            'urutan' => 'required|max:255|numeric',
        ];

        $validatedData = $request->validate($rules);

        $departement->update($validatedData);

        return response()->json(['message' => 'Departement updated successfully']);
    }

    public function activate($id)
    {
        try {
            $departement = Departement::findOrFail($id);
            $departement->is_active = 1;
            $departement->save();

            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Departement not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred'], 500);
        }
    }

    public function deactivate($id)
    {
        try {
            $departement = Departement::findOrFail($id);
            $departement->is_active = 0;
            $departement->save();

            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Departement not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred'], 500);
        }
    }
}
