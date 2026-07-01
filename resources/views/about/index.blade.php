@extends('layouts.main')

@section('container')
    <style>
        .hero-tentang {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.65) 100%),
                        url("/img/rs.webp") center center / cover no-repeat;
            height: 240px;
            border-radius: 0 0 24px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .section-title {
            position: relative;
            font-size: 1.5rem;
            color: #1f2937;
            font-weight: 700;
            padding-left: 14px;
            border-left: 5px solid #2563eb;
            margin-bottom: 25px;
        }

        .vision-card {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
            height: 100%;
        }

        .vision-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.08);
            border-color: #dbeafe;
        }

        .dropcap {
            float: left;
            margin-right: 5px;
            font-size: 3em;
            vertical-align: text-top;
            color: #2563eb;
            line-height: 0.8;
            font-weight: bold;
        }
    </style>

    {{-- Unified Compact Hero Banner --}}
    <div class="container my-4">
        <div class="hero-tentang position-relative d-flex align-items-end" style="overflow: hidden;">
            <div class="p-4 w-100" data-aos="fade-up">
                <span class="badge bg-light text-primary font-weight-bold px-3 py-1-5 mb-2 text-uppercase" style="border-radius: 20px; font-size: 10px; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Tentang Livasya</span>
                <h1 class="text-white font-weight-bold mb-0 text-shadow" style="font-size: 2rem; text-shadow: 2px 2px 10px rgba(0,0,0,0.65);">
                    Tentang Kami
                </h1>
            </div>
        </div>
    </div>

    <section id="about" class="py-4 bg-light overflow-hidden">
        <div class="container">
            @include('about.timeline')
            
            <div class="mt-5">
                <h2 class="section-title mb-4">Visi, Misi, dan Motto RS Livasya</h2>
                <div class="row g-4 justify-content-center">
                    {{-- Visi --}}
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="card border-0 vision-card p-4 p-md-5 w-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-eye" style="font-size: 20px;"></i>
                                </div>
                                <h4 class="font-weight-bold text-dark mb-3" style="font-size: 17px;">Visi</h4>
                                <p class="text-muted mb-0" style="font-size: 14px; line-height: 1.7; text-align: justify;">
                                    Menjadi Rumah Sakit terpercaya dan diandalkan oleh masyarakat yang berorientasi pada kepuasan dan keselamatan pasien.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Misi --}}
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="card border-0 vision-card p-4 p-md-5 w-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-bullseye" style="font-size: 20px;"></i>
                                </div>
                                <h4 class="font-weight-bold text-dark mb-3" style="font-size: 17px;">Misi</h4>
                                <div class="text-muted mb-0" style="font-size: 13.5px; line-height: 1.6; text-align: justify;">
                                    <p class="mb-3">
                                        <strong class="text-dark">Sumber Daya Manusia:</strong><br>
                                        Menciptakan sumber daya manusia yang berkualitas, profesional, serta memiliki rasa empati yang tinggi terhadap pasien dan lingkungan sekitar.
                                    </p>
                                    <p class="mb-0">
                                        <strong class="text-dark">Sarana Prasarana:</strong><br>
                                        Mengembangkan sarana prasarana yang memadai guna menunjang pelayanan prima dan keselamatan pasien rumah sakit.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Motto --}}
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="card border-0 vision-card p-4 p-md-5 w-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-quote-left" style="font-size: 20px;"></i>
                                </div>
                                <h4 class="font-weight-bold text-dark mb-3" style="font-size: 17px;">Motto</h4>
                                <blockquote class="blockquote mb-0">
                                    <p class="h5 font-weight-bold text-dark" style="line-height: 1.5; font-size: 16px;">
                                        <span class="dropcap">"</span>Melayani Sepenuh Hati, Kepuasan Anda adalah Prioritas Kami.
                                    </p>
                                    <footer class="blockquote-footer mt-3" style="font-size: 12px; font-weight: 600;">
                                        Owner RS Livasya
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
