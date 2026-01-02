@extends('layouts.applicant_smart')

@section('title', 'Lowongan Kerja')

@section('content')
    <main id="js-page-content" role="main" class="page-content">
        @include('inc.breadcrumb', ['bcrumb' => 'bc_level_satu', 'bc_1' => 'Lowongan Kerja'])

        <div class="row">
            <div class="col-xl-12">
                <div class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Filter <span class="fw-300"><i>Loker</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <select class="form-control select2" id="filter-faskes">
                                        <option value="">SEMUA FASKES</option>
                                        {{-- Add dynamic faskes options here if available --}}
                                        <option value="RS Livasya">RS Livasya</option>
                                    </select>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <select class="form-control select2" id="filter-bagian">
                                        <option value="">SEMUA BAGIAN</option>
                                        @foreach ($careers->unique('title') as $career)
                                            <option value="{{ $career->title }}">{{ $career->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <button class="btn btn-primary btn-block waves-effect waves-themed"
                                        id="btn-filter">Filter Loker</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button>
            <div class="d-flex align-items-center">
                <div class="alert-icon">
                    <i class="fal fa-exclamation-triangle"></i>
                </div>
                <div class="flex-1">
                    <span class="h5">Kualifikasi Penerimaan Karyawan
                        {{ \App\Models\Identity::first()->name ?? 'RS Livasya' }} Dapat dilihat <a href="#"
                            class="fw-bold">disini</a></span>
                </div>
            </div>
        </div>

        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button>
            <div class="d-flex align-items-center">
                <div class="alert-icon">
                    <i class="fal fa-info-circle"></i>
                </div>
                <div class="flex-1">
                    <span class="h5">Lowongan yang tampil hanya yang belum expired</span>
                </div>
            </div>
        </div>

        <div class="row" id="loker-container">
            @forelse($careers as $career)
                <div class="col-md-6 col-lg-4 loker-item"
                    data-faskes="{{ \App\Models\Identity::first()->name ?? 'RS Livasya' }}"
                    data-bagian="{{ $career->title }}">
                    <div class="card border mb-4 mb-xl-0 shadow-sm hover-shadow-lg transition-all"
                        style="min-height: 400px;">
                        <div class="card-header bg-white p-3 border-bottom-0">
                            <h5 class="card-title text-muted mb-0" style="font-size: 0.9rem;">
                                {{ \App\Models\Identity::first()->name ?? 'RS Livasya' }}
                            </h5>
                        </div>
                        <div class="card-body p-4 text-center d-flex flex-column">
                            <h3 class="fw-700 text-uppercase mb-4" style="letter-spacing: 1px;">
                                {{ $career->title }}
                            </h3>

                            <div class="text-left w-100 flex-grow-1">
                                <h6 class="text-muted mb-2">Persyaratan :</h6>
                                <style>
                                    .requirements-list {
                                        list-style: none;
                                        padding-left: 0;
                                        font-size: 0.9rem;
                                    }

                                    .requirements-list li {
                                        margin-bottom: 0.5rem;
                                        position: relative;
                                        padding-left: 1.5rem;
                                    }

                                    .requirements-list li::before {
                                        content: "\f00c";
                                        font-family: "Font Awesome 5 Pro";
                                        position: absolute;
                                        left: 0;
                                        color: #1dc9b7;
                                        font-weight: 900;
                                    }
                                </style>
                                <ul class="requirements-list">
                                    {{-- Assuming 'description' contains plain text or HTML requirements. --}}
                                    {{-- Creating a visually pleasing list from placeholders or scraped content --}}
                                    {{-- Since I don't see exact breakdown fields, I'll mock the structure or parse if possible --}}
                                    {{-- For now, using standard fields --}}

                                    <li>Maksimal Umur: {{ $career->max_age ?? '-' }} Tahun</li>
                                    <li>Minimal IPK: {{ $career->min_gpa ?? '-' }}</li>
                                    <li>Pendidikan: {{ $career->min_education ?? '-' }}</li>
                                    <li>Jurusan: {{ $career->major ?? 'Semua Jurusan' }}</li>
                                    {{-- <li>Sertifikasi: {{ $career->certification ?? '-' }}</li> --}}

                                    @php
                                        // Attempt to parse description for list items if it's a simple text blob
                                        // Or just show truncated description
                                        $desc = strip_tags($career->description);
                                    @endphp
                                    {{-- <li>{{ Str::limit($desc, 100) }}</li> --}}
                                </ul>
                            </div>

                            <div class="mt-4 w-100">
                                @if (Auth::user()->applier && Auth::user()->applier->career_id == $career->id)
                                    <button class="btn btn-secondary btn-block waves-effect waves-themed" disabled>
                                        <i class="fas fa-check mr-1"></i> Sudah Dilamar
                                    </button>
                                @else
                                    <form action="{{ route('applicant.apply') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="career_id" value="{{ $career->id }}">
                                        {{-- Assuming education and expected salary are pre-filled or handled in a modal application flow. --}}
                                        {{-- For direct apply, we need these. --}}
                                        {{-- Let's make it a button that opens a confirmation modal or link to detail --}}
                                        <button type="submit" class="btn btn-primary btn-block waves-effect waves-themed"
                                            onclick="return confirm('Apakah Anda yakin ingin melamar posisi {{ $career->title }}?')">
                                            Apply Sekarang
                                        </button>
                                        {{-- Hack: the controller requires education_id and expected_salary.
                                            We might need to pass dummy values or change controller to use profile data.
                                            For now, add hidden inputs using user's existing data if possible, or updated requirement.
                                        --}}
                                        <input type="hidden" name="education_id"
                                            value="{{ Auth::user()->applier->educations->first()->id ?? 0 }}">
                                        <input type="hidden" name="expected_salary"
                                            value="{{ Auth::user()->applier->compensation_salary ?? 0 }}">
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">Belum ada lowongan kerja tersedia saat ini.</div>
                </div>
            @endforelse
        </div>
    </main>
@endsection

@section('scripts')
    <script>
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
