<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Identity;
use Illuminate\Http\Request;

class IdentityController extends Controller
{
    public function index()
    {
        return view('pages.identity.index', [
            'title' => "Identitas",
            'identity' => Identity::first()
        ]);
    }
}
