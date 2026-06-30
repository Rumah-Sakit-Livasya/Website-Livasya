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
                <div id="panel-quick-actions" class="panel">
                    <div class="panel-hdr bg-faded">
                        <h2><i class="fal fa-cogs mr-2 text-primary"></i> Menu Akses Cepat Admin</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <p class="text-muted">Akses langsung ke pengaturan utama situs web Rumah Sakit Livasya.</p>
                            <div class="row g-3">
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('identity.index') }}" class="btn btn-outline-primary btn-block p-3 d-flex flex-column align-items-center justify-content-center border-2 shadow-sm rounded transition-all">
                                        <i class="fal fa-hospital fs-xxl mb-2 text-primary"></i>
                                        <span class="font-weight-bold">Identitas RS</span>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-success btn-block p-3 d-flex flex-column align-items-center justify-content-center border-2 shadow-sm rounded transition-all">
                                        <i class="fal fa-user-shield fs-xxl mb-2 text-success"></i>
                                        <span class="font-weight-bold">Manajemen User</span>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('jadwal.index') }}" class="btn btn-outline-info btn-block p-3 d-flex flex-column align-items-center justify-content-center border-2 shadow-sm rounded transition-all">
                                        <i class="fal fa-calendar-alt fs-xxl mb-2 text-info"></i>
                                        <span class="font-weight-bold">Jadwal Praktek</span>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('pelayanan.index') }}" class="btn btn-outline-warning btn-block p-3 d-flex flex-column align-items-center justify-content-center border-2 shadow-sm rounded transition-all">
                                        <i class="fal fa-heartbeat fs-xxl mb-2 text-warning"></i>
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
                <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm">
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
                <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g shadow-sm">
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
                <div class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm">
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
                <div class="p-3 bg-danger-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm">
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
                <div id="panel-latest-applicants" class="panel">
                    <div class="panel-hdr bg-faded">
                        <h2><i class="fal fa-user-plus mr-2 text-primary"></i> 5 Pelamar Terbaru</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            @if(empty($data['latest_appliers']) || $data['latest_appliers']->isEmpty())
                                <p class="text-muted py-3 text-center mb-0">Belum ada pelamar baru yang masuk.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered m-0">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <th>Posisi Minat</th>
                                                <th>Tanggal Daftar</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['latest_appliers'] as $applier)
                                                <tr>
                                                    <td>
                                                        <div class="font-weight-bold">{{ $applier->first_name }} {{ $applier->last_name }}</div>
                                                        <small class="text-muted">{{ $applier->email }}</small>
                                                    </td>
                                                    <td>
                                                        @if($applier->career)
                                                            <span class="badge badge-primary">{{ $applier->career->title }}</span>
                                                        @else
                                                            <span class="text-muted">{{ $applier->position_interest ?? '-' }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $applier->created_at ? $applier->created_at->translatedFormat('d M Y') : '-' }}</td>
                                                    <td class="text-center">
                                                        @if($applier->status == 'processed')
                                                            <span class="badge badge-warning">Diproses</span>
                                                        @elseif($applier->status == 'accepted')
                                                            <span class="badge badge-success">Diterima</span>
                                                        @elseif($applier->status == 'rejected')
                                                            <span class="badge badge-danger">Ditolak</span>
                                                        @else
                                                            <span class="badge badge-secondary">{{ $applier->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($applier->career)
                                                            <a href="{{ route('hrd.detail', [$applier->career->id, $applier->id]) }}" class="btn btn-xs btn-outline-info">
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
                <div id="panel-career-stats" class="panel">
                    <div class="panel-hdr bg-faded">
                        <h2><i class="fal fa-briefcase mr-2 text-success"></i> Informasi Karir</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content text-center py-4">
                            <i class="fal fa-building fs-xxl text-success mb-3"></i>
                            <h4>Lowongan Aktif Sekarang</h4>
                            <h1 class="display-3 font-weight-bold text-success">{{ $data['total_careers'] ?? 0 }}</h1>
                            <p class="text-muted mb-4">Jumlah lowongan pekerjaan RS Livasya yang statusnya sedang 'ON' atau aktif tayang.</p>
                            <a href="{{ route('career.index') }}" class="btn btn-success btn-block btn-lg">
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
                <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm">
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
                <div class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm">
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
                <div class="p-3 bg-info-300 rounded overflow-hidden position-relative text-white mb-g shadow-sm">
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
                <div id="panel-latest-posts" class="panel">
                    <div class="panel-hdr bg-faded">
                        <h2><i class="fal fa-newspaper mr-2 text-primary"></i> 5 Berita Terbaru</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            @if(empty($data['latest_posts']) || $data['latest_posts']->isEmpty())
                                <p class="text-muted py-3 text-center mb-0">Belum ada berita yang diposting.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered m-0">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th>Judul Berita</th>
                                                <th>Kategori</th>
                                                <th>Penulis</th>
                                                <th>Tanggal Rilis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['latest_posts'] as $post)
                                                <tr>
                                                    <td class="font-weight-bold text-dark">{{ $post->title }}</td>
                                                    <td>
                                                        <span class="badge badge-success">{{ $post->category->name ?? 'Tanpa Kategori' }}</span>
                                                    </td>
                                                    <td>{{ $post->user->name ?? '-' }}</td>
                                                    <td>{{ $post->created_at ? $post->created_at->translatedFormat('d M Y H:i') : '-' }}</td>
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
                <div id="panel-marketing-shortcuts" class="panel">
                    <div class="panel-hdr bg-faded">
                        <h2><i class="fal fa-ellipsis-v-alt mr-2 text-info"></i> Ringkasan Content</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fal fa-layer-group text-info mr-2"></i> Total Departement</span>
                                    <span class="badge badge-info badge-pill font-weight-bold">{{ $data['total_departments'] ?? 0 }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fal fa-star text-warning mr-2"></i> Fasilitas Unggulan</span>
                                    <span class="badge badge-warning badge-pill font-weight-bold text-dark">{{ $data['total_facilities'] ?? 0 }}</span>
                                </li>
                            </ul>
                            <a href="{{ route('posts.index') }}" class="btn btn-primary btn-block btn-lg">
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
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .transition-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.12) !important;
    }
    .transition-all {
        transition: all 0.2s ease-in-out;
    }
    .transition-all:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.08) !important;
        background-color: #f8f9fa;
        text-decoration: none;
    }
</style>
@endsection
