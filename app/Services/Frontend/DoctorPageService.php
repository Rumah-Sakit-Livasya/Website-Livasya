<?php

namespace App\Services\Frontend;

use App\Models\Doctor;
use Illuminate\Support\Facades\Cache;

class DoctorPageService
{
    public function __construct(private CommonPageDataService $commonPageData)
    {
    }

    public function list(): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'dokters' => Cache::remember('frontend.doctors.list', now()->addMinutes(30), function () {
                return Doctor::with('departement')
                    ->join('departements', 'doctors.departement_id', '=', 'departements.id')
                    ->where('doctors.is_active', 1)
                    ->orderByRaw('CAST(departements.urutan AS UNSIGNED)')
                    ->select('doctors.*')
                    ->get();
            }),
            'title' => 'Dokter Spesialis',
        ]);
    }

    public function detail(Doctor $dokter): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'dokter' => $dokter->loadMissing('departement'),
            'title' => $dokter->name,
        ]);
    }

    public function jadwal(): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'dokter' => Cache::remember('frontend.doctors.schedule', now()->addMinutes(30), fn () => Doctor::where('is_active', 1)->get()),
            'title' => 'Jadwal Dokter',
        ]);
    }
}
