<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Identity;
use App\Models\Jumbotron;
use Illuminate\Http\Request;

class JumbotronController extends Controller
{
    public function index()
    {
        $jumbotron = Jumbotron::first();
        $identity = Identity::first();

        return view('pages.jumbotron.index', compact('jumbotron'), [
            'title' => 'Jumbotron',
        ]);
    }
}
