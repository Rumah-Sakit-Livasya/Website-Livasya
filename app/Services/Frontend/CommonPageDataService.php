<?php

namespace App\Services\Frontend;

use App\Models\Identity;
use App\Models\Mitra;
use App\Models\Pelayanan;
use Illuminate\Support\Facades\Cache;

class CommonPageDataService
{
    public function __construct(private SeoSchemaService $seoSchema)
    {
    }

    public function navigationData(): array
    {
        return Cache::remember('frontend.common.navigation', now()->addMinutes(30), function () {
            $data = [
                'identity' => Identity::first(),
                'pelayanan' => Pelayanan::all(),
                'mitras' => Mitra::where('is_primary', 1)->get(),
            ];

            $data['seoSchemas'] = [
                $this->seoSchema->website($data['identity']),
                $this->seoSchema->hospital($data['identity']),
            ];

            return $data;
        });
    }
}
