@extends('layouts.applicant_smart')

@section('content')
    <main id="js-page-content" role="main" class="page-content">
        @include('inc.breadcrumb', ['bcrumb' => 'bc_level_satu', 'bc_1' => 'Profil Saya'])
        <div class="alert alert-info fade show" role="alert">
            <div class="d-flex align-items-center">
                <div class="alert-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="flex-1">
                    <span class="h5">HASIL SELEKSI AWAL</span>
                </div>
            </div>
        </div>

        <div class="card mb-4 checklist-premium-card border-0 shadow-sm">
            <div class="card-header checklist-premium-header text-white d-flex align-items-center">
                <i class="fas fa-tasks mr-2 fa-lg"></i>
                <h5 class="mb-0 font-weight-bold text-white">Checklist Kelengkapan Data Diri</h5>
            </div>
            <div class="card-body">
                <p class="mb-3 text-muted">Harap lengkapi seluruh data wajib berikut agar lamaran Anda dapat diproses lebih
                    lanjut.</p>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span><i class="fas fa-id-card mr-2 text-primary"></i> Biodata Diri</span>
                                @if ($applier)
                                    <i class="fas fa-check-circle text-success fa-lg"></i>
                                @else
                                    <i class="fas fa-times-circle text-danger fa-lg"></i>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span><i class="fas fa-camera mr-2 text-primary"></i> Foto Profil</span>
                                @if (Auth::user()->avatar && !Str::startsWith(Auth::user()->avatar, 'http'))
                                    <i class="fas fa-check-circle text-success fa-lg"></i>
                                @else
                                    <i class="fas fa-times-circle text-danger fa-lg"></i>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span><i class="fas fa-address-card mr-2 text-primary"></i> Upload e-KTP</span>
                                @if ($applier->attachment && $applier->attachment != '-')
                                    <i class="fas fa-check-circle text-success fa-lg"></i>
                                @else
                                    <i class="fas fa-times-circle text-danger fa-lg"></i>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span><i class="fas fa-file-pdf mr-2 text-primary"></i> Curriculum Vitae (CV)</span>
                                @if ($applier->cv)
                                    <i class="fas fa-check-circle text-success fa-lg"></i>
                                @else
                                    <i class="fas fa-times-circle text-danger fa-lg"></i>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span><i class="fas fa-graduation-cap mr-2 text-primary"></i> Ijazah & Transkrip</span>
                                @if ($educations->whereNotNull('certificate')->count() > 0 && $educations->whereNotNull('transcript')->count() > 0)
                                    <i class="fas fa-check-circle text-success fa-lg"></i>
                                @else
                                    <i class="fas fa-times-circle text-danger fa-lg"></i>
                                @endif
                            </li>
                            @if ($applier->career && $applier->career->tipe == 'medis')
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span><i class="fas fa-user-md mr-2 text-primary"></i> STR/SIP (Wajib Medis)</span>
                                    @if ($licenses->whereNotNull('file')->count() > 0)
                                        <i class="fas fa-check-circle text-success fa-lg"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger fa-lg"></i>
                                    @endif
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3 mx-n2">
            <div class="col-6 col-sm-auto mb-2 mb-sm-0 px-2">
                <button type="button" class="btn btn-success btn-block waves-effect waves-themed" data-toggle="modal"
                    data-target="#modal-edit-profile">
                    <i class="fas fa-edit mr-1"></i> Edit Profil
                </button>
            </div>
            <div class="col-6 col-sm-auto mb-2 mb-sm-0 px-2">
                <button type="button" class="btn btn-warning btn-block waves-effect waves-themed" data-toggle="modal"
                    data-target="#modal-upload-photo">
                    <i class="fas fa-upload mr-1"></i> Upload Foto
                </button>
            </div>
            <div class="col-6 col-sm-auto mb-2 mb-sm-0 px-2">
                <button type="button" class="btn btn-warning btn-block waves-effect waves-themed" data-toggle="modal"
                    data-target="#modal-upload-cv">
                    <i class="fas fa-file-pdf mr-1"></i> Upload CV
                </button>
            </div>
            <div class="col-6 col-sm-auto mb-2 mb-sm-0 px-2">
                <button type="button" class="btn btn-warning btn-block waves-effect waves-themed" data-toggle="modal"
                    data-target="#modal-upload-ktp">
                    <i class="fas fa-id-card mr-1"></i> Upload eKTP
                </button>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Bio -->
            <div class="col-lg-4">
                <div id="panel-bio" class="panel profile-premium-panel">
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="d-flex flex-column align-items-center mb-4">
                                <div class="w-100 mb-3 text-center">
                                    @php
                                        $avatar = Auth::user()->avatar;
                                        $avatarUrl = asset('img/no-image.png');
                                        if ($avatar) {
                                            if (Str::startsWith($avatar, ['http://', 'https://'])) {
                                                $avatarUrl = $avatar;
                                            } else {
                                                $avatarUrl = asset('storage/' . $avatar);
                                            }
                                        }
                                    @endphp
                                    <img src="{{ $avatarUrl }}" class="rounded-circle shadow-sm"
                                        style="width: 140px; height: 140px; object-fit: cover;" alt="User profile picture">
                                </div>
                                <h3 class="fw-700 text-center mb-0">{{ Auth::user()->name }}</h3>
                                <p class="text-muted mb-0">({{ $applier->birth_place ?? '-' }}) -
                                    ({{ \Carbon\Carbon::parse($applier->birth_day ?? now())->age }} Tahun)</p>
                            </div>

                            <div class="row no-gutters">
                                <div class="col-6 col-lg-12 mb-3">
                                    <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;"><i class="fas fa-phone mr-1"></i> No. Telepon</small>
                                    <span class="text-dark font-weight-medium">{{ $applier->family_contact ?? (Auth::user()->phone ?? '-') }}</span>
                                </div>
                                <div class="col-6 col-lg-12 mb-3">
                                    <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;"><i class="fas fa-envelope mr-1"></i> Email</small>
                                    <span class="text-dark font-weight-medium text-truncate d-block" title="{{ Auth::user()->email }}">{{ Auth::user()->email }}</span>
                                </div>
                                <div class="col-6 col-lg-12 mb-3">
                                    <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;"><i class="fas fa-male mr-1"></i> Jenis Kelamin</small>
                                    <span class="text-dark font-weight-medium">{{ $applier->sex ?? '-' }}</span>
                                </div>
                                <div class="col-6 col-lg-12 mb-3">
                                    <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;"><i class="fas fa-tint mr-1"></i> Gol. Darah</small>
                                    <span class="text-dark font-weight-medium">{{ $applier->blood_type ?? '-' }}</span>
                                </div>
                                <div class="col-6 col-lg-12 mb-3">
                                    <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;"><i class="fas fa-heart mr-1"></i> Pernikahan</small>
                                    <span class="text-dark font-weight-medium">{{ $applier->marital_status ?? '-' }}</span>
                                </div>
                                <div class="col-6 col-lg-12 mb-3">
                                    <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;"><i class="fas fa-moon mr-1"></i> Agama</small>
                                    <span class="text-dark font-weight-medium">{{ $applier->religion ?? '-' }}</span>
                                </div>
                                <div class="col-6 col-lg-12 mb-3">
                                    <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;"><i class="fas fa-user-tag mr-1"></i> Minat Bagian</small>
                                    <span class="text-dark font-weight-medium text-truncate d-block" title="{{ $applier->position_interest ?? 'BELUM MEMILIH' }}">{{ $applier->position_interest ?? 'BELUM MEMILIH' }}</span>
                                </div>
                                <div class="col-6 col-lg-12 mb-3">
                                    <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;"><i class="fas fa-hospital mr-1"></i> Minat Faskes</small>
                                    <span class="text-dark font-weight-medium text-truncate d-block" title="{{ \App\Models\Identity::first()->name ?? 'RS Livasya' }}">{{ \App\Models\Identity::first()->name ?? 'RS Livasya' }}</span>
                                </div>
                                <div class="col-12 mb-3">
                                    <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;"><i class="fas fa-id-card mr-1"></i> NIK KTP</small>
                                    <span class="text-dark font-weight-medium">{{ $applier->id_card ?? '-' }}</span>
                                </div>
                                <div class="col-12 mb-3">
                                    <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;"><i class="fas fa-home mr-1"></i> Alamat KTP</small>
                                    <span class="text-dark font-weight-medium small d-block">{{ $applier->ktp_address ?? '-' }}</span>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-2">Tentang Saya...</h5>
                            <blockquote class="blockquote">
                                <p class="mb-0 text-muted font-italic" style="font-size: 0.9rem;">
                                    <i class="fas fa-quote-left mr-1"></i>
                                    {{ $applier->about_me ?? 'Belum ada deskripsi diri.' }}
                                    <i class="fas fa-quote-right ml-1"></i>
                                </p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Tabs -->
            <div class="col-lg-8">
                <div id="panel-tabs" class="panel" data-panel-close="false" data-panel-fullscreen="false"
                    data-panel-collapsed="false" data-panel-color="false" data-panel-locked="false"
                    data-panel-refresh="false" data-panel-reset="false">
                    <div class="panel-hdr d-flex flex-column flex-md-row align-items-center">
                        <h2 class="mb-2 mb-md-0">
                            Riwayat <span class="fw-300"><i>Data</i></span>
                        </h2>
                        <div class="panel-toolbar w-100 w-md-auto" style="overflow-x: auto; white-space: nowrap;">
                            <ul class="nav nav-tabs nav-tabs-clean flex-nowrap justify-content-start justify-content-md-end"
                                role="tablist">
                                <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                        href="#content-lain">Lain-lain</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                        href="#content-beasiswa">Beasiswa</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                        href="#content-str">STR/SIP</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                        href="#content-pelatihan">Pelatihan</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                        href="#content-kerja">Kerja</a></li>
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                        href="#content-pendidikan">Pendidikan</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- Removed Tooltips/Alerts -->

                            <div class="tab-content mt-3">
                                <!-- Pendidikan Tab -->
                                <div class="tab-pane fade show active" id="content-pendidikan">
                                    <h4 class="mb-3">Riwayat Pendidikan</h4>
                                    <div class="mb-3">
                                        <button class="btn btn-success waves-effect waves-themed" data-toggle="modal"
                                            data-target="#modal-pendidikan">Tambah</button>
                                    </div>
                                    <div class="row pt-2">
                                        @forelse($educations as $edu)
                                            <div class="col-12 col-md-6 mb-4">
                                                <div class="card premium-card h-100">
                                                    <div class="premium-card-accent-left accent-success"></div>
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                                            <span class="badge premium-badge premium-badge-success">
                                                                <i class="fas fa-graduation-cap mr-1"></i> {{ $edu->level }}
                                                            </span>
                                                            <form action="{{ route('applicant.profile.education.delete', $edu->id) }}" method="POST" class="d-inline">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-xs btn-action-premium btn-delete-confirm">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <h5 class="card-title-premium">{{ $edu->institution }}</h5>
                                                        <p class="text-muted small mb-2">
                                                            @if($edu->major)
                                                                <span class="d-block mb-1 text-dark"><i class="fas fa-book mr-1 text-muted"></i> Jurusan: <strong>{{ $edu->major }}</strong></span>
                                                            @endif
                                                            @if($edu->gpa)
                                                                <span class="d-block"><i class="fas fa-star mr-1 text-warning"></i> IPK/Nilai: <strong>{{ $edu->gpa }}</strong></span>
                                                            @endif
                                                        </p>
                                                        @if($edu->additional_notes)
                                                            <p class="text-muted small mb-3 font-italic bg-light p-2 rounded">{{ $edu->additional_notes }}</p>
                                                        @endif
                                                        @if ($edu->certificate || $edu->transcript)
                                                            <div class="border-top pt-3 mt-3 d-flex flex-wrap">
                                                                @if ($edu->certificate)
                                                                    <a href="{{ asset('storage/' . $edu->certificate) }}" target="_blank" class="btn btn-sm btn-outline-success mr-2 mb-1 px-3 rounded-pill">
                                                                        <i class="fas fa-file-pdf mr-1"></i> Ijazah
                                                                    </a>
                                                                @endif
                                                                @if ($edu->transcript)
                                                                    <a href="{{ asset('storage/' . $edu->transcript) }}" target="_blank" class="btn btn-sm btn-outline-info mb-1 px-3 rounded-pill">
                                                                        <i class="fas fa-file-pdf mr-1"></i> Transkrip
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-4 text-muted">
                                                <i class="fal fa-folder-open fa-3x mb-2 opacity-50"></i>
                                                <p class="mb-0">Belum ada data pendidikan.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Kerja Tab -->
                                <div class="tab-pane fade" id="content-kerja">
                                    <h4 class="mb-3">Riwayat Kerja</h4>
                                    <div class="mb-3">
                                        <button class="btn btn-success waves-effect waves-themed" data-toggle="modal"
                                            data-target="#modal-kerja">Tambah</button>
                                    </div>
                                    <div class="row pt-2">
                                        @forelse($works as $work)
                                            <div class="col-12 col-md-6 mb-4">
                                                <div class="card premium-card h-100">
                                                    <div class="premium-card-accent-left accent-primary"></div>
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                                            <span class="badge premium-badge {{ $work->is_active ? 'premium-badge-success' : 'premium-badge-secondary' }}">
                                                                <i class="fas fa-briefcase mr-1"></i> {{ $work->is_active ? 'Masih Bekerja' : 'Mantan Karyawan' }}
                                                            </span>
                                                            <form action="{{ route('applicant.profile.work.delete', $work->id) }}" method="POST" class="d-inline">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-xs btn-action-premium btn-delete-confirm">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <h5 class="card-title-premium">{{ $work->work_position }}</h5>
                                                        <h6 class="card-subtitle-premium text-primary"><i class="fas fa-building mr-1 text-muted"></i> {{ $work->work_name }}</h6>
                                                        <p class="text-muted small mb-2">
                                                            <i class="far fa-calendar-alt mr-1"></i>
                                                            {{ \Carbon\Carbon::parse($work->work_start)->format('d M Y') }} - 
                                                            {{ $work->is_active ? 'Sekarang' : \Carbon\Carbon::parse($work->work_end)->format('d M Y') }}
                                                        </p>
                                                        @if($work->description)
                                                            <p class="text-muted small mb-0 font-italic bg-light p-2 rounded">{{ $work->description }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-4 text-muted">
                                                <i class="fal fa-folder-open fa-3x mb-2 opacity-50"></i>
                                                <p class="mb-0">Belum ada data pengalaman kerja.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Pelatihan Tab -->
                                <div class="tab-pane fade" id="content-pelatihan">
                                    <h4 class="mb-3">Riwayat Pelatihan</h4>
                                    <div class="mb-3">
                                        <button class="btn btn-success waves-effect waves-themed" data-toggle="modal"
                                            data-target="#modal-pelatihan">Tambah</button>
                                    </div>
                                    <div class="row pt-2">
                                        @forelse($certifications as $cert)
                                            <div class="col-12 col-md-6 mb-4">
                                                <div class="card premium-card h-100">
                                                    <div class="premium-card-accent-left accent-warning"></div>
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                                            <span class="badge premium-badge premium-badge-warning">
                                                                <i class="fas fa-certificate mr-1"></i> Sertifikat Pelatihan
                                                            </span>
                                                            <form action="{{ route('applicant.profile.certification.delete', $cert->id) }}" method="POST" class="d-inline">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-xs btn-action-premium btn-delete-confirm">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <h5 class="card-title-premium">{{ $cert->certification_name }}</h5>
                                                        <p class="text-muted small mb-2">
                                                            <i class="far fa-calendar-alt mr-1"></i> 
                                                            {{ $cert->start_date ?? '-' }} s/d {{ $cert->end_date ?? '-' }}
                                                        </p>
                                                        @if($cert->description)
                                                            <p class="text-muted small mb-3 font-italic bg-light p-2 rounded">{{ $cert->description }}</p>
                                                        @endif
                                                        @if ($cert->file)
                                                            <div class="border-top pt-3 mt-3">
                                                                <a href="{{ asset('storage/' . $cert->file) }}" target="_blank" class="btn btn-sm btn-outline-warning text-dark border-warning px-3 rounded-pill">
                                                                    <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-4 text-muted">
                                                <i class="fal fa-folder-open fa-3x mb-2 opacity-50"></i>
                                                <p class="mb-0">Belum ada data pelatihan.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- STR/SIP Tab -->
                                <div class="tab-pane fade" id="content-str">
                                    <h4 class="mb-3">Riwayat STR/SIP</h4>
                                    <div class="mb-3">
                                        <button class="btn btn-success waves-effect waves-themed" data-toggle="modal"
                                            data-target="#modal-str">Tambah</button>
                                    </div>
                                    <div class="row pt-2">
                                        @forelse($licenses as $license)
                                            <div class="col-12 col-md-6 mb-4">
                                                <div class="card premium-card h-100">
                                                    <div class="premium-card-accent-left accent-danger"></div>
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                                            <span class="badge premium-badge premium-badge-danger">
                                                                <i class="fas fa-id-card mr-1"></i> {{ $license->type }}
                                                            </span>
                                                            <form action="{{ route('applicant.profile.license.delete', $license->id) }}" method="POST" class="d-inline">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-xs btn-action-premium btn-delete-confirm">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <h5 class="card-title-premium">{{ $license->section }}</h5>
                                                        <p class="text-muted small mb-2"><i class="fas fa-hashtag mr-1 text-muted"></i> No: <span class="font-weight-bold text-dark">{{ $license->number }}</span></p>
                                                        <p class="text-muted small mb-2"><i class="far fa-calendar-alt mr-1"></i> Periode: {{ $license->start_date }} - {{ $license->end_date }}</p>
                                                        <p class="text-muted small mb-2"><i class="fas fa-building mr-1 text-muted"></i> Penerbit: {{ $license->issuer }}</p>
                                                        @if ($license->file)
                                                            <div class="border-top pt-3 mt-3">
                                                                <a href="{{ asset('storage/' . $license->file) }}" target="_blank" class="btn btn-sm btn-outline-danger px-3 rounded-pill">
                                                                    <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-4 text-muted">
                                                <i class="fal fa-folder-open fa-3x mb-2 opacity-50"></i>
                                                <p class="mb-0">Belum ada data STR/SIP.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Beasiswa Tab -->
                                <div class="tab-pane fade" id="content-beasiswa">
                                    <h4 class="mb-3">Riwayat Beasiswa</h4>
                                    <div class="mb-3">
                                        <button class="btn btn-success waves-effect waves-themed" data-toggle="modal"
                                            data-target="#modal-beasiswa">Tambah</button>
                                    </div>
                                    <div class="row pt-2">
                                        @if (isset($scholarships))
                                            @forelse($scholarships as $scholarship)
                                                <div class="col-12 col-md-6 mb-4">
                                                    <div class="card premium-card h-100">
                                                        <div class="premium-card-accent-left accent-purple"></div>
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                                <span class="badge premium-badge premium-badge-purple">
                                                                    <i class="fas fa-award mr-1"></i> Penerima Beasiswa
                                                                </span>
                                                                <form action="{{ route('applicant.profile.scholarship.delete', $scholarship->id ?? 0) }}" method="POST" class="d-inline">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-xs btn-action-premium btn-delete-confirm">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <h5 class="card-title-premium">{{ $scholarship->name }}</h5>
                                                            <p class="text-muted small mb-2">
                                                                <i class="far fa-calendar-alt mr-1"></i> Periode: {{ $scholarship->start_date }} - {{ $scholarship->end_date }}
                                                            </p>
                                                            @if($scholarship->description)
                                                                <p class="text-muted small mb-0 font-italic bg-light p-2 rounded">{{ $scholarship->description }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center py-4 text-muted">
                                                    <i class="fal fa-folder-open fa-3x mb-2 opacity-50"></i>
                                                    <p class="mb-0">Belum ada data beasiswa.</p>
                                                </div>
                                            @endforelse
                                        @else
                                            <div class="col-12 text-center py-4 text-muted">
                                                <i class="fal fa-folder-open fa-3x mb-2 opacity-50"></i>
                                                <p class="mb-0">Fitur Beasiswa belum tersedia.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Dokumen Lain Tab -->
                                <div class="tab-pane fade" id="content-lain">
                                    <h4 class="mb-3">Dokumen Lain</h4>
                                    <div class="mb-3">
                                        <button class="btn btn-success waves-effect waves-themed" data-toggle="modal"
                                            data-target="#modal-lain">Tambah</button>
                                    </div>
                                    <div class="row pt-2">
                                        @forelse($others as $other)
                                            <div class="col-12 col-md-6 mb-4">
                                                <div class="card premium-card h-100">
                                                    <div class="premium-card-accent-left accent-secondary"></div>
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                                            <span class="badge premium-badge premium-badge-secondary">
                                                                <i class="fas fa-file-alt mr-1"></i> {{ $other->document_type }}
                                                            </span>
                                                            <form action="{{ route('applicant.profile.other.delete', $other->id) }}" method="POST" class="d-inline">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-xs btn-action-premium btn-delete-confirm">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                        </div>
                                                        <p class="text-muted small mb-2"><i class="far fa-calendar-alt mr-1"></i> Periode: {{ $other->start_date }} - {{ $other->end_date }}</p>
                                                        @if($other->description)
                                                            <p class="text-muted small mb-0 font-italic bg-light p-2 rounded">{{ $other->description }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-4 text-muted">
                                                <i class="fal fa-folder-open fa-3x mb-2 opacity-50"></i>
                                                <p class="mb-0">Belum ada dokumen pendukung.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section: Riwayat Lamaran -->
        <div id="panel-lamaran" class="panel">
            <div class="panel-hdr">
                <h2>
                    Riwayat <span class="fw-300"><i>Lamaran</i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Collapse"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <h3 class="mb-3">Riwayat Lamaran yg Sudah Diapply</h3>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Daftar Lamaran yang sudah diapply
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-danger waves-effect waves-themed">Batal</button>
                        <button class="btn btn-warning waves-effect waves-themed">Cetak</button>
                    </div>
                    <div class="row pt-2">
                        @if (Auth::user()->applier && Auth::user()->applier->career)
                             <div class="col-12 col-md-6 col-lg-4 mb-4">
                                 <div class="card premium-card h-100">
                                     <div class="premium-card-accent-top accent-info"></div>
                                     <div class="card-body">
                                         <div class="d-flex justify-content-between align-items-center mb-3">
                                             <span class="text-muted small">No: <span class="font-weight-bold text-dark">APP-{{ str_pad(Auth::user()->applier->id, 5, '0', STR_PAD_LEFT) }}</span></span>
                                             <span class="badge premium-badge premium-badge-info">Submitted</span>
                                         </div>
                                         <h5 class="card-title-premium">{{ Auth::user()->applier->career->title }}</h5>
                                         <p class="text-primary small mb-2 font-weight-bold"><i class="fas fa-hospital mr-1"></i> {{ \App\Models\Identity::first()->name ?? 'RS Livasya' }}</p>
                                         <hr class="my-3">
                                         <p class="text-muted small mb-2"><i class="far fa-calendar-alt mr-1"></i> Tgl Apply: <strong>{{ Auth::user()->applier->created_at->format('d/m/Y') }}</strong></p>
                                         <p class="text-muted small mb-0">
                                             <i class="fas fa-money-bill-wave mr-1 text-success"></i> Gaji Diharapkan: 
                                             <span class="font-weight-bold text-dark">
                                                 Rp {{ number_format((float) Auth::user()->applier->compensation_salary, 0, ',', '.') }}
                                             </span>
                                         </p>
                                     </div>
                                 </div>
                             </div>
                        @else
                            <div class="col-12 text-center py-4 text-muted">
                                <i class="fal fa-folder-open fa-3x mb-2 opacity-50"></i>
                                <p class="mb-0">Belum ada lamaran</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- MODALS -->

        <!-- Modal Pendidikan -->
        <div class="modal fade" id="modal-pendidikan" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="fas fa-edit mr-2"></i> Riwayat Pendidikan</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('applicant.profile.education.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-warning text-sm">
                                <i class="fas fa-exclamation-triangle"></i> Harap melengkapi kolom inputan yg berwarna
                                merah
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Tingkat Pendidikan</label>
                                <select class="form-control no-select2" name="level" required>
                                    <option value="">PILIH TINGKATAN</option>
                                    <option value="SMA/SMK">SMA/SMK</option>
                                    <option value="D3">D3</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Nama Institusi</label>
                                <input type="text" class="form-control" name="institution" required>
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Alamat</label>
                                <textarea class="form-control" name="address" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Upload Ijazah (PDF, Max 10MB)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="eduCert"
                                            name="certificate_file" accept=".pdf">
                                        <label class="custom-file-label" for="eduCert">Pilih file...</label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Upload Transkrip (PDF, Max 10MB)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="eduTrans"
                                            name="transcript_file" accept=".pdf">
                                        <label class="custom-file-label" for="eduTrans">Pilih file...</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Jurusan Pendidikan</label>
                                <select class="form-control no-select2" name="major" required>
                                    <option value="Lain-lain">Lain-lain</option>
                                    <option value="Keperawatan">Keperawatan</option>
                                    <option value="Kebidanan">Kebidanan</option>
                                    <option value="Farmasi">Farmasi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Jurusan Pendidikan Lainnya</label>
                                <input type="text" class="form-control" name="other_major"
                                    placeholder="Masukan jurusan pendidikan lain-lain">
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">IPK / Nilai Akhir</label>
                                <input type="text" class="form-control" name="gpa" placeholder="Contoh: 3.50"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pendidikan Tambahan (Bila Ada)</label>
                                <textarea class="form-control" name="additional_notes" rows="2"
                                    placeholder="Masukan pendidikan tambahan jika ada"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Kerja -->
        <div class="modal fade" id="modal-kerja" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="fas fa-briefcase mr-2"></i> Riwayat Kerja</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('applicant.profile.work.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-warning text-sm">
                                <i class="fas fa-exclamation-triangle"></i> Harap melengkapi kolom inputan yg berwarna
                                merah
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Nama Perusahaan</label>
                                <input type="text" class="form-control" name="work_name" required>
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Jabatan</label>
                                <input type="text" class="form-control" name="work_position" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="text-danger form-label">Tgl Awal</label>
                                    <input type="date" class="form-control" name="work_start" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Tgl Akhir</label>
                                    <input type="date" class="form-control" name="work_end">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Masih Bekerja</label>
                                    <select class="form-control no-select2" name="is_active">
                                        <option value="0">TIDAK</option>
                                        <option value="1">YA</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Lama Kerja</label>
                                    <input type="text" class="form-control" placeholder="Automated" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Pelatihan -->
        <div class="modal fade" id="modal-pelatihan" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="fas fa-certificate mr-2"></i> Riwayat Pelatihan</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('applicant.profile.certification.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-warning text-sm">
                                <i class="fas fa-exclamation-triangle"></i> Harap melengkapi kolom inputan yg berwarna
                                merah
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Nama Pelatihan</label>
                                <input type="text" class="form-control" name="certification_name" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Tgl Awal Pelatihan</label>
                                    <input type="date" class="form-control" name="start_date">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Tgl Akhir Pelatihan</label>
                                    <input type="date" class="form-control" name="end_date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Tgl Akhir Sertifikat</label>
                                    <input type="date" class="form-control" name="certificate_end_date">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Upload Sertifikat (PDF, Max 10MB)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="certFile" name="file"
                                        accept=".pdf">
                                    <label class="custom-file-label" for="certFile">Pilih file...</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Upload Foto -->
        <div class="modal fade" id="modal-upload-photo" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title"><i class="fas fa-upload mr-2"></i> Upload Foto Profil</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('applicant.profile.upload.photo') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label">Pilih Foto (JPG/JPEG/PNG, Max 10MB)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="photoInput" name="photo"
                                        required accept="image/*">
                                    <label class="custom-file-label text-truncate" for="photoInput">
                                        @if (Auth::user()->avatar && !Str::startsWith(Auth::user()->avatar, 'http'))
                                            <i class="fas fa-check-circle text-success mr-1"></i> {{ basename(Auth::user()->avatar) }}
                                        @else
                                            Pilih file...
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Upload KTP -->
        <div class="modal fade" id="modal-upload-ktp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title"><i class="fas fa-id-card mr-2"></i> Upload eKTP</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('applicant.profile.upload.ktp') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-info text-sm">
                                <i class="fas fa-info-circle"></i> Upload scan eKTP asli Anda.
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pilih File (PDF/JPG/PNG, Max 10MB)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="ktpInput" name="ktp_file"
                                        required accept=".pdf,image/*">
                                    <label class="custom-file-label text-truncate" for="ktpInput">
                                        @if ($applier && $applier->attachment && $applier->attachment != '-')
                                            <i class="fas fa-check-circle text-success mr-1"></i> {{ basename($applier->attachment) }}
                                        @else
                                            Pilih file...
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Lain -->
        <div class="modal fade" id="modal-lain" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="fas fa-file-alt mr-2"></i> Riwayat Lain-Lain</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('applicant.profile.other.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-warning text-sm">
                                <i class="fas fa-exclamation-triangle"></i> Harap melengkapi kolom inputan yg berwarna
                                merah
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Jenis Dokumen</label>
                                <input type="text" class="form-control" name="document_type"
                                    placeholder="PILIH JENIS DOKUMEN" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Tgl Awal Dokumen</label>
                                    <input type="date" class="form-control" name="start_date">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Tgl Akhir Dokumen</label>
                                    <input type="date" class="form-control" name="end_date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Beasiswa -->
        <div class="modal fade" id="modal-beasiswa" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="fas fa-graduation-cap mr-2"></i> Riwayat Beasiswa</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('applicant.profile.scholarship.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-warning text-sm">
                                <i class="fas fa-exclamation-triangle"></i> Harap melengkapi kolom inputan yg berwarna
                                merah
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Nama Beasiswa</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Tgl Awal Beasiswa</label>
                                    <input type="date" class="form-control" name="start_date">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Tgl Akhir Beasiswa</label>
                                    <input type="date" class="form-control" name="end_date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal STR -->
        <div class="modal fade" id="modal-str" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="fas fa-id-card mr-2"></i> Riwayat STR/SIPP</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('applicant.profile.license.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-warning text-sm">
                                <i class="fas fa-exclamation-triangle"></i> Harap melengkapi kolom inputan yg berwarna
                                merah
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Jenis</label>
                                <select class="form-control no-select2" name="type" required>
                                    <option value="">PILIH JENIS STR/SIPP</option>
                                    <option value="STR">STR</option>
                                    <option value="SIP">SIP</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Bagian</label>
                                <select class="form-control no-select2" name="section" required>
                                    <option value="">PILIH BAGIAN</option>
                                    <option value="Umum">Umum</option>
                                    <option value="Spesialis">Spesialis</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Nomor</label>
                                <input type="text" class="form-control" name="number" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="text-danger form-label">Tgl Mulai Berlaku</label>
                                    <input type="date" class="form-control" name="start_date" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="text-danger form-label">Tgl Akhir Berlaku</label>
                                    <input type="date" class="form-control" name="end_date" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Institusi Penerbit STR/SIP</label>
                                <input type="text" class="form-control" name="issuer">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Fasilitas Pelayanan Kesehatan</label>
                                <input type="text" class="form-control" name="facility">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="text-danger form-label">Upload STR/SIP (PDF, Max 10MB)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="strFile" name="file"
                                        accept=".pdf">
                                    <label class="custom-file-label" for="strFile">Pilih file...</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Edit Profil -->
        <div class="modal fade" id="modal-edit-profile" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="fas fa-user-edit mr-2"></i>
                            {{ $applier ? 'Edit Profil' : 'Lengkapi Profil' }}</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ $applier ? route('applicant.profile.update') : route('applicant.profile.store') }}"
                        method="POST">
                        @csrf
                        @if ($applier)
                            @method('PUT')
                        @endif
                        <div class="modal-body">
                            <div class="alert alert-warning text-sm mb-3">
                                <i class="fas fa-exclamation-triangle"></i> Harap pastikan data diri Anda akurat.
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">No. Telepon / WhatsApp</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ $applier->family_contact ?? (Auth::user()->phone ?? '-') }}"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select class="form-control no-select2" name="sex" required>
                                            <option value="Laki-laki"
                                                {{ ($applier->sex ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ ($applier->sex ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Golongan Darah</label>
                                        <select class="form-control no-select2" name="blood_type" required>
                                            <option value="A"
                                                {{ ($applier->blood_type ?? '') == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B"
                                                {{ ($applier->blood_type ?? '') == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="AB"
                                                {{ ($applier->blood_type ?? '') == 'AB' ? 'selected' : '' }}>AB</option>
                                            <option value="O"
                                                {{ ($applier->blood_type ?? '') == 'O' ? 'selected' : '' }}>O</option>
                                            <option value="-"
                                                {{ ($applier->blood_type ?? '') == '-' ? 'selected' : '' }}>-</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Status Pernikahan</label>
                                        <select class="form-control no-select2" name="marital_status" required>
                                            <option value="Lajang"
                                                {{ ($applier->marital_status ?? '') == 'Lajang' ? 'selected' : '' }}>Lajang
                                            </option>
                                            <option value="Menikah"
                                                {{ ($applier->marital_status ?? '') == 'Menikah' ? 'selected' : '' }}>
                                                Menikah</option>
                                            <option value="Cerai"
                                                {{ ($applier->marital_status ?? '') == 'Cerai' ? 'selected' : '' }}>Cerai
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="birth_place"
                                            value="{{ $applier->birth_place ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Agama</label>
                                        <select class="form-control no-select2" name="religion" required>
                                            <option value="Islam"
                                                {{ ($applier->religion ?? '') == 'Islam' ? 'selected' : '' }}>Islam
                                            </option>
                                            <option value="Katolik"
                                                {{ ($applier->religion ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik
                                            </option>
                                            <option value="Protestan"
                                                {{ ($applier->religion ?? '') == 'Protestan' ? 'selected' : '' }}>Protestan
                                            </option>
                                            <option value="Hindu"
                                                {{ ($applier->religion ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu
                                            </option>
                                            <option value="Budha"
                                                {{ ($applier->religion ?? '') == 'Budha' ? 'selected' : '' }}>Budha
                                            </option>
                                            <option value="Konghucu"
                                                {{ ($applier->religion ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                            </option>
                                            <option value="Lainnya"
                                                {{ ($applier->religion ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">KTP</label>
                                        <input type="text" class="form-control" name="id_card"
                                            value="{{ $applier->id_card ?? '' }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Minat Bagian</label>
                                        <select class="form-control no-select2" name="position_interest" required>
                                            <option value="">Pilih Minat Bagian</option>
                                            @foreach ($jobPositions as $pos)
                                                <option value="{{ $pos->name }}"
                                                    {{ ($applier->position_interest ?? '') == $pos->name ? 'selected' : '' }}>
                                                    {{ $pos->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" name="address" rows="1" required>{{ $applier->ktp_address ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="birth_day"
                                            value="{{ $applier->birth_day ?? '' }}">
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <label class="form-label font-weight-bold">Tentang Saya</label>
                                <textarea class="form-control" name="about_me" rows="4" placeholder="Ceritakan singkat tentang diri Anda...">{{ $applier->about_me ?? '' }}</textarea>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Upload CV -->
        <div class="modal fade" id="modal-upload-cv" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title"><i class="fas fa-file-pdf mr-2"></i> Upload CV</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('applicant.profile.upload.cv') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label">Pilih CV (PDF, Max 10MB)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="cvInput" name="cv"
                                        required accept=".pdf">
                                    <label class="custom-file-label text-truncate" for="cvInput">
                                        @if ($applier && $applier->cv)
                                            <i class="fas fa-check-circle text-success mr-1"></i> {{ basename($applier->cv) }}
                                        @else
                                            Pilih file...
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script nonce="{{ $nonce }}">
        $(document).ready(function() {
            // Check if profile is incomplete and show modal
            @if (!$applier || empty($applier->whatsapp_number) || empty($applier->id_card) || empty($applier->permanent_address))
                $('#modal-edit-profile').modal('show');
            @endif



            // Custom file input label change
            $('.custom-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html('<i class="fas fa-file mr-1 text-primary"></i> ' + fileName);
            });

            // Delete confirmation with SweetAlert2
            $(document).on('click', '.btn-delete-confirm', function(e) {
                e.preventDefault();
                var button = $(this);
                var form = button.closest('form');
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#fd3995', // Pink accent for delete/confirm
                    cancelButtonColor: '#868e96',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    heightAuto: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
