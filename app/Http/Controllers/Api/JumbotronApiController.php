<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jumbotron;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JumbotronApiController extends Controller
{
    public function show()
    {
        $jumbotron = Jumbotron::first();
        return response()->json($jumbotron);
    }

    public function update(Request $request, $id)
    {
        $jumbotron = Jumbotron::findOrFail($id);

        $rules = [
            'title' => 'required|max:255',
            'title_description' => 'required',
            'main_image' => 'image|file',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('main_image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['main_image'] = $request->file('main_image')->store('img-jumbotron');
        }

        $jumbotron->update($validatedData);

        return response()->json(['message' => 'Jumbotron updated successfully']);
    }
}
