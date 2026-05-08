<?php

namespace App\Services\Frontend;

use App\Models\Facility;
use Illuminate\Support\Facades\Cache;

class FacilityPageService
{
    public function __construct(private CommonPageDataService $commonPageData)
    {
    }

    public function unggulan(): array
    {
        return $this->listByFeaturedStatus(1, 'Fasilitas Unggulan');
    }

    public function lainnya(): array
    {
        return $this->listByFeaturedStatus(0, 'Fasilitas Lainnya');
    }

    public function detail(string $slug): array
    {
        $facility = Cache::remember("frontend.facilities.detail.$slug", now()->addMinutes(30), function () use ($slug) {
            return Facility::where('slug', $slug)->firstOrFail();
        });

        return array_merge($this->commonPageData->navigationData(), [
            'facility' => $facility,
            'title' => $facility->name,
        ]);
    }

    private function listByFeaturedStatus(int $status, string $title): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'facilities' => Cache::remember("frontend.facilities.list.$status", now()->addMinutes(30), function () use ($status) {
                return Facility::where('unggulan', $status)->get();
            }),
            'title' => $title,
        ]);
    }
}
