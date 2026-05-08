<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Doctor;
use App\Services\Frontend\DoctorPageService;
use App\Services\Frontend\HomePageService;
use App\Services\Frontend\LivasyaPageService;
use App\Services\Frontend\NewsPageService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private HomePageService $homePageService,
        private DoctorPageService $doctorPageService,
        private NewsPageService $newsPageService,
        private LivasyaPageService $livasyaPageService,
    ) {
    }

    public function index()
    {
        return view('home', $this->homePageService->beranda());
    }

    public function categories()
    {
        return view('categories', $this->newsPageService->categories());
    }

    public function category(Request $request, Category $category)
    {
        return view('category', $this->newsPageService->category($category, $request->only('search')));
    }


    public function gallery()
    {
        return view('gallery', $this->livasyaPageService->galeri());
    }

    public function dokter()
    {
        return view('alldokter', $this->doctorPageService->list());
    }



    public function detailDokter(Doctor $dokter)
    {
        return view('dokter', $this->doctorPageService->detail($dokter));
    }

    public function jadwalDokter()
    {
        return view('jadwal', $this->doctorPageService->jadwal());
    }

    public function mitraKami()
    {
        return view('mitra', $this->livasyaPageService->mitra());
    }

    public function kebijakanPrivasi()
    {
        return view('kebijakan-privasi', $this->livasyaPageService->kebijakanPrivasi());
    }

    public function syaratKetentuan()
    {
        return view('syarat-ketentuan', $this->livasyaPageService->syaratKetentuan());
    }

    public function faq()
    {
        return view('faq', $this->livasyaPageService->faq());
    }
}
