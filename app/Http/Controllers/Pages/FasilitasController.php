<?php

namespace App\Http\Controllers\Pages;

use App\Services\Frontend\FacilityPageService;
use Illuminate\Routing\Controller;

class FasilitasController extends Controller
{
    public function __construct(private FacilityPageService $facilityPageService)
    {
    }

    public function index()
    {
        return view('fasilitas.index', $this->facilityPageService->unggulan());
    }

    public function lainnya()
    {
        return view('fasilitas.index', $this->facilityPageService->lainnya());
    }

    public function show($slug)
    {
        return view('fasilitas.show', $this->facilityPageService->detail($slug));
    }
}
