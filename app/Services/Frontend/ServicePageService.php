<?php

namespace App\Services\Frontend;

use App\Models\Pelayanan;

class ServicePageService
{
    public function __construct(private CommonPageDataService $commonPageData)
    {
    }

    public function detail(string $slug): array
    {
        $pelayananPage = Pelayanan::with('images')->where('slug', $slug)->firstOrFail();

        return array_merge($this->commonPageData->navigationData(), [
            'pelayananPage' => $pelayananPage,
            'pelayananImages' => $pelayananPage->images,
            'title' => $pelayananPage->title,
        ]);
    }
}
