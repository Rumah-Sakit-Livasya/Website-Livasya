@extends('layouts.main')

@section('container')
    <style>
        .hero-fasilitas {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.65) 100%),
                        url("/img/fasilitas/header.jpg") center center / cover no-repeat;
            height: 240px;
            border-radius: 0 0 24px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .facility-card {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            height: 100%;
        }

        .facility-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.08);
            border-color: #dbeafe;
        }

        .facility-img-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .facility-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .facility-card:hover .facility-img {
            transform: scale(1.03);
        }

        .floating-icon {
            position: absolute;
            bottom: -22px;
            left: 20px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: #2563eb;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.35);
            z-index: 2;
            border: 2px solid #fff;
        }

        .facility-title {
            font-size: 15px;
            font-weight: 700;
            line-height: 1.4;
            color: #1f2937;
            margin-top: 10px;
        }

        .facility-excerpt {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 58px;
        }

        .btn-read-more {
            display: inline-flex;
            align-items: center;
            color: #2563eb;
            font-weight: 700;
            font-size: 13.5px;
            text-decoration: none !important;
            transition: all 0.2s;
        }

        .btn-read-more:hover {
            color: #1d4ed8;
        }

        .btn-read-more i {
            transition: transform 0.2s;
        }

        .btn-read-more:hover i {
            transform: translateX(4px);
        }
    </style>

    {{-- Unified Compact Hero Banner --}}
    <div class="container my-4">
        <div class="hero-fasilitas position-relative d-flex align-items-end" style="overflow: hidden;">
            <div class="p-4 w-100" data-aos="fade-up">
                <span class="badge bg-light text-primary font-weight-bold px-3 py-1-5 mb-2 text-uppercase" style="border-radius: 20px; font-size: 10px; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Fasilitas RS Livasya</span>
                <h1 class="text-white font-weight-bold mb-0 text-shadow" style="font-size: 2rem; text-shadow: 2px 2px 10px rgba(0,0,0,0.65);">
                    {{ $title }}
                </h1>
            </div>
        </div>
    </div>

    {{-- Grid content section --}}
    <section class="fasilitas py-4 bg-light overflow-hidden">
        @if ($facilities->count())
            <div class="container">
                <div class="row g-4 justify-content-center">
                    @foreach ($facilities as $facility)
                        <div class="col-sm-6 col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                            <div class="facility-card d-flex flex-column justify-content-between">
                                <div>
                                    {{-- Facility Image --}}
                                    <div class="facility-img-container">
                                        <img src="{{ $facility->image ? asset('/storage/' . $facility->image) : asset('img/rsialivasya.webp') }}"
                                             alt="Foto {{ $facility->name }}"
                                             class="facility-img"
                                             onerror="this.onerror=null; this.src='{{ asset('img/rsialivasya.webp') }}';">
                                        
                                        {{-- Circular floating icon --}}
                                        <div class="floating-icon">
                                            <i class="{{ $facility->icon ?? 'fas fa-heartbeat' }}" style="font-size: 16px;"></i>
                                        </div>
                                    </div>

                                    {{-- Facility Body --}}
                                    <div class="p-4 pt-3">
                                        <h3 class="facility-title mb-2">{{ $facility->name }}</h3>
                                        <div class="facility-excerpt mb-3">
                                            {!! strip_tags($facility->excerpt ?? $facility->body) !!}
                                        </div>
                                    </div>
                                </div>

                                {{-- Footer Read More --}}
                                <div class="px-4 pb-4 bg-white" style="border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">
                                    <hr class="my-2 border-faded">
                                    <div class="pt-2">
                                        <a href="/fasilitas/{{ $facility->slug }}" class="btn-read-more">
                                            Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center text-muted mb-3" style="width: 80px; height: 80px;">
                    <i class="fas fa-procedures" style="font-size: 30px;"></i>
                </div>
                <p class="fs-5 font-weight-bold text-dark">Tidak ditemukan fasilitas.</p>
            </div>
        @endif
    </section>
@endsection
