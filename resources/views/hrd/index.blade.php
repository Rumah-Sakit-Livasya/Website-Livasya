@extends('inc.layout')

@section('title', 'Dashboard HRD')

@section('content')
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon bx bxs-dashboard text-primary'></i> Dashboard HRD
            <small>
                Pantau rekrutmen dan kelola lamaran pelamar RS Livasya.
            </small>
        </h1>
    </div>

    {{-- Summary Stats --}}
    @php
        use App\Models\Applier;
        $totalPelamar    = Applier::count();
        $totalProcessed  = Applier::where('status','processed')->count();
        $totalAccepted   = Applier::where('status','accepted')->count();
        $totalRejected   = Applier::where('status','rejected')->count();
    @endphp

    <div class="row">
        <!-- Total Pelamar -->
        <div class="col-sm-6 col-md-3">
            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm">
                <div>
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{ $totalPelamar }}
                        <small class="m-0 l-h-n">Total Pelamar</small>
                    </h3>
                </div>
                <i class="fal fa-users position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:4.5rem"></i>
            </div>
        </div>
        <!-- Diproses -->
        <div class="col-sm-6 col-md-3">
            <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g shadow-sm">
                <div>
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{ $totalProcessed }}
                        <small class="m-0 l-h-n">Sedang Diproses</small>
                    </h3>
                </div>
                <i class="fal fa-clock position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:4.5rem"></i>
            </div>
        </div>
        <!-- Diterima -->
        <div class="col-sm-6 col-md-3">
            <div class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm">
                <div>
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{ $totalAccepted }}
                        <small class="m-0 l-h-n">Diterima</small>
                    </h3>
                </div>
                <i class="fal fa-check-circle position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:4.5rem"></i>
            </div>
        </div>
        <!-- Ditolak -->
        <div class="col-sm-6 col-md-3">
            <div class="p-3 bg-danger-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm">
                <div>
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{ $totalRejected }}
                        <small class="m-0 l-h-n">Ditolak</small>
                    </h3>
                </div>
                <i class="fal fa-times-circle position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:4.5rem"></i>
            </div>
        </div>
    </div>

    {{-- Career List --}}
    <div id="panel-careers" class="panel">
        <div class="panel-hdr bg-faded">
            <h2>
                <i class="fal fa-briefcase mr-2 text-primary"></i> Daftar Lowongan Kerja Aktif
            </h2>
            <div class="panel-toolbar">
                <span class="badge badge-primary px-3 py-2 font-weight-bold" style="border-radius: 4px;">
                    {{ $careers->count() }} Lowongan Aktif
                </span>
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                @if($careers->isEmpty())
                    <div class="text-center py-5">
                        <i class="fal fa-folder-open text-muted" style="font-size:3rem;"></i>
                        <p class="text-muted mt-3 mb-0">Belum ada lowongan pekerjaan aktif saat ini.</p>
                    </div>
                @else
                    <div class="row">
                        @foreach($careers as $career)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card shadow-xs border-light-blue h-100 transition-hover">
                                <div class="card-header bg-gradient-navy text-white py-3">
                                    <h5 class="card-title mb-1 font-weight-bold" style="font-size: 0.95rem; line-height: 1.3;">
                                        {{ $career->title }}
                                    </h5>
                                    <small class="text-white-50 font-weight-bold">{{ $career->tipe == 'medis' ? 'Medis' : 'Non-Medis' }}</small>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-between p-3">
                                    <div class="mb-3">
                                        <span class="badge badge-light px-2 py-1 border text-primary" style="font-size: 0.8rem; border-radius: 4px;">
                                            <i class="fal fa-users mr-1"></i>
                                            <strong>{{ $career->applier_count }}</strong> Pelamar
                                        </span>
                                    </div>
                                    <div>
                                        <a href="{{ route('hrd.appliers', $career->id) }}" class="btn btn-primary btn-block font-weight-bold btn-sm">
                                            <i class="fal fa-eye mr-1"></i> Lihat Pelamar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

<style nonce="{{ $nonce }}">
    .bg-gradient-navy {
        background: linear-gradient(135deg, #1e3a5f 0%, #1a56db 100%);
    }
    .border-light-blue {
        border: 1px solid #e5e7eb;
    }
    .transition-hover {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .transition-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(26,86,219,0.15) !important;
    }
</style>
@endsection
