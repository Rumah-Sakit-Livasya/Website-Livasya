@extends('hrd.layout')

@section('breadcrumb')
    <div class="hrd-breadcrumb">
        <i class="fal fa-home"></i>
        <a href="{{ route('hrd.index') }}">Dashboard HRD</a>
    </div>
@endsection

@section('content')
<style nonce="{{ $nonce }}">
    .stat-card {
        background: #fff;
        border-radius: 14px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        box-shadow: 0 1px 6px rgba(0,0,0,.07);
        border: 1px solid #e5e7eb;
        transition: box-shadow .2s, transform .2s;
    }
    .stat-card:hover { box-shadow: 0 6px 20px rgba(26,86,219,.12); transform: translateY(-2px); }
    .stat-icon {
        width: 56px; height: 56px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0;
    }
    .stat-icon.blue   { background: #eff6ff; color: #1a56db; }
    .stat-icon.green  { background: #f0fdf4; color: #16a34a; }
    .stat-icon.yellow { background: #fffbeb; color: #d97706; }
    .stat-icon.red    { background: #fff1f2; color: #e11d48; }

    .career-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,.06);
        transition: box-shadow .25s, transform .25s;
    }
    .career-card:hover { box-shadow: 0 8px 28px rgba(26,86,219,.15); transform: translateY(-3px); }
    .career-card-header {
        background: linear-gradient(135deg, #1e3a5f, #1a56db);
        color: #fff;
        padding: 1.1rem 1.25rem .9rem;
    }
    .career-card-header h6 { font-size: .95rem; font-weight: 700; margin: 0; }
    .career-card-header small { opacity: .75; font-size: .75rem; }
    .career-card-body { padding: 1.15rem 1.25rem; }
    .career-badge {
        display: inline-flex; align-items: center; gap: .4rem;
        background: #eff6ff; color: #1a56db;
        border-radius: 50px; padding: .25rem .75rem; font-size: .78rem; font-weight: 600;
    }
    .btn-hrd-primary {
        background: linear-gradient(135deg, #1a56db, #1e40af);
        color: #fff; border: none; border-radius: 8px;
        padding: .5rem 1.1rem; font-size: .85rem; font-weight: 600;
        transition: opacity .2s, transform .15s;
        text-decoration: none; display: inline-flex; align-items: center; gap: .4rem;
    }
    .btn-hrd-primary:hover { color: #fff; opacity: .9; transform: translateY(-1px); }
    .btn-hrd-outline {
        background: transparent; border: 1.5px solid #d1d5db;
        color: #374151; border-radius: 8px;
        padding: .45rem 1rem; font-size: .82rem; font-weight: 500;
        transition: border-color .2s, background .2s; text-decoration: none;
        display: inline-flex; align-items: center; gap: .4rem;
    }
    .btn-hrd-outline:hover { border-color: #1a56db; color: #1a56db; background: #eff6ff; }

    .page-heading { font-size: 1.6rem; font-weight: 800; color: #111827; margin-bottom: .25rem; }
    .page-sub { color: #6b7280; font-size: .9rem; margin-bottom: 1.75rem; }
</style>

<h1 class="page-heading"><i class="fal fa-users mr-2 text-primary"></i>Dashboard HRD</h1>
<p class="page-sub">Pantau rekrutmen dan kelola lamaran pelamar RS Livasya.</p>

{{-- Summary Stats --}}
@php
    use App\Models\Applier;
    $totalPelamar    = Applier::count();
    $totalProcessed  = Applier::where('status','processed')->count();
    $totalAccepted   = Applier::where('status','accepted')->count();
    $totalRejected   = Applier::where('status','rejected')->count();
@endphp

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fal fa-users"></i></div>
            <div>
                <div style="font-size:1.6rem;font-weight:800;line-height:1.1">{{ $totalPelamar }}</div>
                <div style="font-size:.8rem;color:#6b7280;margin-top:.1rem">Total Pelamar</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon yellow"><i class="fal fa-clock"></i></div>
            <div>
                <div style="font-size:1.6rem;font-weight:800;line-height:1.1">{{ $totalProcessed }}</div>
                <div style="font-size:.8rem;color:#6b7280;margin-top:.1rem">Diproses</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon green"><i class="fal fa-check-circle"></i></div>
            <div>
                <div style="font-size:1.6rem;font-weight:800;line-height:1.1">{{ $totalAccepted }}</div>
                <div style="font-size:.8rem;color:#6b7280;margin-top:.1rem">Diterima</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon red"><i class="fal fa-times-circle"></i></div>
            <div>
                <div style="font-size:1.6rem;font-weight:800;line-height:1.1">{{ $totalRejected }}</div>
                <div style="font-size:.8rem;color:#6b7280;margin-top:.1rem">Ditolak</div>
            </div>
        </div>
    </div>
</div>

{{-- Career List --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 style="font-weight:700;font-size:1.05rem;margin:0">
        <i class="fal fa-briefcase mr-2"></i>Daftar Lowongan
    </h5>
    <span class="text-muted" style="font-size:.82rem">{{ $careers->count() }} lowongan aktif</span>
</div>

@if($careers->isEmpty())
    <div class="text-center py-5">
        <i class="fal fa-folder-open" style="font-size:3rem;color:#d1d5db;"></i>
        <p class="text-muted mt-3">Belum ada lowongan.</p>
    </div>
@else
    <div class="row g-3">
        @foreach($careers as $career)
        <div class="col-md-6 col-lg-4">
            <div class="career-card">
                <div class="career-card-header">
                    <h6>{{ $career->title }}</h6>
                    <small>{{ $career->type ?? 'Umum' }}</small>
                </div>
                <div class="career-card-body">
                    <div class="mb-3">
                        <span class="career-badge">
                            <i class="fal fa-users"></i>
                            {{ $career->applier_count }} Pelamar
                        </span>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('hrd.appliers', $career->id) }}" class="btn-hrd-primary">
                            <i class="fal fa-eye"></i> Lihat Pelamar
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
