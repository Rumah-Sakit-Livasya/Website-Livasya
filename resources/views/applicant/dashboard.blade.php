@extends('layouts.applicant_smart')

@section('content')
    <main id="js-page-content" role="main" class="page-content">
        @include('inc.breadcrumb', ['bcrumb' => 'bc_level_satu', 'bc_1' => 'Dashboard'])
        <div class="subheader">
            @component('inc.subheader', ['subheader_title' => 'st_type_1'])
                @slot('sh_icon')
                    chart-area
                @endslot
                @slot('sh_titile_main')
                    Dashboard
                @endslot
                @slot('sh_titile_sub')
                    Ringkasan aktivitas pelamar
                @endslot
            @endcomponent
        </div>
        <div class="row">
            <!-- Profile Column (Left) -->
            <div class="col-lg-4">
                <!-- User Profile Panel -->
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Profil <span class="fw-300"><i>Pelamar</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="text-center">
                                <div class="w-100 mb-3">
                                    <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random' }}"
                                        class="rounded-circle shadow-sm"
                                        style="width: 100px; height: 100px; object-fit: cover;" alt="User Avatar">
                                </div>
                                <h2 class="fw-700 mb-0 text-truncate">
                                    {{ Auth::user()->name }}
                                </h2>
                                <h5 class="fw-300 text-muted mb-3">
                                    {{ Auth::user()->applier->career->title ?? 'Belum Memilih Posisi' }}
                                </h5>
                                <p class="text-muted">
                                    <i class="fas fa-envelope mr-1"></i> {{ Auth::user()->email }}
                                </p>
                            </div>

                            <hr class="my-3">

                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted">Status Lamaran</span>
                                    <span
                                        class="badge {{ Auth::user()->applier ? 'badge-info' : 'badge-secondary' }} badge-pill">
                                        {{ Auth::user()->applier ? 'Dalam Proses' : 'Belum Submit' }}
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted">Posisi Dilamar</span>
                                    <span class="font-weight-bold">{{ Auth::user()->applier->career->title ?? '-' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted">Tgl Daftar</span>
                                    <span>{{ Auth::user()->created_at->format('d M Y') }}</span>
                                </li>
                            </ul>

                            <a href="{{ route('applicant.profile.create') }}"
                                class="btn btn-primary btn-block waves-effect waves-themed">
                                <i class="fas fa-edit mr-1"></i>
                                {{ Auth::user()->applier ? 'Edit Profil' : 'Lengkapi Profil' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- About Me Panel -->
                <div id="panel-2" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Tentang <span class="fw-300"><i>Saya</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <strong><i class="fas fa-book mr-1"></i> Pendidikan Terakhir</strong>
                            <p class="text-muted mb-3">
                                {{ Auth::user()->applier->school_name ?? '-' }}
                                @if (isset(Auth::user()->applier->school_major))
                                    <br> <small>({{ Auth::user()->applier->school_major }})</small>
                                @endif
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Domisili</strong>
                            <p class="text-muted mb-3">{{ Auth::user()->applier->ktp_address ?? '-' }}</p>

                            <hr>

                            <strong><i class="fas fa-file-alt mr-1"></i> Dokumen</strong>
                            <p class="text-muted mb-0">
                                @if (Auth::user()->applier && Auth::user()->applier->attachment && Auth::user()->applier->attachment != '-')
                                    <span class="badge badge-success badge-pill">Sudah Upload</span>
                                @else
                                    <span class="badge badge-warning badge-pill">Belum Lengkap</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Column (Right) -->
            <div class="col-lg-8">
                <!-- Stat Widgets (SmartAdmin Style) -->
                <div class="row">
                    <div class="col-sm-4">
                        <div class="p-3 bg-info-300 rounded overflow-hidden position-relative text-white mb-g">
                            <div class="">
                                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                    {{ Auth::user()->applier && Auth::user()->applier->attachment != '-' ? 'Ada' : 'Kosong' }}
                                    <small class="m-0 l-h-n">Dokumen</small>
                                </h3>
                            </div>
                            <i class="fas fa-file-upload position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                                style="font-size:4rem"></i>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g">
                            <div class="">
                                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                    {{ Auth::user()->hasVerifiedEmail() ? 'Verified' : 'Pending' }}
                                    <small class="m-0 l-h-n">Status Email</small>
                                </h3>
                            </div>
                            <i class="fas fa-check-circle position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                                style="font-size:4rem"></i>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
                            <div class="">
                                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                    {{ \App\Models\Career::where('status', 'on')->count() }}
                                    <small class="m-0 l-h-n">Lowongan Aktif</small>
                                </h3>
                            </div>
                            <i class="fas fa-briefcase position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                                style="font-size:4rem"></i>
                        </div>
                    </div>
                </div>

                <!-- Main Card Tabs -->
                <div id="panel-3" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Aktivitas <span class="fw-300"><i>Pelamar</i></span>
                        </h2>
                        <div class="panel-toolbar">
                            <ul class="nav nav-tabs border-bottom-0 nav-tabs-clean" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#announcement"
                                        role="tab">Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#timeline" role="tab">Aktivitas</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="tab-content">
                                <!-- Announcement Tab -->
                                <div class="tab-pane fade show active" id="announcement" role="tabpanel">
                                    @if (!Auth::user()->applier)
                                        <div class="alert alert-warning alert-dismissible fade show">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="d-flex align-items-center">
                                                <div class="alert-icon">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <span class="h5">Profil Belum Lengkap!</span>
                                                    <br>
                                                    Anda belum melengkapi data diri. Silahkan lengkapi profil Anda agar
                                                    dapat melamar posisi pekerjaan.
                                                    <div class="mt-2">
                                                        <a href="{{ route('applicant.profile.create') }}"
                                                            class="btn btn-warning btn-sm btn-pills text-dark font-weight-bold">
                                                            Lengkapi Sekarang
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-info alert-dismissible fade show">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="d-flex align-items-center">
                                                <div class="alert-icon">
                                                    <i class="fas fa-info-circle"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <span class="h5">Data Tersimpan</span>
                                                    <br>
                                                    Terima kasih telah melengkapi data diri Anda. Tim HRD kami akan segera
                                                    meninjau aplikasi Anda.
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Real Job Listing -->
                                    <div class="subheader mt-4">
                                        <h3 class="subheader-title">
                                            <i class='subheader-icon fal fa-briefcase'></i> Lowongan Terbaru
                                            <small>
                                                Daftar lowongan pekerjaan yang tersedia saat ini.
                                            </small>
                                        </h3>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped w-100">
                                            <thead class="bg-primary-600">
                                                <tr>
                                                    <th class="text-white">Posisi</th>
                                                    <th class="text-white">Tipe</th>
                                                    <th class="text-white" style="width: 150px">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($careers as $job)
                                                    <tr>
                                                        <td class="align-middle font-weight-bold">{{ $job->title }}</td>
                                                        <td class="align-middle">
                                                            @if ($job->tipe == 'medis')
                                                                <span class="badge badge-success badge-pill">Medis</span>
                                                            @else
                                                                <span class="badge badge-info badge-pill">Non-Medis</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-primary btn-block btn-apply waves-effect waves-themed"
                                                                data-id="{{ $job->id }}"
                                                                data-title="{{ $job->title }}" data-toggle="modal"
                                                                data-target="#modal-apply">
                                                                Lamar Sekarang
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted py-4">
                                                            <i class="fal fa-search fa-3x mb-3 d-block opacity-50"></i>
                                                            Tidak ada lowongan aktif saat ini.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- Timeline Tab -->
                                <div class="tab-pane fade" id="timeline" role="tabpanel">
                                    <!-- SmartAdmin Timeline -->
                                    <div class="timeline-v2">
                                        <div class="timeline-pills">
                                            <span
                                                class="badge badge-primary rounded-pill">{{ Auth::user()->created_at->format('d M Y') }}</span>
                                        </div>

                                        <!-- Timeline Item 1 -->
                                        <div class="timeline-item">
                                            <div class="timeline-media bg-primary-500">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div class="mr-2">
                                                        <a href="#"
                                                            class="font-weight-bold">{{ Auth::user()->name }}</a>
                                                        <span class="text-muted">bergabung dengan sistem.</span>
                                                    </div>
                                                    <small
                                                        class="text-muted">{{ Auth::user()->created_at->format('H:i') }}</small>
                                                </div>
                                                <p class="m-0">Akun pelamar berhasil dibuat.</p>
                                            </div>
                                        </div>

                                        @if (Auth::user()->applier)
                                            <!-- Timeline Item 2 -->
                                            <div class="timeline-item">
                                                <div class="timeline-media bg-warning-500">
                                                    <i class="fas fa-save text-white"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                                        <div class="mr-2">
                                                            <span class="font-weight-bold">Profil Diperbarui</span>
                                                        </div>
                                                        <small
                                                            class="text-muted">{{ Auth::user()->applier->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <p class="m-0">Data profil lengkap pelamar telah disimpan.</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- End SmartAdmin Timeline -->
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

        <!-- Apply Modal -->
        <div class="modal fade" id="modal-apply">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title"><i class="fas fa-edit mr-2"></i> Apply Loker</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('applicant.apply') }}" method="POST" id="applyForm">
                        <input type="hidden" name="career_id" id="career_id">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> Harap melengkapi kolom inputan yg berwarna
                                merah
                            </div>

                            <h4 class="font-weight-bold text-center" id="modalJobTitle">POSITION TITLE</h4>
                            <p class="text-center text-muted"><i class="fas fa-map-marker-alt"></i> Penempatan di
                                {{ \App\Models\Identity::first()->name ?? 'RS Livasya' }}</p>

                            <div class="form-group">
                                <label class="text-danger">Ijazah yg dipakai</label>
                                <select class="form-control" name="education_id" required>
                                    <option value="">PILIH IJAZAH</option>
                                    @if (Auth::user()->applier && Auth::user()->applier->educations)
                                        @foreach (Auth::user()->applier->educations as $edu)
                                            <option value="{{ $edu->id }}">{{ $edu->level }} -
                                                {{ $edu->school_name }} ({{ $edu->major }})</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small class="text-muted font-italic">Kolom ini wajib diisi (Jika data kosong, harap
                                    lengkapi
                                    terlebih dahulu data riwayat pendidikan di halaman profil)</small>
                            </div>

                            <div class="form-group">
                                <label>Salary</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="expected_salary"
                                        placeholder="Contoh: 5000000">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <div class="input-group">
                                    <textarea class="form-control" name="notes" rows="2"></textarea>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </main>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('.btn-apply').on('click', function() {
                var title = $(this).data('title');
                var id = $(this).data('id');
                $('#modalJobTitle').text(title);
                $('#career_id').val(id);
            });
        });
    </script>
@endsection
