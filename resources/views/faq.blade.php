@extends('layouts.main')

@section('container')
    <style>
        .hero-faq {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.65) 100%),
                        url("/img/rs.webp") center center / cover no-repeat;
            height: 240px;
            border-radius: 0 0 24px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .accordion-button {
            font-size: 15px;
            font-weight: 700;
            color: #1f2937 !important;
            background-color: #fff;
            padding: 18px 20px;
            border: 1px solid rgba(0,0,0,0.04);
            border-radius: 12px !important;
            box-shadow: 0 2px 5px rgba(0,0,0,0.01);
            text-align: left;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
        }

        .accordion-button:not(.collapsed) {
            background-color: #eff6ff !important;
            color: #2563eb !important;
            border-color: #dbeafe;
        }

        .accordion-item {
            border: none;
            margin-bottom: 12px;
            border-radius: 12px !important;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
        }

        .accordion-body {
            font-size: 14px;
            color: #4b5563;
            line-height: 1.6;
            background-color: #fff;
            padding: 20px;
            border-top: 1px solid #f3f4f6;
        }
    </style>

    {{-- Unified Compact Hero Banner --}}
    <div class="container my-4">
        <div class="hero-faq position-relative d-flex align-items-end" style="overflow: hidden;">
            <div class="p-4 w-100" data-aos="fade-up">
                <span class="badge bg-light text-primary font-weight-bold px-3 py-1-5 mb-2 text-uppercase" style="border-radius: 20px; font-size: 10px; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Tanya Jawab</span>
                <h1 class="text-white font-weight-bold mb-0 text-shadow" style="font-size: 2rem; text-shadow: 2px 2px 10px rgba(0,0,0,0.65);">
                    Pertanyaan Umum (FAQ)
                </h1>
            </div>
        </div>
    </div>

    <section id="about" class="py-4 bg-light overflow-hidden">
        @include('isifaq')
    </section>
@endsection
