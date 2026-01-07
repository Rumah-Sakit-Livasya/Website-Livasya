@extends('inc.layout-blank')

@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-user-circle'></i> Detail Pelamar
                <small>
                    Informasi lengkap pelamar untuk posisi <strong>{{ $applier->career->title }}</strong>
                </small>
            </h1>
        </div>

        <div class="row">
            <!-- Left Column: User Profile & Actions -->
            <div class="col-lg-4">
                <div class="card mb-g shadow-sm border">
                    <div class="card-body p-4 text-center">
                        <div class="d-flex flex-column align-items-center mb-3">
                            <span class="d-block rounded-circle shadow-5 rounded mb-3 overflow-hidden"
                                style="width: 120px; height: 120px;">
                                @php
                                    $avatar = $applier->user ? $applier->user->avatar : null;
                                    $avatarUrl = asset('img/no-image.png');
                                    if ($avatar) {
                                        if (\Illuminate\Support\Str::startsWith($avatar, ['http://', 'https://'])) {
                                            $avatarUrl = $avatar;
                                        } else {
                                            $avatarUrl = asset('storage/' . $avatar);
                                        }
                                    }
                                @endphp
                                <img src="{{ $avatarUrl }}" class="img-fluid"
                                    style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $applier->first_name }}">
                            </span>
                            <h5 class="mb-0 fw-700">
                                {{ strtoupper($applier->first_name) }} {{ strtoupper($applier->last_name) }}
                            </h5>
                            <span class="text-muted fs-md">
                                {{ $applier->birth_place }}, {{ \Carbon\Carbon::parse($applier->birth_day)->age }} Tahun
                            </span>
                        </div>

                        <div class="mb-3">
                            <span
                                class="badge badge-primary badge-pill fs-sm px-3 py-1 mb-2">{{ $applier->career->title }}</span>
                            <br>
                            @if ($applier->status == 'processed')
                                <span class="badge badge-warning">Diproses</span>
                            @elseif($applier->status == 'accepted')
                                <span class="badge badge-success">Diterima</span>
                            @elseif($applier->status == 'rejected')
                                <span class="badge badge-danger">Ditolak</span>
                            @else
                                <span class="badge badge-secondary">{{ $applier->status }}</span>
                            @endif
                        </div>

                        <hr>

                        <div class="text-left">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fal fa-envelope mr-2 text-muted width-2"></i>
                                    <a href="mailto:{{ $applier->email }}" class="fs-sm">{{ $applier->email }}</a>
                                </li>
                                <li class="mb-2">
                                    <i class="fal fa-mobile-alt mr-2 text-muted width-2"></i>
                                    <a href="tel:{{ $applier->whatsapp_number ?? '-' }}"
                                        class="fs-sm">{{ $applier->whatsapp_number ?? '-' }}</a>
                                </li>
                                <li class="mb-2">
                                    <i class="fal fa-id-card mr-2 text-muted width-2"></i>
                                    <span class="fs-sm">{{ $applier->id_card }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-4">
                            @if ($applier->cv)
                                <a href="{{ asset('storage/' . $applier->cv) }}" target="_blank"
                                    class="btn btn-primary btn-block waves-effect waves-themed">
                                    <i class="fal fa-file-pdf mr-1"></i> Download CV
                                </a>
                            @else
                                <button class="btn btn-secondary btn-block" disabled><i class="fal fa-file-pdf mr-1"></i> CV
                                    Tidak Tersedia</button>
                            @endif

                            <a href="{{ url()->previous() }}"
                                class="btn btn-outline-secondary btn-block mt-2 waves-effect waves-themed">
                                <i class="fal fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Tabs -->
            <div class="col-lg-8">
                <div id="panel-tabs" class="panel">
                    <div class="panel-hdr">
                        <h2>Detail Informasi</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab-personal" role="tab">
                                        <i class="fal fa-user mr-1 text-primary"></i> Data Pribadi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-education" role="tab">
                                        <i class="fal fa-graduation-cap mr-1 text-success"></i> Pendidikan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-experience" role="tab">
                                        <i class="fal fa-briefcase mr-1 text-info"></i> Pengalaman
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-family" role="tab">
                                        <i class="fal fa-users mr-1 text-warning"></i> Keluarga
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-docs" role="tab">
                                        <i class="fal fa-folder-open mr-1 text-danger"></i> Dokumen
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content p-4">
                                <!-- TAB 1: DATA PRIBADI -->
                                <div class="tab-pane fade show active" id="tab-personal" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label
                                                class="form-label d-block text-muted text-uppercase fs-xs font-weight-bold">Jenis
                                                Kelamin</label>
                                            <span class="fs-md">{{ $applier->sex }}</span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label
                                                class="form-label d-block text-muted text-uppercase fs-xs font-weight-bold">Agama</label>
                                            <span class="fs-md">{{ $applier->religion }}</span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label
                                                class="form-label d-block text-muted text-uppercase fs-xs font-weight-bold">Status
                                                Pernikahan</label>
                                            <span class="fs-md">{{ $applier->marital_status }}</span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label
                                                class="form-label d-block text-muted text-uppercase fs-xs font-weight-bold">Suku
                                                / Kewarganegaraan</label>
                                            <span class="fs-md">{{ $applier->suku }} /
                                                {{ $applier->nationality ?? '-' }}</span>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label
                                                class="form-label d-block text-muted text-uppercase fs-xs font-weight-bold">Tentang
                                                Saya</label>
                                            <p class="fs-md text-muted">{{ $applier->about_me ?? '-' }}</p>
                                        </div>
                                        <div class="col-12">
                                            <hr class="my-2">
                                        </div>
                                        <div class="col-md-6 mb-3 mt-2">
                                            <label
                                                class="form-label d-block text-muted text-uppercase fs-xs font-weight-bold">Alamat
                                                KTP</label>
                                            <span class="fs-md">{{ $applier->ktp_address }}</span>
                                        </div>
                                        <div class="col-md-6 mb-3 mt-2">
                                            <label
                                                class="form-label d-block text-muted text-uppercase fs-xs font-weight-bold">Alamat
                                                Domisili</label>
                                            <span class="fs-md">{{ $applier->permanent_address }}</span>
                                        </div>
                                        <div class="col-12">
                                            <hr class="my-2">
                                        </div>
                                        <!-- Harapan Kompensasi -->
                                        <div class="col-md-6 mb-3 mt-2">
                                            <label
                                                class="form-label d-block text-muted text-uppercase fs-xs font-weight-bold">Harapan
                                                Gaji</label>
                                            <span
                                                class="fs-md text-success fw-bold">{{ $applier->compensation_salary }}</span>
                                        </div>
                                        <div class="col-md-6 mb-3 mt-2">
                                            <label
                                                class="form-label d-block text-muted text-uppercase fs-xs font-weight-bold">Tanggal
                                                Mulai Efektif</label>
                                            <span class="fs-md">{{ $applier->compensation_workdate }}</span>
                                        </div>
                                    </div>

                                    <!-- BAHASA -->
                                    <h5 class="mt-4 mb-3">Kemampuan Bahasa</h5>
                                    @if ($languages->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered">
                                                <thead class="bg-primary-50">
                                                    <tr>
                                                        <th>Bahasa</th>
                                                        <th>Lisan</th>
                                                        <th>Menulis</th>
                                                        <th>Membaca</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($languages as $lang)
                                                        <tr>
                                                            <td>{{ $lang->language_name }}</td>
                                                            <td>{{ $lang->language_spoken }}</td>
                                                            <td>{{ $lang->language_written }}</td>
                                                            <td>{{ $lang->language_reading }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-muted font-italic">Tidak ada data bahasa.</p>
                                    @endif
                                </div>

                                <!-- TAB 2: PENDIDIKAN -->
                                <div class="tab-pane fade" id="tab-education" role="tabpanel">
                                    <div class="alert alert-info py-2">
                                        <strong>Pendidikan Terakhir (Utama):</strong> {{ $applier->school_name }} -
                                        {{ $applier->school_major }}
                                    </div>

                                    @if ($educations->count() > 0)
                                        <div class="timeline-v2">
                                            @foreach ($educations as $edu)
                                                <div class="d-flex mb-3">
                                                    <div class="d-flex flex-column align-items-center mr-3"
                                                        style="width: 50px;">
                                                        <div class="rounded-circle bg-success-50 d-flex align-items-center justify-content-center text-success font-weight-bold fs-lg"
                                                            style="width: 40px; height: 40px;">
                                                            <i class="fal fa-graduation-cap"></i>
                                                        </div>
                                                        <div
                                                            class="h-100 border-left border-dashed border-secondary opacity-50 my-1">
                                                        </div>
                                                    </div>
                                                    <div class="card flex-1 shadow-sm border">
                                                        <div class="card-body p-3">
                                                            <div class="d-flex justify-content-between">
                                                                <h5 class="m-0 font-weight-bold text-success">
                                                                    {{ $edu->institution }}</h5>
                                                                <span class="badge badge-secondary">{{ $edu->start_year }}
                                                                    - {{ $edu->end_year }}</span>
                                                            </div>
                                                            <p class="m-0 font-weight-bold text-dark">{{ $edu->major }}
                                                                ({{ $edu->qualification }})</p>
                                                            <p class="m-0 text-muted fs-sm">IPK/Nilai: {{ $edu->gpa }}
                                                            </p>
                                                            @if ($edu->certificate)
                                                                <a href="{{ asset('storage/' . $edu->certificate) }}"
                                                                    target="_blank" class="fs-xs text-primary"><i
                                                                        class="fal fa-paperclip"></i> Lihat Ijazah</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <!-- Fallback to flat data if no relational data -->
                                        <div class="card shadow-sm border mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="text-muted fs-xs font-weight-bold">Institusi</label>
                                                        <p class="fw-bold">{{ $applier->school_name }}
                                                            ({{ $applier->school_city }})</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="text-muted fs-xs font-weight-bold">Tahun
                                                            Lulus</label>
                                                        <p>{{ $applier->school_year }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="text-muted fs-xs font-weight-bold">Jurusan</label>
                                                        <p>{{ $applier->school_major }} ({{ $applier->school_qual }})</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="text-muted fs-xs font-weight-bold">IPK</label>
                                                        <p>{{ $applier->school_gpa }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Beasiswa -->
                                    @if ($scholarships->count() > 0)
                                        <h5 class="mt-4 text-warning">Riwayat Beasiswa</h5>
                                        <ul class="list-group">
                                            @foreach ($scholarships as $s)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>{{ $s->name }}</span>
                                                    <span
                                                        class="badge badge-warning badge-pill">{{ \Carbon\Carbon::parse($s->start_date)->year }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>

                                <!-- TAB 3: PENGALAMAN -->
                                <div class="tab-pane fade" id="tab-experience" role="tabpanel">
                                    @if ($works->count() > 0)
                                        <div class="timeline-v2">
                                            @foreach ($works as $work)
                                                <div class="d-flex mb-4">
                                                    <div class="d-flex flex-column align-items-center mr-3"
                                                        style="width: 50px;">
                                                        <div class="rounded-circle bg-info-50 d-flex align-items-center justify-content-center text-info font-weight-bold fs-lg"
                                                            style="width: 40px; height: 40px;">
                                                            <i class="fal fa-building"></i>
                                                        </div>
                                                        <div
                                                            class="h-100 border-left border-dashed border-secondary opacity-50 my-1">
                                                        </div>
                                                    </div>
                                                    <div class="card flex-1 shadow-sm border">
                                                        <div class="card-body p-3">
                                                            <div class="d-flex justify-content-between align-items-end">
                                                                <div>
                                                                    <h5 class="m-0 font-weight-bold text-info">
                                                                        {{ $work->work_name }}</h5>
                                                                    <span
                                                                        class="d-block text-muted fs-sm">{{ $work->work_position }}</span>
                                                                </div>
                                                                <span
                                                                    class="text-muted fs-xs">{{ tgl($work->work_start) }}
                                                                    - {{ tgl($work->work_end) }}</span>
                                                            </div>
                                                            <hr class="my-2">
                                                            <div class="row fs-sm">
                                                                <div class="col-md-6 mb-1">
                                                                    <span class="text-muted">Gaji Terakhir:</span> <span
                                                                        class="fw-bold">{{ $work->work_latest_salary }}</span>
                                                                </div>
                                                                <div class="col-md-6 mb-1">
                                                                    <span class="text-muted">Alasan Pindah:</span>
                                                                    <span>{{ $work->work_reason }}</span>
                                                                </div>
                                                                <div class="col-12 mt-2">
                                                                    <span class="d-block text-muted font-italic "><i
                                                                            class="fal fa-quote-left mr-1"></i> Prestasi:
                                                                        {{ $work->work_achievement }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="fal fa-exclamation-triangle mr-2"></i> Belum ada data pengalaman
                                            kerja.
                                        </div>
                                    @endif
                                </div>

                                <!-- TAB 4: KELUARGA -->
                                <div class="tab-pane fade" id="tab-family" role="tabpanel">
                                    <h5 class="text-primary">Keluarga Inti</h5>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted fs-xs font-weight-bold">Nama</label>
                                            <span class="d-block">{{ $applier->family_name }}</span>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted fs-xs font-weight-bold">Hubungan</label>
                                            <span class="d-block">{{ $applier->family_relationship }}</span>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted fs-xs font-weight-bold">Pekerjaan</label>
                                            <span class="d-block">{{ $applier->family_occupation }}</span>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted fs-xs font-weight-bold">Kontak</label>
                                            <span class="d-block">{{ $applier->family_contact }}</span>
                                        </div>
                                    </div>

                                    <hr>

                                    <h5 class="text-danger">Kontak Darurat</h5>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted fs-xs font-weight-bold">Nama</label>
                                            <span class="d-block">{{ $applier->emergency_name }}</span>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted fs-xs font-weight-bold">Hubungan</label>
                                            <span class="d-block">{{ $applier->emergency_relation }}</span>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted fs-xs font-weight-bold">Nomor</label>
                                            <span class="d-block">{{ $applier->emergency_phone }}</span>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="text-muted fs-xs font-weight-bold">Alamat</label>
                                            <span class="d-block">{{ $applier->emergency_address }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- TAB 5: DOKUMEN -->
                                <div class="tab-pane fade" id="tab-docs" role="tabpanel">
                                    <div class="row">
                                        <!-- KTP -->
                                        <div class="col-md-6 mb-4">
                                            <div class="card border shadow-sm h-100">
                                                <div class="card-body text-center">
                                                    <div class="mb-3 text-primary"><i class="fal fa-id-card fa-3x"></i>
                                                    </div>
                                                    <h5 class="card-title">e-KTP</h5>
                                                    @if ($applier->attachment)
                                                        <a href="{{ asset('storage/' . $applier->attachment) }}"
                                                            target="_blank"
                                                            class="btn btn-sm btn-outline-primary shadow-0">Lihat File</a>
                                                    @else
                                                        <span class="text-danger fs-sm">Belum ada file.</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- CV -->
                                        <div class="col-md-6 mb-4">
                                            <div class="card border shadow-sm h-100">
                                                <div class="card-body text-center">
                                                    <div class="mb-3 text-danger"><i class="fal fa-file-pdf fa-3x"></i>
                                                    </div>
                                                    <h5 class="card-title">Curriculum Vitae</h5>
                                                    @if ($applier->cv)
                                                        <a href="{{ asset('storage/' . $applier->cv) }}" target="_blank"
                                                            class="btn btn-sm btn-outline-danger shadow-0">Lihat File</a>
                                                    @else
                                                        <span class="text-danger fs-sm">Belum ada file.</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Licenses (STR/SIP) -->
                                        @foreach ($licenses as $lic)
                                            <div class="col-md-6 mb-4">
                                                <div class="card border shadow-sm h-100">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3 text-success"><i
                                                                class="fal fa-file-certificate fa-3x"></i></div>
                                                        <h5 class="card-title">License: {{ $lic->type }}</h5>
                                                        <p class="fs-xs text-muted mb-2">Exp: {{ tgl($lic->end_date) }}
                                                        </p>
                                                        @if ($lic->file)
                                                            <a href="{{ asset('storage/' . $lic->file) }}" target="_blank"
                                                                class="btn btn-sm btn-outline-success shadow-0">Lihat
                                                                File</a>
                                                        @else
                                                            <span class="text-danger fs-sm">Belum ada file.</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Certifications -->
                                        @foreach ($certifications as $cert)
                                            <div class="col-md-6 mb-4">
                                                <div class="card border shadow-sm h-100">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3 text-warning"><i class="fal fa-award fa-3x"></i>
                                                        </div>
                                                        <h5 class="card-title">{{ $cert->certification_name }}</h5>
                                                        <p class="fs-xs text-muted mb-2">
                                                            {{ $cert->certification_institution }}</p>
                                                        @if ($cert->file)
                                                            <a href="{{ asset('storage/' . $cert->file) }}" target="_blank"
                                                                class="btn btn-sm btn-outline-warning shadow-0">Lihat
                                                                File</a>
                                                        @else
                                                            <span class="badge badge-light">Tidak ada file</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
