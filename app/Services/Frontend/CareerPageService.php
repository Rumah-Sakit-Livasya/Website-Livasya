<?php

namespace App\Services\Frontend;

use App\Models\Career;
use App\Models\Doctor;
use App\Models\Galery;
use Illuminate\Support\Facades\Cache;

class CareerPageService
{
    public function __construct(private CommonPageDataService $commonPageData)
    {
    }

    public function list(): array
    {
        $data = $this->baseData();

        return array_merge($data, [
            'name' => $data['identity']->name ?? config('app.name'),
            'title' => 'Lowongan Kerja',
            'dokter' => Cache::remember('frontend.careers.doctors', now()->addMinutes(30), fn () => Doctor::where('is_active', 1)->get()),
            'galleries' => Cache::remember('frontend.careers.galleries', now()->addMinutes(30), fn () => Galery::all()),
            'careers' => Cache::remember('frontend.careers.active', now()->addMinutes(10), function () {
                return Career::where('status', 'on')->orderBy('created_at', 'desc')->get();
            }),
        ]);
    }

    public function byType(string $tipe): array
    {
        $data = $this->baseData();

        return array_merge($data, [
            'name' => $data['identity']->name ?? config('app.name'),
            'title' => "Lowongan tenaga $tipe",
            'tipe' => $tipe,
            'galleries' => Cache::remember('frontend.careers.galleries', now()->addMinutes(30), fn () => Galery::all()),
            'careers' => Cache::remember("frontend.careers.type.$tipe", now()->addMinutes(10), function () use ($tipe) {
                return Career::where('status', 'on')->where('tipe', $tipe)->latest()->get();
            }),
        ]);
    }

    public function apply(string $tipe, int|string $id): array
    {
        $data = $this->baseData();
        $career = Career::where('id', $id)
            ->where('status', 'on')
            ->where('tipe', $tipe)
            ->firstOrFail();

        return array_merge($data, [
            'name' => $data['identity']->name ?? config('app.name'),
            'title' => "Formulir Data Pelamar - $career->title",
            'tipe' => $tipe,
            'career' => $career,
            'galleries' => Cache::remember('frontend.careers.galleries', now()->addMinutes(30), fn () => Galery::all()),
        ]);
    }

    private function baseData(): array
    {
        return $this->commonPageData->navigationData();
    }
}
