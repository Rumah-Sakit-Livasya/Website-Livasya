<?php

namespace App\Services\Frontend;

use App\Models\Doctor;
use App\Models\Jadwal;
use App\Models\Jumbotron;
use App\Models\Poliklinik;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class HomePageService
{
    public function __construct(private CommonPageDataService $commonPageData)
    {
    }

    public function beranda(): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'jumbotron' => Cache::remember('frontend.home.jumbotron', now()->addMinutes(30), fn () => Jumbotron::first()),
            'jadwal' => Cache::remember('frontend.home.jadwal', now()->addMinutes(30), fn () => Jadwal::first()),
            'dokter' => Cache::remember('frontend.home.active_doctors', now()->addMinutes(30), fn () => Doctor::where('is_active', 1)->get()),
            'polikliniks' => Cache::remember('frontend.home.polikliniks', now()->addMinutes(30), fn () => Poliklinik::all()),
            'post' => Cache::remember('frontend.home.latest_posts', now()->addMinutes(10), function () {
                return Post::with(['category', 'user'])
                    ->where('is_active', 1)
                    ->latest()
                    ->limit(4)
                    ->get();
            }),
            'title' => 'Rumah Sakit di Majalengka',
            'metaDescription' => 'Rumah Sakit Livasya adalah RS di Majalengka yang menyediakan layanan kesehatan, dokter, IGD, rawat jalan, rawat inap, radiologi, laboratorium, dan fasilitas medis untuk keluarga.',
        ]);
    }
}
