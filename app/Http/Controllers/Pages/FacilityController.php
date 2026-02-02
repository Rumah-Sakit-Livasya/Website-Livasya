<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Identity;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();
        $identity = Identity::first();

        return view('pages.facilities.index', compact('identity', 'facilities'), [
            'title' => 'Fasilitas Unggulan'
        ]);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Facility::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
