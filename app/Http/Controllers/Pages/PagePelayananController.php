<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Services\Frontend\ServicePageService;

class PagePelayananController extends Controller
{
    public function __construct(private ServicePageService $servicePageService)
    {
    }

    public function index($slug)
    {
        return view('pelayanan', $this->servicePageService->detail($slug));
    }
}
