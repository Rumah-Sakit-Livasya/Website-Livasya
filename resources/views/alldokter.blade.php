@extends('layouts.main')

@section('meta_description', 'Temukan dokter spesialis RS Livasya Majalengka lengkap dengan profil dan jadwal praktik untuk layanan kesehatan ibu, anak, dan keluarga.')

@section('container')
    <style>
        .hero-dokter {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.65) 100%),
                        url("/img/dokter.webp") center center / cover no-repeat;
            height: 250px;
            border-radius: 0 0 24px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .dept-title {
            position: relative;
            font-size: 1.5rem;
            color: #1f2937;
            font-weight: 700;
            padding-left: 14px;
            border-left: 5px solid #2563eb;
            margin-bottom: 25px;
        }

        .doctor-card {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            transition: all 0.3s ease;
            text-align: center;
            height: 100%;
        }

        .doctor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
            border-color: #3b82f6;
        }

        .avatar-wrapper {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            border: 4px solid #f3f4f6;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .doctor-card:hover .avatar-wrapper {
            border-color: #dbeafe;
            transform: scale(1.03);
        }

        .btn-profile {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #eff6ff;
            color: #2563eb;
            font-weight: 700;
            font-size: 13px;
            border-radius: 20px;
            padding: 8px 20px;
            text-decoration: none !important;
            transition: all 0.2s ease;
            width: 100%;
            border: 1px solid #dbeafe;
        }

        .doctor-card:hover .btn-profile {
            background-color: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }
    </style>

    {{-- Unified Compact Hero Banner --}}
    <div class="container my-4">
        <div class="hero-dokter position-relative d-flex align-items-end" style="overflow: hidden;">
            <div class="p-4 w-100" data-aos="fade-up">
                <span class="badge bg-light text-primary font-weight-bold px-3 py-1-5 mb-2 text-uppercase" style="border-radius: 20px; font-size: 10px; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Daftar Medis</span>
                <h1 class="text-white font-weight-bold mb-0 text-shadow" style="font-size: 2rem; text-shadow: 2px 2px 10px rgba(0,0,0,0.65);">
                    {{ $title }}
                </h1>
            </div>
        </div>
    </div>

    {{-- Doctors Section --}}
    <section class="doctors py-4 bg-light overflow-hidden">
        <div class="container">
            @php
                $grouped = $dokters->groupBy(function($d) {
                    return $d->departement->name ?? 'Umum';
                });
            @endphp

            @foreach ($grouped as $deptName => $listDokter)
                <div class="mb-5">
                    <h2 class="dept-title d-flex align-items-center justify-content-between">
                        <span>Dokter Spesialis {{ $deptName }}</span>
                        <span class="badge badge-pill text-primary" style="background-color: #ede9fe; font-size: 12px; font-weight: 700; padding: 6px 12px;">{{ $listDokter->count() }} Dokter</span>
                    </h2>

                    <div class="row">
                        @foreach ($listDokter as $dokter)
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                                <div class="doctor-card p-4 d-flex flex-column justify-content-between" data-aos="fade-up">
                                    <div>
                                        <div class="avatar-wrapper mb-3">
                                            <img src="{{ $dokter->foto ? asset('storage/' . $dokter->foto) : '/img/default-doc.jpg' }}"
                                                 alt="Foto {{ $dokter->name }}"
                                                 class="w-100 h-100"
                                                 style="object-fit: cover;"
                                                 onerror="this.onerror=null; this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22140%22%20height%3D%22140%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20width%3D%22100%25%22%20height%3D%22100%25%22%20fill%3D%22%23f3f4f6%22%2F%3E%3Ctext%20x%3D%2250%25%22%20y%3D%2250%25%22%20font-size%3D%2212%22%20fill%3D%22%239ca3af%22%20font-family%3D%22sans-serif%22%20text-anchor%3D%22middle%22%20dy%3D%22.3em%22%3EDokter%3C%2Ftext%3E%3C%2Fsvg%3E';">
                                        </div>
                                        <h4 class="font-weight-bold text-dark mb-1" style="font-size: 15px; line-height: 1.4;">{{ $dokter->name }}</h4>
                                        <p class="text-muted mb-3" style="font-size: 12px; font-weight: 500;">
                                            <i class="fas fa-stethoscope mr-1 text-primary"></i> {{ $dokter->jabatan }}
                                        </p>
                                    </div>
                                    <div class="mt-2">
                                        <a href="/dokter/{{ $dokter->id }}" class="btn-profile">
                                            Lihat Jadwal & Profil
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
