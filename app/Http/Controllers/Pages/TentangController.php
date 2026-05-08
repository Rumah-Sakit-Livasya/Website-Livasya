<?php

namespace App\Http\Controllers\Pages;

use App\Services\Frontend\LivasyaPageService;
use Illuminate\Routing\Controller;

class TentangController extends Controller
{
    public function __construct(private LivasyaPageService $livasyaPageService)
    {
    }

    public function index()
    {
        return view('about.index', $this->livasyaPageService->tentang());
    }
}
