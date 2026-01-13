@php
    use App\Models\Career;
@endphp
@extends('layouts.main')

@section('container')
    <section class="gallery bg-white" style="padding-top: 15rem">
        <h1 class="heading my-5"><span>{{ $title }}</span> </h1>

        <div class="container">
            <div class="row g-4">
                @foreach (Career::where('status', 'on')->where('tipe', $tipe)->get() as $career)
                    <div class="col-md-12 col-lg-4">
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

                                <!-- Description (Hidden by default if image exists, or minimal) -->
                                <!-- <div class="career-description flex-grow-1 mb-4">
                                                            {!! $career->deskripsi !!}
                                                        </div> -->

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
                @endforeach
            </div>
        </div>

        <style>
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

            .career-description {
                font-size: 0.95rem;
                line-height: 1.6;
                color: #444;
            }

            /* Styling for HTML content within description */
            .career-description ul,
            .career-description ol {
                padding-left: 1.2rem;
                margin-bottom: 1rem;
            }

            .career-description li {
                margin-bottom: 0.5rem;
            }

            .career-description p {
                margin-bottom: 0.8rem;
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
        </style>
    </section>

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
@endsection
