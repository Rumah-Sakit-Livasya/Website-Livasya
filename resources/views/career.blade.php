@extends('layouts.main')

@section('container')
    <!-- Hero Section -->
    <section class="career-hero position-relative d-flex align-items-center justify-content-center"
        style="min-height: 50vh; background: var(--primary); padding-top: 160px; padding-bottom: 80px;">
        <div class="container text-center text-white z-index-1">
            <h1 class="display-4 fw-bolder mb-3" data-aos="fade-up">{{ $title }}</h1>
            <p class="lead fw-light mb-0" data-aos="fade-up" data-aos-delay="100">Bergabunglah bersama kami untuk masa depan
                kesehatan yang lebih baik.</p>
        </div>
    </section>

    <!-- Selection Section -->
    <section class="career-selection py-5 bg-white">
        <div class="container py-lg-5">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <h2 class="fw-bold text-dark">Pilih Jalur Karir Anda</h2>
                    <p class="text-muted">Temukan peran yang sesuai dengan keahlian dan passion Anda.</p>
                </div>
            </div>

            <div class="row g-5 justify-content-center">
                <!-- Medis -->
                <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="100">
                    <a href="/career/medis"
                        class="card career-path-card h-100 border-0 shadow-sm text-decoration-none overflow-hidden">
                        <div class="card-body p-0 d-flex flex-column">
                            <div class="img-wrapper position-relative bg-light">
                                <span
                                    class="position-absolute top-0 end-0 m-3 badge rounded-pill bg-danger shadow-sm px-3 py-2 z-index-2">
                                    {{ $medis }} Posisi
                                </span>
                                <img src="/img/career-medis.png" class="w-100"
                                    style="height: 280px; object-fit: cover; object-position: top center;">
                            </div>
                            <div class="p-4 text-center bg-white flex-grow-1">
                                <h3 class="fw-bolder text-primary mb-2">Medis</h3>
                                <p class="text-muted mb-0 small">Dokter, Perawat, Bidan, dan Tenaga Kesehatan Profesional.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Non-Medis -->
                <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="200">
                    <a href="/career/non-medis"
                        class="card career-path-card h-100 border-0 shadow-sm text-decoration-none overflow-hidden">
                        <div class="card-body p-0 d-flex flex-column">
                            <div class="img-wrapper position-relative bg-light">
                                <span
                                    class="position-absolute top-0 end-0 m-3 badge rounded-pill bg-danger shadow-sm px-3 py-2 z-index-2">
                                    {{ $nonMedis }} Posisi
                                </span>
                                <img src="/img/career-nonmedis.png" class="w-100"
                                    style="height: 280px; object-fit: cover; object-position: top center;">
                            </div>
                            <div class="p-4 text-center bg-white flex-grow-1">
                                <h3 class="fw-bolder text-primary mb-2">Non Medis</h3>
                                <p class="text-muted mb-0 small">Administrasi, Manajemen, IT, dan Operasional Pendukung.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <style>
            /* Hide the default layout breadcrumb to prevent white gap */
            body>nav[aria-label="breadcrumb"] {
                display: none !important;
            }

            .career-path-card {
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                border-radius: 20px;
                background: #fff;
            }

            .career-path-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12) !important;
            }

            /* Zoom effect on image */
            .career-path-card .img-wrapper {
                overflow: hidden;
            }

            .career-path-card img {
                transition: transform 0.6s ease;
            }

            .career-path-card:hover img {
                transform: scale(1.05);
            }

            .z-index-2 {
                z-index: 2;
            }

            .text-primary {
                color: var(--primary) !important;
            }
        </style>
    </section>
@endsection
