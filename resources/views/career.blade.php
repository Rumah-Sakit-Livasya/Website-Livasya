@extends('layouts.main')

@section('container')
    <!-- Hero Section -->
    <section class="career-hero position-relative d-flex align-items-center justify-content-center"
        style="min-height: 50vh; background: var(--primary); padding-top: 160px; padding-bottom: 80px;">
        <div class="container text-center text-white z-index-1">
            <h1 class="display-4 fw-bolder mb-3" data-aos="fade-up">{{ $title }}</h1>
            <p class="lead fw-light mb-0" data-aos="fade-up" data-aos-delay="100">Bergabunglah bersama kami untuk masa depan
                kesehatan yang lebih baik.</p>

            <div class="mt-4" data-aos="fade-up" data-aos-delay="200">
                <span class="d-block mb-2 text-white-50 small">Sudah melamar sebelumnya?</span>
                <a href="{{ route('login.pelamar') }}"
                    class="btn btn-light text-white fw-bold px-4 py-2 rounded-3 shadow-lg">
                    <i class="fas fa-sign-in-alt me-2"></i> Login Pelamar
                </a>
            </div>
        </div>
    </section>

    <!-- Job Listings Section -->
    <section class="career-listings py-5 bg-white">
        <div class="container py-lg-5">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <h2 class="fw-bold text-dark">Lowongan Pekerjaan Tersedia</h2>
                    <p class="text-muted">Temukan posisi yang sesuai dengan keahlian dan passion Anda.</p>
                </div>
            </div>

            <div class="row g-4">
                @forelse ($careers as $career)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="card career-card h-100 border-0 shadow-sm">
                            <div class="card-body p-4 d-flex flex-column position-relative overflow-hidden">
                                <!-- Decorative Accent -->
                                <div class="accent-bar"></div>

                                <!-- Title -->
                                <h4 class="career-title mb-3">{{ $career->title }}</h4>

                                <!-- Image / Poster -->
                                @php
                                    $flyerImage = $career->image ? Storage::url($career->image) : null;
                                    if (!$flyerImage) {
                                        preg_match(
                                            '/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i',
                                            $career->deskripsi,
                                            $image,
                                        );
                                        $flyerImage = $image['src'] ?? null;
                                    }
                                @endphp

                                <div class="career-image mb-3 rounded overflow-hidden position-relative">
                                    @if ($flyerImage)
                                        <a href="javascript:void(0)" data-src="{{ $flyerImage }}"
                                            class="d-block cursor-pointer zoom-effect position-relative preview-trigger">
                                            <img src="{{ $flyerImage }}" alt="{{ $career->title }}"
                                                class="img-fluid w-100" style="object-fit: cover; min-height: 300px;">
                                            <div class="hover-overlay d-flex align-items-center justify-content-center"
                                                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.3); opacity: 0; transition: all 0.3s;">
                                                <i class="fas fa-search-plus text-white fa-3x"></i>
                                            </div>
                                        </a>
                                    @else
                                        <!-- Placeholder or Short Desc if no image -->
                                        <div class="p-3 bg-light text-center text-muted"
                                            style="min-height: 200px; display: flex; align-items: center; justify-content: center;">
                                            <div>
                                                <i class="fas fa-image fa-3x mb-3"></i>
                                                <p class="small mb-0">Lihat detail untuk informasi lengkap.</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Type Badge -->
                                <div class="mb-3">
                                    <span
                                        class="badge bg-{{ $career->tipe == 'medis' ? 'primary' : 'success' }} rounded-pill px-3 py-2">
                                        {{ ucfirst($career->tipe) }}
                                    </span>
                                </div>

                                <!-- Action -->
                                <div class="mt-auto">
                                    @auth
                                        <a href="{{ route('applicant.vacancies') }}" class="btn btn-primary w-100 btn-apply">
                                            Lamar Sekarang <i class="fas fa-arrow-right ms-2"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('login.pelamar') }}" class="btn btn-outline-primary w-100 btn-apply">
                                            Login to Apply <i class="fas fa-sign-in-alt ms-2"></i>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            Saat ini belum ada lowongan pekerjaan yang tersedia.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Image Preview Modal -->
        <div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content bg-transparent border-0 shadow-none">
                    <div class="modal-header border-0 p-0">
                        <button type="button" class="close text-white opacity-100" data-dismiss="modal" aria-label="Close"
                            style="position: absolute; right: -30px; top: -30px; font-size: 2rem; text-shadow: 0 0 5px black;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0 text-center">
                        <img src="" id="previewImage" class="img-fluid rounded shadow-lg"
                            style="max-height: 85vh; width: auto; max-width: 100%;">
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Hide the default layout breadcrumb to prevent white gap */
            body>nav[aria-label="breadcrumb"] {
                display: none !important;
            }

            .career-card {
                border-radius: 20px;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                background: #fff;
                position: relative;
                overflow: hidden;
            }

            .career-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08) !important;
            }

            .accent-bar {
                position: absolute;
                top: 25px;
                left: 0;
                width: 5px;
                height: 35px;
                background: var(--primary);
                border-radius: 0 4px 4px 0;
            }

            .career-title {
                font-weight: 800;
                color: #2c3e50;
                margin-left: 12px;
            }

            .btn-apply {
                border-radius: 12px;
                padding: 12px 20px;
                font-weight: 600;
                transition: all 0.3s ease;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                font-size: 0.85rem;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .btn-apply:hover {
                transform: scale(1.02);
                box-shadow: 0 5px 15px rgba(var(--primary-rgb), 0.3);
            }

            .btn-outline-primary {
                border-width: 2px;
            }

            .zoom-effect:hover .hover-overlay {
                opacity: 1 !important;
            }

            .text-primary {
                color: var(--primary) !important;
            }
        </style>

        <script nonce="{{ $nonce }}">
            document.addEventListener('DOMContentLoaded', function() {
                document.body.addEventListener('click', function(e) {
                    var target = e.target.closest('.preview-trigger');
                    if (target) {
                        e.preventDefault();
                        var src = target.getAttribute('data-src');
                        $('#previewImage').attr('src', src);
                        $('#imagePreviewModal').modal('show');
                    }
                });
            });
        </script>
    </section>
@endsection
