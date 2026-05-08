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
        $data = array_merge($this->commonPageData->navigationData(), [
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

        $data['seoSchemas'] = array_merge($data['seoSchemas'] ?? [], $this->homeSeoSchemas($data));

        return $data;
    }

    private function homeSeoSchemas(array $data): array
    {
        $pelayanan = $data['pelayanan'] ?? collect();

        return [
            [
                '@context' => 'https://schema.org',
                '@type' => 'MedicalWebPage',
                '@id' => url('/') . '#home-medical-page',
                'url' => url('/'),
                'name' => 'Rumah Sakit Livasya Majalengka',
                'description' => $data['metaDescription'] ?? 'Rumah Sakit Livasya adalah rumah sakit di Majalengka.',
                'inLanguage' => 'id-ID',
                'about' => [
                    '@id' => url('/') . '#hospital',
                ],
                'mainEntity' => [
                    '@id' => url('/') . '#hospital',
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'ItemList',
                '@id' => url('/') . '#home-services',
                'name' => 'Pelayanan Rumah Sakit Livasya',
                'itemListElement' => $pelayanan->take(6)->values()->map(function ($item, int $index) {
                    return [
                        '@type' => 'ListItem',
                        'position' => $index + 1,
                        'name' => $item->title,
                        'url' => url('/pelayanan/' . $item->slug),
                    ];
                })->all(),
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'SiteNavigationElement',
                '@id' => url('/') . '#home-main-navigation',
                'name' => [
                    'Pelayanan',
                    'Cari Dokter',
                    'Jadwal Dokter',
                    'Fasilitas',
                    'Berita',
                    'Karir',
                ],
                'url' => [
                    url('/pelayanan'),
                    url('/dokter'),
                    url('/jadwal-dokter'),
                    url('/fasilitas-unggulan'),
                    url('/posts'),
                    url('/career'),
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                '@id' => url('/') . '#home-faq',
                'mainEntity' => [
                    [
                        '@type' => 'Question',
                        'name' => 'Apakah RS Livasya melayani pasien di Majalengka dan sekitarnya?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Ya. RS Livasya berada di Majalengka dan menyediakan informasi layanan kesehatan, dokter, fasilitas medis, dan jadwal dokter untuk masyarakat Majalengka dan sekitarnya.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        'name' => 'Bagaimana cara melihat jadwal dokter RS Livasya?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Pengunjung dapat membuka menu Jadwal Dokter atau Cari Dokter untuk melihat informasi dokter dan jadwal praktik yang tersedia.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        'name' => 'Apakah pendaftaran online tersedia?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Tersedia. Tombol Daftar Sekarang mengarahkan pengunjung ke kanal pendaftaran online resmi RS Livasya.',
                        ],
                    ],
                ],
            ],
        ];
    }
}
