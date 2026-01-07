@extends('layouts.applicant_smart')

@section('title', 'Lowongan Kerja')

@section('content')
    <main id="js-page-content" role="main" class="page-content">
        @include('inc.breadcrumb', ['bcrumb' => 'bc_level_satu', 'bc_1' => 'Lowongan Kerja'])

        <div class="subheader mb-5">
            <h1 class="subheader-title text-center mx-auto">
                <i class='subheader-icon fal fa-briefcase text-primary'></i> Lowongan Kerja <span
                    class='fw-300'>Tersedia</span>
                <small>Temukan karir impian Anda dan bergabunglah bersama kami.</small>
            </h1>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-5 mb-3 mb-md-0">
                                <label class="form-label text-muted small text-uppercase fw-bold">Fasilitas
                                    Kesehatan</label>
                                <select class="form-control custom-select shadow-none bg-light border-0" id="filter-faskes">
                                    <option value="">SEMUA FASKES</option>
                                    <option value="RS Livasya">RS Livasya</option>
                                </select>
                            </div>
                            <div class="col-md-5 mb-3 mb-md-0">
                                <label class="form-label text-muted small text-uppercase fw-bold">Posisi / Bagian</label>
                                <select class="form-control custom-select shadow-none bg-light border-0" id="filter-bagian">
                                    <option value="">SEMUA BAGIAN</option>
                                    @foreach ($careers->unique('title') as $career)
                                        <option value="{{ $career->title }}">{{ $career->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button class="btn btn-primary btn-block shadow-sm font-weight-bold" id="btn-filter">
                                    <i class="fas fa-search mr-2"></i> Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="loker-container">
            @forelse($careers as $career)
                <div class="col-md-6 col-lg-4 col-xl-3 loker-item mb-4"
                    data-faskes="{{ \App\Models\Identity::first()->name ?? 'RS Livasya' }}"
                    data-bagian="{{ $career->title }}">
                    <div class="card border-0 shadow-sm h-100 position-relative transition-all hover-lift overflow-hidden">
                        <!-- Accent Bar -->
                        <div class="card-header bg-primary py-2 border-0"></div>

                        <div class="card-body p-4 d-flex flex-column text-center">
                            <div class="mb-3">
                                <span class="badge badge-pill badge-light text-primary font-weight-bold p-2 px-3 shadow-sm">
                                    {{ \App\Models\Identity::first()->name ?? 'RS Livasya' }}
                                </span>
                            </div>

                            <h4 class="card-title font-weight-bold text-dark mb-3">
                                {{ $career->title }}
                            </h4>

                            @php
                                // Prioritize uploaded image
                                $flyerImage = $career->image ? Storage::url($career->image) : null;

                                // Fallback: Extract first image from description if no official image
                                if (!$flyerImage) {
                                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $career->deskripsi, $image);
                                    $flyerImage = $image['src'] ?? null;
                                }
                            @endphp

                            <div class="text-left w-100 flex-grow-1 mt-3">
                                @if ($flyerImage)
                                    <div class="rounded-lg overflow-hidden shadow-sm mb-3 position-relative zoom-effect">
                                        <a href="javascript:void(0)" onclick="showPreview('{{ $flyerImage }}')"
                                            class="d-block">
                                            <img src="{{ $flyerImage }}" alt="{{ $career->title }}"
                                                class="img-fluid w-100" style="object-fit: cover;">
                                            <div class="hover-overlay d-flex align-items-center justify-content-center"
                                                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.3); opacity: 0; transition: all 0.3s;">
                                                <i class="fas fa-search-plus text-white fa-2x"></i>
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    {{-- Fallback or empty if no image --}}
                                    <div class="text-center text-muted p-4 bg-light rounded">
                                        <i class="fas fa-image fa-2x mb-2"></i>
                                        <p class="small mb-0">Lihat detail untuk informasi lengkap.</p>
                                    </div>
                                @endif

                                {{-- Commented out text requirements as requested --}}
                                {{-- <h6 class="text-muted text-uppercase font-weight-bold small mb-3 border-bottom pb-2">
                                    Kualifikasi
                                </h6>
                                <style>
                                    .custom-list {
                                        list-style: none;
                                        padding-left: 0;
                                        font-size: 0.85rem;
                                    }

                                    .custom-list li {
                                        margin-bottom: 0.5rem;
                                        position: relative;
                                        padding-left: 1.5rem;
                                        color: #555;
                                    }

                                    .custom-list li::before {
                                        content: "\f00c";
                                        font-family: "Font Awesome 5 Pro";
                                        position: absolute;
                                        left: 0;
                                        color: #1dc9b7;
                                        font-weight: 900;
                                        font-size: 0.8rem;
                                        top: 2px;
                                    }
                                </style>
                                <ul class="custom-list">
                                    <li>Usia Maks: {{ $career->max_age ?? '-' }} Tahun</li>
                                    <li>Pend. Min: {{ $career->min_education ?? '-' }}</li>
                                    <li>Jurusan: {{ $career->major ?? 'Semua Jurusan' }}</li>
                                </ul> --}}
                            </div>

                            <div class="mt-4">
                                @if (Auth::user()->applier && Auth::user()->applier->career_id == $career->id)
                                    <button class="btn btn-secondary btn-block shadow-none" disabled>
                                        <i class="fas fa-check-circle mr-1"></i> Sudah Dilamar
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary btn-block shadow-md btn-apply"
                                        onclick="setApplyData('{{ $career->id }}', '{{ $career->title }}')"
                                        data-toggle="modal" data-target="#modal-apply">
                                        Lamar Sekarang <i class="fas fa-arrow-right ml-1"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center shadow-sm border-0 rounded-lg p-5">
                        <i class="fal fa-info-circle fa-3x mb-3 text-info"></i>
                        <h4>Belum ada lowongan kerja tersedia saat ini.</h4>
                        <p class="text-muted">Silakan cek kembali secara berkala.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Modal Apply -->
    <div class="modal fade" id="modal-apply" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-paper-plane mr-2"></i> Kirim Lamaran</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('applicant.apply') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="alert alert-warning border-left-4 border-warning shadow-sm mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x mr-3 text-warning"></i>
                                <div>
                                    <strong>Penting!</strong><br>
                                    Pastikan data diri dan dokumen Anda sudah lengkap dan terbaru sebelum mengirim lamaran.
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label font-weight-bold text-muted text-uppercase small">Posisi yang
                                Dilamar</label>
                            <input type="text"
                                class="form-control form-control-lg bg-light border-0 font-weight-bold text-dark"
                                id="apply-position" readonly>
                            <input type="hidden" name="career_id" id="apply-career-id">
                            <input type="hidden" name="education_id"
                                value="{{ Auth::user()->applier->educations->first()->id ?? 0 }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label font-weight-bold text-muted text-uppercase small text-danger">Gaji
                                yang Diharapkan (Rp)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 bg-light font-weight-bold">Rp</span>
                                </div>
                                <input type="number" class="form-control form-control-lg border-0 bg-light"
                                    name="expected_salary" placeholder="Contoh: 5000000" min="0" required
                                    value="{{ Auth::user()->applier->compensation_salary ?? '' }}">
                            </div>
                            <small class="text-muted mt-2 d-block">Masukkan nominal angka saja tanpa titik/koma.</small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top-0 px-4 py-3">
                        <button type="button" class="btn btn-light font-weight-bold" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary font-weight-bold px-4">
                            <i class="fas fa-paper-plane mr-1"></i> Kirim Lamaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .border-left-4 {
            border-left: 4px solid;
        }

        .zoom-effect:hover .hover-overlay {
            opacity: 1 !important;
        }
    </style>

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
@endsection

@section('scripts')
    <script>
        function setApplyData(id, title) {
            document.getElementById('apply-career-id').value = id;
            document.getElementById('apply-position').value = title;
        }

        function showPreview(src) {
            $('#previewImage').attr('src', src);
            $('#imagePreviewModal').modal('show');
        }

        $(document).ready(function() {
            // Filter Logic
            $('#btn-filter').click(function() {
                var faskes = $('#filter-faskes').val().toLowerCase();
                var bagian = $('#filter-bagian').val().toLowerCase();

                $('.loker-item').each(function() {
                    var itemFaskes = $(this).data('faskes').toString().toLowerCase();
                    var itemBagian = $(this).data('bagian').toString().toLowerCase();

                    var show = true;
                    if (faskes && itemFaskes.indexOf(faskes) === -1) show = false;
                    if (bagian && itemBagian.indexOf(bagian) === -1) show = false;

                    if (show) $(this).show();
                    else $(this).hide();
                });
            });


        });
    </script>
@endsection
