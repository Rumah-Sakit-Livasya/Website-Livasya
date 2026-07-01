@extends('layouts.main')

@section('title', $dokter->name)
@section('meta_description', trim($dokter->name . ' - ' . $dokter->jabatan . '. Lihat profil dan jadwal praktik dokter RS Livasya Majalengka.'))

@section('container')
    <style>
        .hero-dokter {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.65) 100%),
                        url("/img/dokter.webp") center center / cover no-repeat;
            height: 240px;
            border-radius: 0 0 24px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .profile-img-container {
            border-radius: 16px;
            overflow: hidden;
            border: 5px solid #fff;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        }

        .meta-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #9ca3af;
            font-weight: 700;
        }

        .meta-value {
            font-size: 14px;
            color: #1f2937;
            font-weight: 600;
        }

        .detail-card {
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 16px;
            background: #fff;
        }

        .gallery-box {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .gallery-box:hover {
            transform: translateY(-4px);
            border-color: #2563eb;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.15);
        }

        .gallery-box img {
            transition: all 0.3s ease;
        }

        .gallery-box:hover img {
            transform: scale(1.04);
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .gallery-box:hover .gallery-overlay {
            opacity: 1;
        }
        
        .bio-content p {
            color: #4b5563;
            line-height: 1.8;
            margin-bottom: 1.25rem;
        }
    </style>

    {{-- Compact Hero Banner --}}
    <div class="container my-4">
        <div class="hero-dokter position-relative d-flex align-items-end" style="overflow: hidden;">
            <div class="p-4 w-100" data-aos="fade-up">
                <span class="badge bg-light text-primary font-weight-bold px-3 py-1-5 mb-2 text-uppercase" style="border-radius: 20px; font-size: 10px; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Profil Dokter</span>
                <h1 class="text-white font-weight-bold mb-0 text-shadow" style="font-size: 2rem; text-shadow: 2px 2px 10px rgba(0,0,0,0.65);">
                    {{ $dokter->name }}
                </h1>
            </div>
        </div>
    </div>

    {{-- Main Body --}}
    <section class="main py-4 bg-light overflow-hidden">
        <div class="container">
            <div class="row">
                
                {{-- Left Sidebar Profile Summary --}}
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-xs p-4 detail-card text-center">
                        <div class="profile-img-container mx-auto mb-4" style="width: 200px; height: 200px;">
                            <img src="{{ $dokter->foto ? asset('storage/' . $dokter->foto) : '/img/default-doc.jpg' }}" 
                                 class="w-100 h-100 img-fluid" 
                                 style="object-fit: cover;"
                                 alt="{{ $dokter->name }}"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20width%3D%22100%25%22%20height%3D%22100%25%22%20fill%3D%22%23f3f4f6%22%2F%3E%3Ctext%20x%3D%2250%25%22%20y%3D%2250%25%22%20font-size%3D%2214%22%20fill%3D%22%239ca3af%22%20font-family%3D%22sans-serif%22%20text-anchor%3D%22middle%22%20dy%3D%22.3em%22%3EDokter%3C%2Ftext%3E%3C%2Fsvg%3E';">
                        </div>

                        <h3 class="font-weight-bold text-dark mb-1" style="font-size: 1.25rem;">{{ $dokter->name }}</h3>
                        <span class="badge bg-primary text-white font-weight-bold px-3 py-1-5 mb-4 text-uppercase" style="border-radius: 20px; font-size: 11px;">
                            {{ $dokter->departement->name ?? 'Dokter' }}
                        </span>

                        <hr class="my-3 border-faded">

                        <div class="text-left mt-3">
                            <div class="mb-3">
                                <span class="meta-label d-block mb-1">Spesialisasi</span>
                                <span class="meta-value d-flex align-items-center">
                                    <i class="fas fa-stethoscope mr-2 text-primary"></i> {{ $dokter->jabatan }}
                                </span>
                            </div>
                            <div>
                                <span class="meta-label d-block mb-1">Departemen Medis</span>
                                <span class="meta-value d-flex align-items-center">
                                    <i class="fas fa-hospital mr-2 text-primary"></i> {{ $dokter->departement->name ?? 'RS Livasya' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column Content & Gallery --}}
                <div class="col-lg-8">
                    
                    {{-- Bio Card --}}
                    <div class="card border-0 shadow-xs p-4 p-md-5 mb-4 detail-card">
                        <h4 class="font-weight-bold text-dark mb-3 pb-2" style="font-size: 1.15rem; border-bottom: 2px solid #eff6ff;">
                            <i class="fas fa-user-circle text-primary mr-2"></i> Biografi & Profil Dokter
                        </h4>
                        <div class="bio-content">
                            @if($dokter->deskripsi)
                                {!! $dokter->deskripsi !!}
                            @else
                                <p class="text-muted italic mb-0">Belum ada deskripsi biografi untuk dokter ini.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Schedule & Poster Cards --}}
                    @if($dokter->poster || $dokter->jadwal)
                        <div class="card border-0 shadow-xs p-4 p-md-5 detail-card">
                            <h4 class="font-weight-bold text-dark mb-4 pb-2" style="font-size: 1.15rem; border-bottom: 2px solid #eff6ff;">
                                <i class="fas fa-calendar-alt text-primary mr-2"></i> Jadwal Praktik & Poster Profil
                            </h4>
                            <div class="row">
                                @if($dokter->poster)
                                    <div class="col-sm-6 mb-4">
                                        <p class="meta-label mb-2 text-center">Poster Profil</p>
                                        <div class="gallery-box">
                                            <a href="{{ asset('storage/' . $dokter->poster) }}" data-fancybox="gallery" data-caption="{{ $dokter->name }} - Poster">
                                                <img src="{{ asset('storage/' . $dokter->poster) }}" class="w-100" style="height: 280px; object-fit: cover;" alt="Poster">
                                                <div class="gallery-overlay">
                                                    <i class="fas fa-search-plus text-white" style="font-size: 2rem;"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                @if($dokter->jadwal)
                                    <div class="col-sm-6 mb-4">
                                        <p class="meta-label mb-2 text-center">Jadwal Praktik</p>
                                        <div class="gallery-box">
                                            <a href="{{ asset('storage/' . $dokter->jadwal) }}" data-fancybox="gallery" data-caption="{{ $dokter->name }} - Jadwal Praktik">
                                                <img src="{{ asset('storage/' . $dokter->jadwal) }}" class="w-100" style="height: 280px; object-fit: cover;" alt="Jadwal Praktik">
                                                <div class="gallery-overlay">
                                                    <i class="fas fa-search-plus text-white" style="font-size: 2rem;"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
