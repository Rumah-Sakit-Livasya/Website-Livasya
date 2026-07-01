@extends('layouts.main')

@section('container')
    <style>
        .hero-mitra {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.65) 100%),
                        url("/img/rs.webp") center center / cover no-repeat;
            height: 240px;
            border-radius: 0 0 24px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .partner-box {
            background: #fff;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            padding: 20px;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            transition: all 0.2s ease;
        }

        .partner-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            border-color: #3b82f6;
        }

        .partner-logo {
            max-height: 55px;
            max-width: 100%;
            object-fit: contain;
            filter: grayscale(100%);
            opacity: 0.75;
            transition: all 0.2s ease;
        }

        .partner-box:hover .partner-logo {
            filter: grayscale(0%);
            opacity: 1;
        }
    </style>

    {{-- Unified Compact Hero Banner --}}
    <div class="container my-4">
        <div class="hero-mitra position-relative d-flex align-items-end" style="overflow: hidden;">
            <div class="p-4 w-100" data-aos="fade-up">
                <span class="badge bg-light text-primary font-weight-bold px-3 py-1-5 mb-2 text-uppercase" style="border-radius: 20px; font-size: 10px; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Kemitraan Medis</span>
                <h1 class="text-white font-weight-bold mb-0 text-shadow" style="font-size: 2rem; text-shadow: 2px 2px 10px rgba(0,0,0,0.65);">
                    Mitra Kami
                </h1>
            </div>
        </div>
    </div>

    {{-- Partners Grid Section --}}
    <section class="gallery py-4 bg-light overflow-hidden">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @foreach ($mitraPage as $mitra)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="partner-box">
                            <img src="{{ asset('storage/' . $mitra->image) }}" 
                                 alt="Logo {{ $mitra->name }}" 
                                 class="partner-logo"
                                 title="{{ $mitra->name }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
