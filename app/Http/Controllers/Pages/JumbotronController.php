<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Jumbotron;
use Illuminate\Http\Request;

class JumbotronController extends Controller
{
    public function index()
    {
        return view('pages.jumbotron.index', [
            'title' => 'Jumbotron',
            'jumbotron' => Jumbotron::first()
        ]);
    }
}
