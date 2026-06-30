@extends('inc.layout')

@section('title')
    @if(auth()->user()->hasRole('super-admin'))
        Admin Dashboard
    @elseif(auth()->user()->hasRole('hrd'))
        HRD Dashboard
    @elseif(auth()->user()->hasRole('marketing'))
        Marketing Dashboard
    @else
        Dashboard
    @endif
@endsection

@section('content')
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon bx bxs-dashboard text-primary'></i>
            @if(auth()->user()->hasRole('super-admin'))
                Admin Dashboard <span class='fw-300'>Statistik & Kontrol Utama</span>
            @elseif(auth()->user()->hasRole('hrd'))
                HRD Dashboard <span class='fw-300'>Manajemen Pelamar & Karir</span>
            @elseif(auth()->user()->hasRole('marketing'))
                Marketing Dashboard <span class='fw-300'>Manajemen Konten & Berita</span>
            @else
                Dashboard <span class='fw-300'>Selamat Datang</span>
            @endif
        </h1>
        <div class="subheader-block">
            Hari ini: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- SUPER ADMIN / USER DASHBOARD               --}}
    {{-- ========================================== --}}
    @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('user'))
        <div class="row">
            <!-- Total Pelamar -->
            <div class="col-sm-6 col-xl-3">
                <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm transition-hover">
                    <div>
                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                            {{ $data['total_appliers'] ?? 0 }}
                            <small class="m-0 l-h-n">Total Pelamar Terdaftar</small>
                        </h3>
                    </div>
                    <i class="fal fa-users position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:5.5rem"></i>
                </div>
            </div>
            <!-- Total Lowongan -->
            <div class="col-sm-6 col-xl-3">
                <div class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm transition-hover">
                    <div>
                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                            {{ $data['total_careers'] ?? 0 }}
                            <small class="m-0 l-h-n">Total Lowongan Kerja</small>
                        </h3>
                    </div>
                    <i class="fal fa-briefcase position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:5.5rem"></i>
                </div>
            </div>
            <!-- Total Dokter -->
            <div class="col-sm-6 col-xl-3">
                <div class="p-3 bg-info-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm transition-hover">
                    <div>
                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                            {{ $data['total_doctors'] ?? 0 }}
                            <small class="m-0 l-h-n">Total Dokter Aktif</small>
                        </h3>
                    </div>
                    <i class="fal fa-user-md position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:5.5rem"></i>
                </div>
            </div>
            <!-- Total Berita -->
            <div class="col-sm-6 col-xl-3">
                <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g shadow-sm transition-hover">
                    <div>
                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                            {{ $data['total_posts'] ?? 0 }}
                            <small class="m-0 l-h-n">Total Berita & Artikel</small>
                        </h3>
                    </div>
                    <i class="fal fa-newspaper position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:5.5rem"></i>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12">
                <div id="panel-quick-actions" class="panel" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                    <div class="panel-hdr bg-faded">
                        <h2><i class="fal fa-cogs mr-2 text-primary"></i> Menu Akses Cepat Admin</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <p class="text-muted">Akses langsung ke pengaturan utama situs web Rumah Sakit Livasya.</p>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('identity.index') }}" class="quick-action-card qa-identity">
                                        <i class="fal fa-hospital fs-xxl mb-2"></i>
                                        <span class="font-weight-bold">Identitas RS</span>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('user.index') }}" class="quick-action-card qa-users">
                                        <i class="fal fa-users fs-xxl mb-2"></i>
                                        <span class="font-weight-bold">Manajemen User</span>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('jadwal.index') }}" class="quick-action-card qa-schedule">
                                        <i class="fal fa-calendar-alt fs-xxl mb-2"></i>
                                        <span class="font-weight-bold">Jadwal Praktek</span>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('pelayanan.index') }}" class="quick-action-card qa-services">
                                        <i class="fal fa-heartbeat fs-xxl mb-2"></i>
                                        <span class="font-weight-bold">Layanan Medis</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{-- ========================================== --}}
    {{-- HRD DASHBOARD                              --}}
    {{-- ========================================== --}}
    @elseif(auth()->user()->hasRole('hrd'))
        <div class="row">
            <!-- Total Pelamar -->
            <div class="col-sm-6 col-md-3">
                <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm transition-hover">
                    <div>
                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                            {{ $data['total_appliers'] ?? 0 }}
                            <small class="m-0 l-h-n">Total Pelamar</small>
                        </h3>
                    </div>
                    <i class="fal fa-users position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:4.5rem"></i>
                </div>
            </div>
            <!-- Diproses -->
            <div class="col-sm-6 col-md-3">
                <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g shadow-sm transition-hover">
                    <div>
                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                            {{ $data['processed_appliers'] ?? 0 }}
                            <small class="m-0 l-h-n">Sedang Diproses</small>
                        </h3>
                    </div>
                    <i class="fal fa-spinner fa-spin position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:4.5rem"></i>
                </div>
            </div>
            <!-- Diterima -->
            <div class="col-sm-6 col-md-3">
                <div class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm transition-hover">
                    <div>
                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                            {{ $data['accepted_appliers'] ?? 0 }}
                            <small class="m-0 l-h-n">Diterima</small>
                        </h3>
                    </div>
                    <i class="fal fa-check-circle position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:4.5rem"></i>
                </div>
            </div>
            <!-- Ditolak -->
            <div class="col-sm-6 col-md-3">
                <div class="p-3 bg-danger-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm transition-hover">
                    <div>
                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                            {{ $data['rejected_appliers'] ?? 0 }}
                            <small class="m-0 l-h-n">Ditolak</small>
                        </h3>
                    </div>
                    <i class="fal fa-times-circle position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:4.5rem"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div id="panel-latest-applicants" class="panel" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                    <div class="panel-hdr bg-faded">
                        <h2><i class="fal fa-user-plus mr-2 text-primary"></i> 5 Pelamar Terbaru</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            @if(empty($data['latest_appliers']) || $data['latest_appliers']->isEmpty())
                                <p class="text-muted py-3 text-center mb-0">Belum ada pelamar baru yang masuk.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered m-0 align-middle-table text-nowrap">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Nama Lengkap</th>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Posisi Minat</th>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Tanggal Daftar</th>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Status</th>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['latest_appliers'] as $applier)
                                                <tr>
                                                    <td class="align-middle">
                                                        <div class="font-weight-bold text-dark" style="font-size: 13px;">{{ $applier->first_name }} {{ $applier->last_name }}</div>
                                                        <small class="text-muted"><i class="fal fa-envelope mr-1"></i>{{ $applier->email }}</small>
                                                    </td>
                                                    <td class="align-middle">
                                                        @if($applier->career)
                                                            <span class="badge badge-primary" style="padding: 5px 10px; border-radius: 4px;">{{ $applier->career->title }}</span>
                                                        @else
                                                            <span class="text-muted">{{ $applier->position_interest ?? '-' }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        <span style="font-size: 13px; color: #4b5563;">
                                                            <i class="fal fa-calendar-alt text-muted mr-1"></i>{{ $applier->created_at ? $applier->created_at->translatedFormat('d M Y') : '-' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if($applier->status == 'processed')
                                                            <span class="badge-status badge-status-processed">Diproses</span>
                                                        @elseif($applier->status == 'accepted')
                                                            <span class="badge-status badge-status-accepted">Diterima</span>
                                                        @elseif($applier->status == 'rejected')
                                                            <span class="badge-status badge-status-rejected">Ditolak</span>
                                                        @else
                                                            <span class="badge-status badge-status-secondary">{{ $applier->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if($applier->career)
                                                            <a href="{{ route('hrd.detail', [$applier->career->id, $applier->id]) }}" class="btn-action-custom btn-action-detail">
                                                                <i class="fal fa-eye"></i> Detail
                                                            </a>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div id="panel-career-stats" class="panel" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                    <div class="panel-hdr bg-faded">
                        <h2><i class="fal fa-briefcase mr-2 text-success"></i> Informasi Karir</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content text-center py-4">
                            <i class="fal fa-building fs-xxl text-success mb-3"></i>
                            <h4>Lowongan Aktif Sekarang</h4>
                            <h1 class="display-3 font-weight-bold text-success">{{ $data['total_careers'] ?? 0 }}</h1>
                            <p class="text-muted mb-4">Jumlah lowongan pekerjaan RS Livasya yang statusnya sedang 'ON' atau aktif tayang.</p>
                            <a href="{{ route('career.index') }}" class="btn btn-success btn-block btn-lg" style="border-radius: 6px; font-weight: 600;">
                                <i class="fal fa-edit mr-2"></i> Kelola Lowongan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{-- ========================================== --}}
    {{-- MARKETING DASHBOARD                        --}}
    {{-- ========================================== --}}
    @elseif(auth()->user()->hasRole('marketing'))
        <div class="row">
            <!-- Total Berita -->
            <div class="col-sm-6 col-xl-4">
                <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm transition-hover">
                    <div>
                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                            {{ $data['total_posts'] ?? 0 }}
                            <small class="m-0 l-h-n">Total Berita & Artikel</small>
                        </h3>
                    </div>
                    <i class="fal fa-newspaper position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:4.5rem"></i>
                </div>
            </div>
            <!-- Total Kategori -->
            <div class="col-sm-6 col-xl-4">
                <div class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm transition-hover">
                    <div>
                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                            {{ $data['total_categories'] ?? 0 }}
                            <small class="m-0 l-h-n">Kategori Berita</small>
                        </h3>
                    </div>
                    <i class="fal fa-folder-open position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:4.5rem"></i>
                </div>
            </div>
            <!-- Total Dokter -->
            <div class="col-sm-6 col-xl-4">
                <div class="p-3 bg-info-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm transition-hover">
                    <div>
                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                            {{ $data['total_doctors'] ?? 0 }}
                            <small class="m-0 l-h-n">Dokter Aktif</small>
                        </h3>
                    </div>
                    <i class="fal fa-user-md position-absolute pos-right pos-bottom opacity-20 mb-n1 mr-n1" style="font-size:4.5rem"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div id="panel-latest-posts" class="panel" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                    <div class="panel-hdr bg-faded">
                        <h2><i class="fal fa-newspaper mr-2 text-primary"></i> 5 Berita Terbaru</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            @if(empty($data['latest_posts']) || $data['latest_posts']->isEmpty())
                                <p class="text-muted py-3 text-center mb-0">Belum ada berita yang diposting.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered m-0 align-middle-table text-nowrap">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Judul Berita</th>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Kategori</th>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Penulis</th>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Tanggal Rilis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['latest_posts'] as $post)
                                                <tr>
                                                    <td class="font-weight-bold text-dark align-middle" style="font-size: 13px;">{{ $post->title }}</td>
                                                    <td class="align-middle">
                                                        <span class="badge-status badge-status-success-soft">{{ $post->category->name ?? 'Tanpa Kategori' }}</span>
                                                    </td>
                                                    <td class="align-middle text-muted" style="font-size: 13px;">
                                                        <i class="fal fa-user mr-1"></i>{{ $post->user->name ?? '-' }}
                                                    </td>
                                                    <td class="align-middle text-muted" style="font-size: 12px;">
                                                        <i class="fal fa-clock mr-1"></i>{{ $post->created_at ? $post->created_at->translatedFormat('d M Y H:i') : '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div id="panel-marketing-shortcuts" class="panel" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                    <div class="panel-hdr bg-faded">
                        <h2><i class="fal fa-ellipsis-v-alt mr-2 text-info"></i> Ringkasan Content</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #fcfdfd;">
                                    <span><i class="fal fa-layer-group text-info mr-2"></i> Total Departement</span>
                                    <span class="badge badge-info badge-pill font-weight-bold" style="padding: 5px 10px;">{{ $data['total_departments'] ?? 0 }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #fcfdfd;">
                                    <span><i class="fal fa-star text-warning mr-2"></i> Fasilitas Unggulan</span>
                                    <span class="badge badge-warning badge-pill font-weight-bold text-dark" style="padding: 5px 10px;">{{ $data['total_facilities'] ?? 0 }}</span>
                                </li>
                            </ul>
                            <a href="{{ route('posts.index') }}" class="btn btn-primary btn-block btn-lg" style="border-radius: 6px; font-weight: 600;">
                                <i class="fal fa-plus-circle mr-2"></i> Tulis Berita Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</main>

<style nonce="{{ $nonce }}">
    .transition-hover {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .transition-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }

    /* Table custom nowrap & layout */
    .align-middle-table td, .align-middle-table th {
        vertical-align: middle !important;
        white-space: nowrap !important;
    }

    /* Custom Quick Action Cards */
    .quick-action-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.5rem 1rem;
        border-radius: 10px;
        border: 1px solid transparent;
        text-decoration: none !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        height: 100%;
    }
    .quick-action-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
    }
    
    .qa-identity {
        background-color: #eff6ff;
        border-color: #bfdbfe;
        color: #2563eb !important;
    }
    .qa-identity i { color: #2563eb; }
    .qa-identity:hover {
        background-color: #2563eb;
        color: #ffffff !important;
        border-color: #2563eb;
    }
    .qa-identity:hover i { color: #ffffff !important; }

    .qa-users {
        background-color: #ecfdf5;
        border-color: #a7f3d0;
        color: #10b981 !important;
    }
    .qa-users i { color: #10b981; }
    .qa-users:hover {
        background-color: #10b981;
        color: #ffffff !important;
        border-color: #10b981;
    }
    .qa-users:hover i { color: #ffffff !important; }

    .qa-schedule {
        background-color: #f0f9ff;
        border-color: #bae6fd;
        color: #0284c7 !important;
    }
    .qa-schedule i { color: #0284c7; }
    .qa-schedule:hover {
        background-color: #0284c7;
        color: #ffffff !important;
        border-color: #0284c7;
    }
    .qa-schedule:hover i { color: #ffffff !important; }

    .qa-services {
        background-color: #fffbeb;
        border-color: #fde68a;
        color: #d97706 !important;
    }
    .qa-services i { color: #d97706; }
    .qa-services:hover {
        background-color: #d97706;
        color: #ffffff !important;
        border-color: #d97706;
    }
    .qa-services:hover i { color: #ffffff !important; }

    /* Custom Action Buttons */
    .btn-action-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 30px;
        padding: 0 10px;
        font-size: 11px;
        font-weight: 600;
        border-radius: 6px;
        border: 1px solid transparent;
        transition: all 0.2s ease-in-out;
        gap: 6px;
        text-decoration: none !important;
    }
    .btn-action-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08), 0 2px 4px -1px rgba(0, 0, 0, 0.04);
    }
    .btn-action-custom:active {
        transform: translateY(0);
    }
    .btn-action-custom i {
        font-size: 12px;
        margin-right: 0 !important;
    }

    .btn-action-detail {
        background-color: #eff6ff;
        color: #2563eb !important;
        border-color: #bfdbfe;
    }
    .btn-action-detail:hover {
        background-color: #2563eb;
        color: #ffffff !important;
        border-color: #2563eb;
    }

    /* Custom Status Badges */
    .badge-status {
        display: inline-block;
        padding: 5px 12px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-radius: 30px;
        text-align: center;
        min-width: 90px;
    }
    .badge-status-processed {
        background-color: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
    }
    .badge-status-accepted {
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }
    .badge-status-rejected {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    .badge-status-secondary {
        background-color: #f3f4f6;
        color: #4b5563;
        border: 1px solid #e5e7eb;
    }
    .badge-status-success-soft {
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }
</style>
@endsection
