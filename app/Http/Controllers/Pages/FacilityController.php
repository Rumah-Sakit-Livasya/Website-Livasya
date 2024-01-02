<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class FacilityController extends Controller
{
    public function index()
    {
        return view('pages.facilities.index', [
            'title' => 'Fasilitas Unggulan',
            'facilities' => Facility::all()
        ]);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Facility::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
