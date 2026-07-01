@extends('layouts.main')

@section('container')
    <style>
        .hero-igd {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.65) 100%),
                        url("{{ $pelayananPage->header ? asset('/storage/' . $pelayananPage->header) : '/img/default-pelayanan.jpg' }}");
            background-size: cover;
            background-position: center center;
            height: 260px;
            border-radius: 0 0 24px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .transition-all {
            transition: all 0.25s ease-in-out;
        }
        
        .services-nav-item {
            color: #4b5563;
            background-color: #fff;
            border-bottom: 1px solid #f3f4f6 !important;
            text-decoration: none !important;
        }
        
        .services-nav-item:hover {
            background-color: #f8fafc;
            color: #1d4ed8;
            border-left: 4px solid #3b82f6 !important;
            padding-left: 1.5rem !important;
        }
        
        .services-nav-item:hover .arrow-icon {
            transform: translateX(4px);
            color: #3b82f6 !important;
        }
        
        .active-service {
            background-color: #eff6ff !important;
            color: #1d4ed8 !important;
            border-left: 4px solid #2563eb !important;
            font-weight: 700 !important;
        }
        
        .active-service .icon-service {
            color: #2563eb !important;
        }
        
        .active-service .arrow-icon {
            color: #2563eb !important;
            transform: translateX(4px);
        }

        /* Slider Custom Styling */
        .slider-single .slick-prev, .slider-single .slick-next {
            z-index: 10;
            width: 38px;
            height: 38px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            transition: all 0.2s;
            box-shadow: 0 4px 8px rgba(0,0,0,0.12);
        }
        .slider-single .slick-prev:hover, .slider-single .slick-next:hover {
            background-color: #fff;
            transform: scale(1.05);
        }
        .slider-single .slick-prev {
            left: 15px;
        }
        .slider-single .slick-next {
            right: 15px;
        }
        .slider-single .slick-prev:before, .slider-single .slick-next:before {
            color: #2563eb;
            font-size: 16px;
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            opacity: 1;
        }
        .slider-single .slick-prev:before {
            content: '\f053';
        }
        .slider-single .slick-next:before {
            content: '\f054';
        }
        
        .slider-nav .slick-slide.is-active .thumbnail-nav-wrapper {
            border-color: #2563eb !important;
            transform: scale(0.95);
            opacity: 1;
        }
        .thumbnail-nav-wrapper {
            opacity: 0.6;
        }
        .thumbnail-nav-wrapper:hover {
            opacity: 0.95;
        }

        /* Typography & Body styling */
        .service-body-content p {
            margin-bottom: 1.25rem;
            color: #4b5563;
        }
        .service-body-content ul {
            padding-left: 0.25rem;
            margin-bottom: 1.5rem;
            list-style-type: none;
        }
        .service-body-content ul li {
            position: relative;
            padding-left: 1.75rem;
            margin-bottom: 0.6rem;
            color: #4b5563;
        }
        .service-body-content ul li::before {
            content: "\f058";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: #10b981;
            position: absolute;
            left: 0;
            top: 2px;
            font-size: 14px;
        }
        .service-body-content h2, .service-body-content h3, .service-body-content h4 {
            color: #1f2937;
            font-weight: 700;
            margin-top: 1.75rem;
            margin-bottom: 0.75rem;
        }
        .service-body-content h2 {
            font-size: 1.35rem;
            border-left: 4px solid #2563eb;
            padding-left: 10px;
        }

        @media (max-width: 991.98px) {
            .hero-igd {
                height: 180px;
            }
            .services-nav-container {
                display: flex !important;
                flex-direction: row !important;
                white-space: nowrap !important;
                overflow-x: auto !important;
                background-color: #fff;
                padding: 12px !important;
                gap: 8px;
            }
            .services-nav-item {
                flex: 0 0 auto;
                border-radius: 20px !important;
                border: 1px solid #e5e7eb !important;
                padding: 8px 16px !important;
                font-size: 13px !important;
                background-color: #f9fafb !important;
            }
            .services-nav-item::after {
                content: none !important;
            }
            .active-service {
                background-color: #2563eb !important;
                color: #fff !important;
                border-color: #2563eb !important;
            }
            .active-service .icon-service, .active-service .arrow-icon {
                color: #fff !important;
            }
            .arrow-icon {
                display: none !important;
            }
            .icon-service {
                margin-right: 6px !important;
            }
        }
    </style>

    {{-- Unified Compact Hero Banner --}}
    <div class="container my-4">
        <div class="hero-igd position-relative d-flex align-items-end rounded-lg" style="overflow: hidden;">
            <div class="p-4 w-100" data-aos="fade-up">
                <span class="badge bg-light text-primary font-weight-bold px-3 py-1-5 mb-2 text-uppercase" style="border-radius: 20px; font-size: 10px; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Layanan Medis</span>
                <h1 class="text-white font-weight-bold mb-0 text-shadow" style="font-size: 2rem; text-shadow: 2px 2px 10px rgba(0,0,0,0.65);">
                    {{ $title }}
                </h1>
            </div>
        </div>
    </div>

    {{-- Main Content Section --}}
    <section class="content bg-light py-4 overflow-hidden">
        <div class="container">
            <div class="row">
                {{-- Sidebar Navigation --}}
                <div class="col-lg-3">
                    <div class="card border-0 shadow-xs mb-4" style="border-radius: 12px; overflow: hidden; border: 1px solid rgba(0,0,0,0.05);">
                        <div class="card-header bg-primary text-white p-3 font-weight-bold d-none d-lg-flex align-items-center" style="font-size: 14px;">
                            <i class="fas fa-notes-medical mr-2"></i> Daftar Layanan Medis
                        </div>
                        <div class="list-group list-group-flush services-nav-container">
                            @foreach ($pelayanan as $p)
                                @php
                                    $isActive = Request::is('pelayanan/' . $p->slug);
                                @endphp
                                <a href="/pelayanan/{{ $p->slug }}" 
                                   class="list-group-item list-group-item-action services-nav-item border-0 p-3 d-flex align-items-center justify-content-between transition-all {{ $isActive ? 'active-service' : '' }}"
                                   style="font-size: 13.5px; font-weight: 600; border-left: 4px solid transparent !important;">
                                    <span class="d-flex align-items-center">
                                        <i class="{{ $p->icon ?? 'fas fa-stethoscope' }} mr-3 text-primary icon-service" style="font-size: 15px; width: 18px; text-align: center;"></i>
                                        {{ $p->title }}
                                    </span>
                                    <i class="fas fa-chevron-right text-muted arrow-icon transition-all" style="font-size: 11px;"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Detailed Content Area --}}
                <div class="col-lg-9">
                    <div class="card border-0 shadow-xs p-4 p-md-5" style="border-radius: 12px; border: 1px solid rgba(0,0,0,0.05); background: #fff;">
                        
                        {{-- Slider Area --}}
                        @if($pelayananImages->isNotEmpty())
                            <div class="mb-4">
                                <div class="slider-container" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
                                    <div class="slider slider-single">
                                        @foreach ($pelayananImages as $item)
                                            <div class="position-relative" style="max-height: 380px; overflow: hidden; background-color: #f8fafc;">
                                                <img src="{{ asset('/storage/' . $item->thumbnail) }}"
                                                     alt="{{ $pelayananPage->title }}" class="w-100 img-fluid"
                                                     loading="lazy" decoding="async"
                                                     style="height: 380px; object-fit: cover;">
                                                @if($item->caption)
                                                    <div class="position-absolute bottom-0 left-0 w-100 p-3 text-white" 
                                                         style="background: linear-gradient(0deg, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0) 100%);">
                                                        <p class="mb-0 font-weight-bold" style="font-size: 12.5px;">{{ $item->caption }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Thumbnails Nav --}}
                                @if($pelayananImages->count() > 1)
                                    <div class="slider slider-nav mt-3">
                                        @foreach ($pelayananImages as $item)
                                            <div class="px-1">
                                                <div class="thumbnail-nav-wrapper" style="border-radius: 8px; overflow: hidden; cursor: pointer; height: 60px; border: 2px solid transparent; transition: all 0.2s;">
                                                    <img src="{{ asset('/storage/' . $item->image) }}"
                                                         alt="{{ $pelayananPage->title }}" class="w-100 h-100 img-fluid"
                                                         loading="lazy" decoding="async" style="object-fit: cover;">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif

                        {{-- Text Body --}}
                        <div class="service-body-content text-dark" style="line-height: 1.85; font-size: 15px;">
                            {!! $pelayananPage->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
