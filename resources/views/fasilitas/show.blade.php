@extends('layouts.main')

@section('title', $facility->name)
@section('meta_description', trim($facility->name . '. Lihat fasilitas medis dan penunjang di RS Livasya Majalengka.'))

@section('container')
    <style>
        .hero-fasilitas {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.75) 100%),
                        url("{{ $facility->image ? asset('/storage/' . $facility->image) : asset('img/rsialivasya.webp') }}") center center / cover no-repeat;
            height: 260px;
            border-radius: 0 0 24px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .meta-badge {
            background-color: #f3f4f6;
            color: #4b5563;
            font-size: 12px;
            font-weight: 600;
            border-radius: 20px;
            padding: 6px 14px;
            display: inline-flex;
            align-items: center;
            border: 1px solid #e5e7eb;
        }

        .meta-badge i {
            color: #2563eb;
        }

        .detail-card {
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 16px;
            background: #fff;
        }

        .facility-body-content p {
            color: #4b5563;
            line-height: 1.85;
            margin-bottom: 1.5rem;
            font-size: 15px;
        }

        .facility-body-content h2, .facility-body-content h3, .facility-body-content h4 {
            color: #1f2937;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #e5e7eb;
            color: #4b5563;
            font-weight: 700;
            font-size: 14px;
            border-radius: 25px;
            padding: 10px 24px;
            text-decoration: none !important;
            transition: all 0.2s ease;
            background-color: #fff;
        }

        .btn-back:hover {
            border-color: #2563eb;
            color: #2563eb;
            background-color: #f0fdf4;
            transform: translateX(-3px);
        }
    </style>

    {{-- Unified Compact Hero Banner --}}
    <div class="container my-4">
        <div class="hero-fasilitas position-relative d-flex align-items-end" style="overflow: hidden;">
            <div class="p-4 p-md-5 w-100" data-aos="fade-up">
                <span class="badge bg-light text-primary font-weight-bold px-3 py-1-5 mb-2 text-uppercase" style="border-radius: 20px; font-size: 10px; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Detail Fasilitas</span>
                <h1 class="text-white font-weight-bold mb-0 text-shadow" style="font-size: 1.85rem; line-height: 1.4; text-shadow: 2px 2px 12px rgba(0,0,0,0.75);">
                    {{ $facility->name }}
                </h1>
            </div>
        </div>
    </div>

    {{-- Content Area --}}
    <section class="main py-4 bg-light overflow-hidden">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    
                    {{-- Metadata row --}}
                    <div class="mb-4">
                        <span class="meta-badge">
                            <i class="fas fa-calendar-alt mr-2"></i> Diperbarui {{ $facility->created_at->diffForHumans() }}
                        </span>
                    </div>

                    {{-- Main article card --}}
                    <div class="card border-0 shadow-xs p-4 p-md-5 mb-4 detail-card">
                        
                        {{-- Featured Image inside the card --}}
                        <div class="mb-4 text-center">
                            <img src="{{ $facility->image ? asset('storage/' . $facility->image) : asset('img/rsialivasya.webp') }}" 
                                 class="img-fluid rounded-lg shadow-sm w-100" 
                                 style="max-height: 460px; object-fit: cover; border-radius: 12px;" 
                                 alt="{{ $facility->name }}">
                        </div>

                        {{-- Body content --}}
                        <div class="facility-body-content text-dark">
                            {!! $facility->body !!}
                        </div>

                        <hr class="my-4 border-faded">

                        {{-- Back Action Button --}}
                        <div class="mt-2 text-left">
                            <a href="/fasilitas-unggulan" class="btn-back">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Fasilitas
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
