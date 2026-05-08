<?php

namespace App\Services\Frontend;

use App\Models\Career;
use App\Models\Category;
use App\Models\Facility;
use App\Models\Pelayanan;
use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SitemapService
{
    public function urls(): Collection
    {
        return Cache::remember('frontend.sitemap.urls', now()->addMinutes(30), function () {
            return collect()
                ->merge($this->staticUrls())
                ->merge($this->pelayananUrls())
                ->merge($this->postUrls())
                ->merge($this->categoryUrls())
                ->merge($this->facilityUrls())
                ->merge($this->careerUrls())
                ->unique('loc')
                ->values();
        });
    }

    private function staticUrls(): array
    {
        return [
            $this->url('/', '1.0', 'daily'),
            $this->url('/dokter', '0.9', 'weekly'),
            $this->url('/posts', '0.8', 'daily'),
            $this->url('/fasilitas-unggulan', '0.8', 'weekly'),
            $this->url('/fasilitas-lainnya', '0.7', 'weekly'),
            $this->url('/about-us', '0.7', 'monthly'),
            $this->url('/gallery', '0.6', 'weekly'),
            $this->url('/mitra-kami', '0.6', 'monthly'),
            $this->url('/faq', '0.6', 'monthly'),
            $this->url('/career', '0.7', 'daily'),
        ];
    }

    private function pelayananUrls(): Collection
    {
        return Pelayanan::select('slug', 'updated_at')->get()->map(function (Pelayanan $pelayanan) {
            return $this->url("/pelayanan/$pelayanan->slug", '0.8', 'weekly', $pelayanan->updated_at);
        });
    }

    private function postUrls(): Collection
    {
        return Post::where('is_active', 1)->select('slug', 'updated_at')->latest()->get()->map(function (Post $post) {
            return $this->url("/posts/$post->slug", '0.7', 'weekly', $post->updated_at);
        });
    }

    private function categoryUrls(): Collection
    {
        return Category::select('slug', 'updated_at')->get()->map(function (Category $category) {
            return $this->url("/categories/$category->slug", '0.6', 'weekly', $category->updated_at);
        });
    }

    private function facilityUrls(): Collection
    {
        return Facility::select('slug', 'updated_at')->get()->map(function (Facility $facility) {
            return $this->url("/fasilitas/$facility->slug", '0.7', 'weekly', $facility->updated_at);
        });
    }

    private function careerUrls(): Collection
    {
        return Career::where('status', 'on')->select('id', 'tipe', 'updated_at')->get()->map(function (Career $career) {
            return $this->url("/career/$career->tipe/$career->id", '0.6', 'daily', $career->updated_at);
        });
    }

    private function url(string $path, string $priority, string $changefreq, $lastmod = null): array
    {
        return [
            'loc' => url($path),
            'lastmod' => optional($lastmod)->toAtomString() ?? now()->toAtomString(),
            'changefreq' => $changefreq,
            'priority' => $priority,
        ];
    }
}
