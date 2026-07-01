@extends('layouts.main')

@section('container')
    <style>
        .hero-gallery {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.65) 100%),
                        url("/img/gallery.webp") center center / cover no-repeat;
            height: 240px;
            border-radius: 0 0 24px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .gallery-box {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            border: 2px solid transparent;
            transition: all 0.3s ease;
            cursor: pointer;
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
    </style>

    {{-- Unified Compact Hero Banner --}}
    <div class="container my-4">
        <div class="hero-gallery position-relative d-flex align-items-end" style="overflow: hidden;">
            <div class="p-4 w-100" data-aos="fade-up">
                <span class="badge bg-light text-primary font-weight-bold px-3 py-1-5 mb-2 text-uppercase" style="border-radius: 20px; font-size: 10px; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Galeri Kegiatan</span>
                <h1 class="text-white font-weight-bold mb-0 text-shadow" style="font-size: 2rem; text-shadow: 2px 2px 10px rgba(0,0,0,0.65);">
                    Galeri Livasya
                </h1>
            </div>
        </div>
    </div>

    {{-- Gallery Grid Section --}}
    <section class="gallery py-4 bg-light overflow-hidden">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @foreach ($galleries as $gallery)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="gallery-box">
                            <a href="{{ asset('/storage/' . $gallery->image) }}" data-fancybox="group" data-caption="{{ $gallery->caption }}">
                                <img src="{{ asset('/storage/' . $gallery->image) }}" 
                                     class="w-100 img-fluid" 
                                     style="height: 220px; object-fit: cover;" 
                                     alt="Galeri - {{ $gallery->caption }}"
                                     onerror="this.onerror=null; this.src='{{ asset('img/rsialivasya.webp') }}';">
                                <div class="gallery-overlay">
                                    <div class="text-center text-white px-2">
                                        <i class="fas fa-search-plus mb-2" style="font-size: 1.5rem;"></i>
                                        <p class="mb-0 font-weight-bold small text-truncate" style="max-width: 160px;">{{ $gallery->caption }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
