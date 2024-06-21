<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::orderBy('urutan')->get();

        return view('pages.departements.index', compact('departements'), [
            'title' => 'Departemen'
        ]);
    }
}
