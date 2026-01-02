@extends('layouts.applicant')

@section('content')
    <div class="row">
        <!-- Left Column -->
        <div class="col-md-4">
            <!-- Hasil Seleksi Awal Alert -->
            <div class="card-custom">
                <div class="card-header-custom text-center">
                    HASIL SELEKSI AWAL
                </div>
                <!-- Empty content for now as per image logic implied -->
            </div>

            <!-- Warning Alert -->
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-exclamation-triangle"></i> Harap mengisi formulir online dan melengkapi dokumen
                    secara benar dan lengkap.</h5>
                <small>
                    Dokumen yang wajib dilengkapi:
                    <ul class="pl-3 mb-0">
                        <li>Upload Foto Profil (jpg/jpeg)</li>
                        <li>Upload Transkrip Nilai (pdf)</li>
                        <li>Upload KTP (pdf)</li>
                        <li>Upload STR (pdf) untuk pelamar profesi</li>
                        <li>Upload Ijazah (pdf)</li>
                    </ul>
                    Ketidaklengkapan formulir dan dokumen mengakibatkan lamaran Anda TIDAK diproses lebih lanjut.
                </small>
            </div>

            <!-- Action Buttons -->
            <div class="btn-group w-100 mb-3">
                <button class="btn btn-success btn-sm">Edit Profil</button>
                <button class="btn btn-warning btn-sm">Upload Foto</button>
                <button class="btn btn-warning btn-sm">Upload eKTP</button>
            </div>

            <!-- Profile Card -->
            <div class="card-custom p-3">
                <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ Auth::user()->avatar ?? asset('img/default-avatar.png') }}" alt="User profile"
                        class="profile-img-circle mb-3">
                    <h4>{{ Auth::user()->name }}</h4>
                    <p class="text-muted mb-1">{{ Auth::user()->applier->sex ?? '-' }} -
                        ({{ \Carbon\Carbon::parse(Auth::user()->applier->birth_day ?? 'now')->age }} Tahun)</p>
                    <div class="text-left w-100 mt-2">
                        <p class="mb-1"><i class="fas fa-phone mr-2 text-primary"></i>
                            {{ Auth::user()->applier->family_contact ?? '-' }}</p>
                        <p class="mb-1"><i class="fas fa-envelope mr-2 text-primary"></i> {{ Auth::user()->email }}</p>
                        <p class="mb-1"><i class="fas fa-venus-mars mr-2 text-primary"></i>
                            {{ Auth::user()->applier->sex ?? '-' }}</p>
                        <p class="mb-1"><i class="fas fa-tint mr-2 text-primary"></i> Gol. Darah
                            {{ Auth::user()->applier->blood_type ?? '-' }}</p>
                        <p class="mb-1"><i class="fas fa-ring mr-2 text-primary"></i>
                            {{ Auth::user()->applier->marital_status ?? 'Belum Kawin' }}</p>
                        <p class="mb-1"><i class="fas fa-praying-hands mr-2 text-primary"></i>
                            {{ Auth::user()->applier->religion ?? 'ISLAM' }}</p>
                        <p class="mb-1"><i class="fas fa-briefcase mr-2 text-primary"></i> Minat Bagian:
                            {{ Auth::user()->applier->career->position_name ?? '-' }}</p>
                        <p class="mb-1"><i class="fas fa-hospital mr-2 text-primary"></i> Minat Faskes: PT. Mitra Plumbon
                            Healthcare</p>
                        <p class="mb-1"><i class="fas fa-id-card mr-2 text-primary"></i> KTP:
                            {{ Auth::user()->applier->id_card ?? '-' }}</p>
                        <p class="mb-1"><i class="fas fa-home mr-2 text-primary"></i>
                            {{ Auth::user()->applier->ktp_address ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Tentang Saya -->
            <div class="card-custom p-3">
                <h5>Tentang Saya...</h5>
                <p class="text-muted"><i class="fas fa-quote-left mr-2"></i> {{ Auth::user()->applier->about_me ?? '-' }}
                    <i class="fas fa-quote-right ml-2"></i></p>
            </div>
        </div>

        <!-- Right Column (Tabs) -->
        <div class="col-md-8">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs nav-tabs-custom" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-file-alt mr-1"></i> Data
                                Diri</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-graduation-cap mr-1"></i>
                                Pendidikan</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-briefcase mr-1"></i>
                                Kerja</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-certificate mr-1"></i>
                                Pelatihan</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-id-badge mr-1"></i>
                                STR/SIP</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-folder-open mr-1"></i>
                                Lain-lain</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <!-- Tab Content Example: Pendidikan -->
                    <div class="alert alert-info small">
                        <i class="fas fa-info-circle mr-1"></i> Jika pilihan inputan tidak muncul, silahkan refresh halaman
                        ini
                    </div>
                    <div class="alert alert-warning small">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Untuk melakukan edit, hapus, dan upload, pilih atau
                        select terlebih dahulu data yang ingin diproses
                    </div>

                    <h3>Riwayat Pendidikan</h3>
                    <div class="action-btn-group mb-3">
                        <button class="btn btn-success btn-sm">Tambah</button>
                        <button class="btn btn-secondary btn-sm disabled">Edit</button>
                        <button class="btn btn-danger btn-sm disabled">Hapus</button>
                        <button class="btn btn-warning btn-sm disabled">Upload Ijazah</button>
                        <button class="btn btn-warning btn-sm disabled">Upload Transkrip</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>#</th>
                                    <th>Akhir</th>
                                    <th>Institusi</th>
                                    <th>Jurusan</th>
                                    <th>IPK</th>
                                    <th>Ijazah</th>
                                    <th>Transkrip</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="8" class="text-center">No data available in table</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Row: Riwayat Lamaran -->
    <div class="row">
        <div class="col-12">
            <div class="card-custom">
                <div class="card-header bg-white border-bottom">
                    <h3 class="card-title"><i class="fas fa-history mr-1"></i> Riwayat Lamaran</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Daftar Lamaran yang sudah diapply
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-danger btn-sm">Batal</button>
                        <button class="btn btn-warning btn-sm">Cetak</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Faskes</th>
                                    <th>Tanggal</th>
                                    <th>Bagian</th>
                                    <th>Ijazah</th>
                                    <th>No Apply</th>
                                    <th>Salary</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="8" class="text-center text-danger">Showing 0 to 0 of 0 entries</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
