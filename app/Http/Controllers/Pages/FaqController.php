<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();

        return view('pages.faq.index', compact('faqs'), [
            'title' => 'Faq Perusahaan',
        ]);
    }
}
