<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerApiController extends Controller
{
    public function getCareer()
    {
        $categories = Career::all();

        return response()->json($categories);
    }

    public function store(Request $request)
    {
        if (!$request['status']) {
            $request['status'] = "off";
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'tipe' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        $career = Career::create($validatedData);

        return response()->json(['message' => 'Karir berhasil ditambahkan', 'career' => $career]);
    }

    public function show(Career $career)
    {
        return response()->json($career);
    }

    public function update(Request $request, Career $career)
    {
        if (!$request['status']) {
            $request['status'] = "off";
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'tipe' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        $career->update($validatedData);

        return response()->json(['message' => 'Career updated successfully']);
    }
}
