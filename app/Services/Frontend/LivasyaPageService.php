<?php

namespace App\Services\Frontend;

use App\Models\Faq;
use App\Models\Galery;
use App\Models\Mitra;
use App\Models\Timeline;
use Illuminate\Support\Facades\Cache;

class LivasyaPageService
{
    public function __construct(private CommonPageDataService $commonPageData)
    {
    }

    public function tentang(): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'timelines' => Cache::remember('frontend.livasya.timelines', now()->addMinutes(30), fn () => Timeline::all()),
            'title' => 'Tentang Kami',
        ]);
    }

    public function galeri(): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'galleries' => Cache::remember('frontend.livasya.galleries', now()->addMinutes(30), fn () => Galery::all()),
            'title' => 'Galeri',
        ]);
    }

    public function mitra(): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'mitraPage' => Cache::remember('frontend.livasya.mitras', now()->addMinutes(30), fn () => Mitra::all()),
            'title' => 'Mitra Kami',
        ]);
    }

    public function kebijakanPrivasi(): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'title' => 'Kebijakan Privasi',
        ]);
    }

    public function syaratKetentuan(): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'title' => 'Syarat & Ketentuan',
        ]);
    }

    public function faq(): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'faqs' => Cache::remember('frontend.livasya.faqs', now()->addMinutes(30), fn () => Faq::where('is_active', 1)->get()),
            'title' => 'FAQ',
        ]);
    }

    public function league(): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'title' => 'Livasya League',
        ]);
    }
}
