<?php

namespace App\Services\Frontend;

use App\Models\Identity;

class SeoSchemaService
{
    public function website(Identity|null $identity = null): array
    {
        $siteName = $this->siteName($identity);

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => url('/') . '#website',
            'url' => url('/'),
            'name' => $siteName,
            'alternateName' => [
                'RS Livasya',
                'RSIA Livasya',
                'Rumah Sakit Livasya Majalengka',
            ],
            'inLanguage' => 'id-ID',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/posts') . '?search={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    public function hospital(Identity|null $identity = null): array
    {
        $sameAs = array_values(array_filter([
            $identity?->facebook,
            $identity?->instagram,
            $identity?->twitter,
            $identity?->youtube,
        ], fn ($url) => filled($url) && $url !== '#'));

        return array_filter([
            '@context' => 'https://schema.org',
            '@type' => ['Hospital', 'LocalBusiness', 'MedicalOrganization'],
            '@id' => url('/') . '#hospital',
            'name' => $this->siteName($identity),
            'alternateName' => [
                'RS Livasya',
                'RSIA Livasya',
                'Rumah Sakit di Majalengka',
                'RS di Majalengka',
            ],
            'description' => 'Rumah Sakit Livasya adalah rumah sakit di Majalengka yang menyediakan layanan kesehatan, dokter, fasilitas medis, dan informasi layanan rumah sakit untuk masyarakat Majalengka dan sekitarnya.',
            'url' => url('/'),
            'logo' => asset('img/logo.png'),
            'image' => asset('img/rsialivasya.webp'),
            'telephone' => $identity?->no_telp,
            'email' => $identity?->email,
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $identity?->alamat ?: 'Majalengka',
                'addressLocality' => 'Majalengka',
                'addressRegion' => 'Jawa Barat',
                'addressCountry' => 'ID',
            ],
            'areaServed' => [
                [
                    '@type' => 'City',
                    'name' => 'Majalengka',
                ],
                [
                    '@type' => 'AdministrativeArea',
                    'name' => 'Kabupaten Majalengka',
                ],
            ],
            'medicalSpecialty' => [
                'Obstetric',
                'Gynecologic',
                'Pediatric',
                'Emergency',
                'Radiologic',
                'LaboratoryScience',
            ],
            'sameAs' => $sameAs ?: null,
        ], fn ($value) => $value !== null && $value !== '');
    }

    public function breadcrumbs(array $items): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect($items)->values()->map(function (array $item, int $index) {
                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $item['name'],
                    'item' => $item['url'],
                ];
            })->all(),
        ];
    }

    private function siteName(Identity|null $identity): string
    {
        return $identity?->name ?: 'Rumah Sakit Livasya Majalengka';
    }
}
