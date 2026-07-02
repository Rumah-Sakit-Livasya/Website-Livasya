@extends('inc.layout')

@section('title', 'Detail Pelamar - ' . $applier->first_name . ' ' . $applier->last_name)

@section('content')
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon bx bxs-user-detail text-primary'></i> Detail Pelamar: {{ $applier->first_name }} {{ $applier->last_name }}
            <small>
                Posisi yang dilamar: {{ $career->title }}
            </small>
        </h1>
        <div class="subheader-block">
            <a href="{{ route('hrd.appliers', $career->id) }}" class="btn btn-sm btn-outline-secondary font-weight-bold">
                <i class="fal fa-arrow-left mr-1"></i> Kembali ke Daftar Pelamar
            </a>
        </div>
    </div>

    @php
        $avatar = $applier->user?->avatar;
        $avatarUrl = asset('img/no-image.png');
        if ($avatar) {
            $avatarUrl = \Illuminate\Support\Str::startsWith($avatar, ['http://','https://'])
                ? $avatar
                : asset('storage/' . $avatar);
        }
        $wa = $applier->whatsapp_number ?? '';
        if ($wa && substr($wa,0,1) == '0') $wa = '62'.substr($wa,1);
        $waMsg = "Halo {$applier->first_name}, kami dari HRD RS Livasya terkait lamaran Anda untuk posisi {$career->title}.";
    @endphp

    <div class="row">
        {{-- ── Left Sidebar: Profil & Aksi Cepat ── --}}
        <div class="col-lg-4 col-xl-3">
            {{-- Profile & Status Card --}}
            <div class="card p-3 mb-g shadow-xs text-center border-light-blue bg-white">
                <div class="position-relative d-inline-block mx-auto mb-3">
                    <img src="{{ $avatarUrl }}" class="rounded-circle img-thumbnail shadow-xs" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #e5e7eb;" alt="{{ $applier->first_name }}">
                </div>
                <h4 class="font-weight-bold text-dark mb-1 fs-lg">
                    {{ strtoupper($applier->first_name) }} {{ strtoupper($applier->last_name) }}
                </h4>
                <div class="text-muted fs-xs mb-3 font-weight-semibold">
                    {{ $applier->birth_place ?? '-' }}, {{ $applier->birth_day ? \Carbon\Carbon::parse($applier->birth_day)->age . ' Tahun' : '-' }}
                </div>
                
                <span class="badge badge-primary px-3 py-2 mx-auto font-weight-bold mb-3" style="border-radius: 4px; font-size: 0.8rem; width: fit-content;">
                    {{ $career->title }}
                </span>

                <div class="mb-3">
                    @if($applier->status == 'processed')
                        <span class="badge badge-warning px-3 py-1 font-weight-bold" style="border-radius: 4px; font-size: 0.75rem;"><i class="fal fa-clock mr-1"></i>Diproses</span>
                    @elseif($applier->status == 'interview_1')
                        <span class="badge badge-info px-3 py-1 font-weight-bold" style="border-radius: 4px; font-size: 0.75rem;"><i class="fal fa-comments mr-1"></i>Wawancara 1</span>
                    @elseif($applier->status == 'interview_2')
                        <span class="badge badge-warning px-3 py-1 text-white bg-warning-800 font-weight-bold" style="border-radius: 4px; font-size: 0.75rem;"><i class="fal fa-user-shield mr-1"></i>Wawancara 2</span>
                    @elseif($applier->status == 'accepted')
                        <span class="badge badge-success px-3 py-1 font-weight-bold" style="border-radius: 4px; font-size: 0.75rem;"><i class="fal fa-check mr-1"></i>Diterima</span>
                    @elseif($applier->status == 'rejected')
                        <span class="badge badge-danger px-3 py-1 font-weight-bold" style="border-radius: 4px; font-size: 0.75rem;"><i class="fal fa-times mr-1"></i>Ditolak</span>
                    @endif
                </div>

                {{-- Ubah Status Langsung di Profil Card --}}
                @if($applier->status == 'processed')
                    <hr class="my-3">
                    <div class="d-grid gap-2">
                        <button type="button"
                            class="btn btn-success btn-block font-weight-bold btn-terima-hrd"
                            data-name="{{ $applier->first_name }} {{ $applier->last_name }}"
                            data-action-url="{{ route('hrd.status', [$career->id, $applier->id]) }}">
                            <i class="fal fa-check-circle mr-1"></i> Terima Berkas
                        </button>

                        <form action="{{ route('hrd.status', [$career->id, $applier->id]) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-danger btn-block font-weight-bold js-confirm" data-msg="Tolak berkas administrasi pelamar ini?">
                                <i class="fal fa-times-circle mr-1"></i> Tolak Berkas
                            </button>
                        </form>
                    </div>
                @elseif($applier->status == 'interview_1')
                    <hr class="my-3">
                    <div class="d-grid gap-2">
                        <a href="{{ route('hrd.interview.form', [$career->id, $applier->id]) }}" class="btn btn-warning btn-block font-weight-bold text-white">
                            <i class="fal fa-comments mr-1"></i> Form Wawancara 1
                        </a>
                    </div>
                @elseif($applier->status == 'interview_2')
                    <hr class="my-3">
                    <div class="d-grid gap-2">
                        <a href="{{ route('hrd.interview.form', [$career->id, $applier->id]) }}" class="btn bg-warning-800 btn-block font-weight-bold text-white">
                            <i class="fal fa-user-shield mr-1"></i> Form Wawancara 2
                        </a>
                    </div>
                @elseif(in_array($applier->status, ['accepted', 'rejected']) && $applier->interview)
                    <hr class="my-3">
                    <div class="d-grid gap-2">
                        <a href="{{ route('hrd.interview.form', [$career->id, $applier->id]) }}" class="btn btn-outline-secondary btn-block font-weight-bold">
                            <i class="fal fa-file-invoice mr-1"></i> Hasil Wawancara
                        </a>
                    </div>
                @endif
            </div>

            {{-- Kontak & Berkas Card --}}
            <div class="card mb-g shadow-xs border-light-blue bg-white">
                <div class="card-header bg-faded py-2 font-weight-bold d-flex align-items-center">
                    <i class="fal fa-address-card mr-2 text-primary"></i> Kontak & Dokumen
                </div>
                <div class="card-body p-3">
                    <!-- Email -->
                    <div class="mb-2 text-wrap">
                        <small class="text-muted font-weight-bold d-block">EMAIL</small>
                        <a href="mailto:{{ $applier->email }}" class="font-weight-bold text-primary fs-sm">{{ $applier->email }}</a>
                    </div>
                    <!-- WhatsApp -->
                    <div class="mb-2">
                        <small class="text-muted font-weight-bold d-block">WHATSAPP</small>
                        @if($wa)
                            <a href="https://wa.me/{{ $wa }}?text={{ urlencode($waMsg) }}" target="_blank" class="font-weight-bold text-success fs-sm">
                                {{ $applier->whatsapp_number }}
                            </a>
                        @else
                            <span class="text-muted fs-sm">-</span>
                        @endif
                    </div>
                    <!-- NIK -->
                    <div class="mb-3">
                        <small class="text-muted font-weight-bold d-block">NIK (KTP)</small>
                        <span class="font-weight-bold text-dark fs-sm">{{ $applier->id_card ?? '-' }}</span>
                    </div>

                    <hr class="my-3">

                    <!-- Berkas Download -->
                    <div class="d-grid gap-2">
                        @if($applier->cv)
                            <a href="{{ route('hrd.download', [$career->id, $applier->id, 'cv']) }}" class="btn btn-sm btn-outline-danger btn-block font-weight-bold mb-2" target="_blank">
                                <i class="fal fa-file-pdf mr-1"></i> Download CV
                            </a>
                        @else
                            <button class="btn btn-sm btn-light btn-block font-weight-bold mb-2 text-muted" disabled>
                                <i class="fal fa-file-pdf mr-1"></i> CV Tidak Tersedia
                            </button>
                        @endif

                        @if($applier->attachment)
                            <a href="{{ route('hrd.download', [$career->id, $applier->id, 'attachment']) }}" class="btn btn-sm btn-outline-primary btn-block font-weight-bold mb-3" target="_blank">
                                <i class="fal fa-file-alt mr-1"></i> Download Surat Lamaran
                            </a>
                        @else
                            <button class="btn btn-sm btn-light btn-block font-weight-bold mb-3 text-muted" disabled>
                                <i class="fal fa-file-alt mr-1"></i> Surat Tidak Tersedia
                            </button>
                        @endif

                        @if($wa)
                            <a href="https://wa.me/{{ $wa }}?text={{ urlencode($waMsg) }}" target="_blank" class="btn btn-success btn-block font-weight-bold text-white">
                                <i class="fab fa-whatsapp mr-1"></i> Hubungi via WhatsApp
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <a href="{{ route('hrd.appliers', $career->id) }}" class="btn btn-light btn-block font-weight-bold border shadow-xs mb-g">
                <i class="fal fa-arrow-left mr-1"></i> Kembali ke Daftar
            </a>
        </div>

        {{-- ── Right Content: Detail Profil Lengkap ── --}}
        <div class="col-lg-8 col-xl-9">
            {{-- Data Diri & Ekspektasi --}}
            <div id="panel-biodata" class="panel shadow-sm">
                <div class="panel-hdr bg-faded">
                    <h2><i class="fal fa-user mr-2 text-primary"></i> Data Diri & Ekspektasi</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            {{-- Kolom Kiri --}}
                            <div class="col-md-6 border-right-md">
                                <div class="row mb-2">
                                    <div class="col-5 text-muted font-weight-semibold fs-sm">Nama Lengkap</div>
                                    <div class="col-7 text-dark font-weight-bold fs-sm">{{ $applier->first_name }} {{ $applier->last_name }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted font-weight-semibold fs-sm">Jenis Kelamin</div>
                                    <div class="col-7 text-dark font-weight-bold fs-sm">{{ $applier->sex ?? '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted font-weight-semibold fs-sm">Tempat Lahir</div>
                                    <div class="col-7 text-dark font-weight-bold fs-sm">{{ $applier->birth_place ?? '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted font-weight-semibold fs-sm">Tanggal Lahir</div>
                                    <div class="col-7 text-dark font-weight-bold fs-sm">{{ $applier->birth_day ? \Carbon\Carbon::parse($applier->birth_day)->translatedFormat('d F Y') : '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted font-weight-semibold fs-sm">Agama</div>
                                    <div class="col-7 text-dark font-weight-bold fs-sm">{{ $applier->religion ?? '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted font-weight-semibold fs-sm">Suku</div>
                                    <div class="col-7 text-dark font-weight-bold fs-sm">{{ $applier->suku ?? '-' }}</div>
                                </div>
                            </div>
                            
                            {{-- Kolom Kanan --}}
                            <div class="col-md-6 pl-md-4">
                                <div class="row mb-2">
                                    <div class="col-5 text-muted font-weight-semibold fs-sm">Status Menikah</div>
                                    <div class="col-7 text-dark font-weight-bold fs-sm">{{ $applier->marital_status ?? '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted font-weight-semibold fs-sm">Kewarganegaraan</div>
                                    <div class="col-7 text-dark font-weight-bold fs-sm">{{ $applier->nationality ?? '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted font-weight-semibold fs-sm">NPWP</div>
                                    <div class="col-7 text-dark font-weight-bold fs-sm">{{ $applier->npwp ?? '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted font-weight-semibold fs-sm">Posisi yang Dilamar</div>
                                    <div class="col-7 text-dark font-weight-bold fs-sm">{{ $applier->position_interest ?? $career->title }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted font-weight-semibold fs-sm">Ekspektasi Gaji</div>
                                    <div class="col-7 text-primary font-weight-bold fs-sm">{{ $applier->compensation_salary ? 'Rp '.number_format($applier->compensation_salary,0,',','.') : '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted font-weight-semibold fs-sm">Mulai Bekerja</div>
                                    <div class="col-7 text-dark font-weight-bold fs-sm">{{ $applier->compensation_workdate ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <!-- Alamat -->
                        <div class="row mb-2">
                            <div class="col-md-2 text-muted font-weight-semibold fs-sm">Alamat KTP</div>
                            <div class="col-md-10 text-dark font-weight-bold fs-sm">{{ $applier->ktp_address ?? '-' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2 text-muted font-weight-semibold fs-sm">Alamat Domisili</div>
                            <div class="col-md-10 text-dark font-weight-bold fs-sm">{{ $applier->permanent_address ?? '-' }}</div>
                        </div>

                        @if($applier->about_me)
                            <div class="bg-light p-3 rounded border text-wrap">
                                <small class="text-muted font-weight-bold d-block mb-1">TENTANG SAYA</small>
                                <div class="text-dark fs-sm" style="white-space: pre-line; line-height: 1.5;">{{ $applier->about_me }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Riwayat Pendidikan --}}
            <div id="panel-pendidikan" class="panel shadow-sm">
                <div class="panel-hdr bg-faded">
                    <h2><i class="fal fa-graduation-cap mr-2 text-primary"></i> Riwayat Pendidikan</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        @if($educations->isEmpty())
                            <p class="text-muted mb-0 py-2 fs-sm text-center"><i class="fal fa-info-circle mr-1"></i> Tidak ada data riwayat pendidikan.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-striped m-0">
                                    <thead class="bg-primary-50">
                                        <tr>
                                            <th>Nama Sekolah/Institusi</th>
                                            <th>Jurusan</th>
                                            <th class="text-center" style="width: 100px;">Jenjang</th>
                                            <th class="text-center" style="width: 120px;">Tahun Lulus</th>
                                            <th class="text-center" style="width: 100px;">IPK/Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($educations as $edu)
                                        <tr>
                                            <td class="font-weight-bold text-dark">{{ $edu->institution ?? '-' }}</td>
                                            <td>{{ $edu->major ?? '-' }}</td>
                                            <td class="text-center"><span class="badge badge-light border">{{ $edu->level ?? '-' }}</span></td>
                                            <td class="text-center">{{ $edu->graduation_year ?? '-' }}</td>
                                            <td class="text-center font-weight-bold text-primary">{{ $edu->gpa ?? '-' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Pengalaman Kerja --}}
            <div id="panel-pekerjaan" class="panel shadow-sm">
                <div class="panel-hdr bg-faded">
                    <h2><i class="fal fa-briefcase mr-2 text-primary"></i> Pengalaman Kerja</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        @if($works->isEmpty())
                            <p class="text-muted mb-0 py-2 fs-sm text-center"><i class="fal fa-info-circle mr-1"></i> Tidak ada data pengalaman kerja.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-striped m-0">
                                    <thead class="bg-primary-50">
                                        <tr>
                                            <th>Nama Perusahaan</th>
                                            <th>Jabatan/Posisi</th>
                                            <th class="text-center" style="width: 120px;">Tanggal Mulai</th>
                                            <th class="text-center" style="width: 120px;">Tanggal Selesai</th>
                                            <th>Keterangan Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($works as $work)
                                        <tr>
                                            <td class="font-weight-bold text-dark">{{ $work->work_name ?? $work->company_name ?? '-' }}</td>
                                            <td>{{ $work->work_position ?? $work->position ?? '-' }}</td>
                                            <td class="text-center">{{ $work->work_start ?? $work->start_date ?? '-' }}</td>
                                            <td class="text-center">
                                                @if(empty($work->work_end) || $work->work_end == 'Sekarang' || $work->end_date == 'Sekarang')
                                                    <span class="badge badge-success">Sekarang</span>
                                                @else
                                                    {{ $work->work_end ?? $work->end_date }}
                                                @endif
                                            </td>
                                            <td class="text-muted" style="font-size: 0.82rem;">{{ $work->description ?? '-' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Sertifikasi & Pelatihan --}}
            @if($certifications->isNotEmpty())
            <div id="panel-sertifikat" class="panel shadow-sm">
                <div class="panel-hdr bg-faded">
                    <h2><i class="fal fa-certificate mr-2 text-primary"></i> Sertifikasi / Pelatihan</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm table-striped m-0">
                                <thead class="bg-primary-50">
                                    <tr>
                                        <th>Nama Sertifikat / Pelatihan</th>
                                        <th>Penyelenggara / Lembaga</th>
                                        <th class="text-center" style="width: 110px;">Tahun</th>
                                        <th class="text-center" style="width: 100px;">Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($certifications as $cert)
                                    <tr>
                                        <td class="font-weight-bold text-dark">{{ $cert->certification_name ?? $cert->name ?? '-' }}</td>
                                        <td>{{ $cert->institution ?? '-' }}</td>
                                        <td class="text-center">{{ $cert->year ?? '-' }}</td>
                                        <td class="text-center">
                                            @if(!empty($cert->file))
                                                <a href="{{ asset('storage/' . $cert->file) }}" target="_blank" class="btn btn-xs btn-outline-danger">
                                                    <i class="fal fa-file-pdf"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-muted fs-xs">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- STR / Lisensi Profesi --}}
            @if($licenses->isNotEmpty())
            <div id="panel-lisensi" class="panel shadow-sm">
                <div class="panel-hdr bg-faded">
                    <h2><i class="fal fa-id-badge mr-2 text-primary"></i> STR / Lisensi Profesi</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm table-striped m-0">
                                <thead class="bg-primary-50">
                                    <tr>
                                        <th>Jenis Lisensi</th>
                                        <th>Nomor Lisensi</th>
                                        <th class="text-center" style="width: 140px;">Berlaku Hingga</th>
                                        <th class="text-center" style="width: 100px;">Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($licenses as $lic)
                                    <tr>
                                        <td class="font-weight-bold text-dark">{{ $lic->type ?? '-' }}</td>
                                        <td class="font-weight-mono">{{ $lic->number ?? '-' }}</td>
                                        <td class="text-center">{{ $lic->expiry_date ?? $lic->end_date ?? '-' }}</td>
                                        <td class="text-center">
                                            @if(!empty($lic->file))
                                                <a href="{{ asset('storage/' . $lic->file) }}" target="_blank" class="btn btn-xs btn-outline-danger">
                                                    <i class="fal fa-file-pdf"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-muted fs-xs">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Kemampuan Bahasa --}}
            @if($languages->isNotEmpty())
            <div id="panel-bahasa" class="panel shadow-sm">
                <div class="panel-hdr bg-faded">
                    <h2><i class="fal fa-language mr-2 text-primary"></i> Kemampuan Bahasa</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm table-striped m-0">
                                <thead class="bg-primary-50">
                                    <tr>
                                        <th>Bahasa</th>
                                        <th class="text-center" style="width: 150px;">Kemampuan Membaca</th>
                                        <th class="text-center" style="width: 150px;">Kemampuan Menulis</th>
                                        <th class="text-center" style="width: 150px;">Kemampuan Berbicara</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($languages as $lang)
                                    <tr>
                                        <td class="font-weight-bold text-dark">{{ $lang->language ?? '-' }}</td>
                                        <td class="text-center">{{ $lang->reading ?? '-' }}</td>
                                        <td class="text-center">{{ $lang->writing ?? '-' }}</td>
                                        <td class="text-center">{{ $lang->speaking ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Beasiswa / Penghargaan --}}
            @if($scholarships->isNotEmpty())
            <div id="panel-beasiswa" class="panel shadow-sm">
                <div class="panel-hdr bg-faded">
                    <h2><i class="fal fa-award mr-2 text-primary"></i> Beasiswa / Penghargaan</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm table-striped m-0">
                                <thead class="bg-primary-50">
                                    <tr>
                                        <th>Nama Penghargaan / Beasiswa</th>
                                        <th>Lembaga Pemberi</th>
                                        <th class="text-center" style="width: 120px;">Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($scholarships as $sch)
                                    <tr>
                                        <td class="font-weight-bold text-dark">{{ $sch->name ?? '-' }}</td>
                                        <td>{{ $sch->institution ?? '-' }}</td>
                                        <td class="text-center">{{ $sch->year ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</main>
@endsection

{{-- Modal Jadwal Wawancara --}}
<div class="modal fade" id="modalJadwalWawarcaraHrd" tabindex="-1" role="dialog" aria-labelledby="modalJadwalHrdLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalJadwalHrdLabel">📅 Jadwal Wawancara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formJadwalHrd" method="POST">
                @csrf @method('PUT')
                <input type="hidden" name="status" value="accepted">
                <div class="modal-body">
                    <p class="text-muted mb-3">Pelamar: <strong id="hrdModalApplierName"></strong></p>

                    <div class="form-group">
                        <label for="hrd_interview_date">Tanggal Wawancara <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="hrd_interview_date" name="interview_date" required>
                    </div>

                    <div class="form-group">
                        <label for="hrd_interview_time">Waktu Wawancara <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="hrd_interview_time" name="interview_time" required>
                    </div>

                    <div class="form-group">
                        <label for="hrd_interview_type">Jenis Wawancara <span class="text-danger">*</span></label>
                        <select class="form-control" id="hrd_interview_type" name="interview_type" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="online">Online (Video Conference)</option>
                            <option value="offline">Offline / Tatap Muka</option>
                        </select>
                    </div>

                    <div class="form-group" id="hrdLocationGroup">
                        <label for="hrd_interview_location" id="hrdLocationLabel">Lokasi / Keterangan</label>
                        <input type="text" class="form-control" id="hrd_interview_location" name="interview_location"
                            placeholder="Contoh: Gedung A Lt. 3 atau link akan dikirim via email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fal fa-check"></i> Kirim Undangan &amp; Terima
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@section('scripts')
<script nonce="{{ $nonce }}">
$(document).on('click', '.js-confirm', function(e) {
    e.preventDefault();
    const $btn = $(this);
    Swal.fire({
        title: $btn.data('msg'),
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#1a56db',
    }).then(result => {
        if (result.isConfirmed) $btn.closest('form').submit();
    });
});

// Tombol Terima Berkas HRD -> buka modal jadwal
$(document).on('click', '.btn-terima-hrd', function() {
    var name   = $(this).data('name');
    var action = $(this).data('action-url');

    $('#hrdModalApplierName').text(name);
    $('#formJadwalHrd').attr('action', action);

    // Reset form fields
    $('#hrd_interview_date').val('');
    $('#hrd_interview_time').val('');
    $('#hrd_interview_type').val('');
    $('#hrd_interview_location').val('');
    updateHrdLocationLabel('');

    $('#modalJadwalWawarcaraHrd').modal('show');
});

$(document).on('change', '#hrd_interview_type', function() {
    updateHrdLocationLabel($(this).val());
});

function updateHrdLocationLabel(type) {
    if (type === 'online') {
        $('#hrdLocationLabel').text('Keterangan Tambahan (opsional)');
        $('#hrd_interview_location').attr('placeholder', 'Mis. silakan test kamera sebelum sesi');
    } else if (type === 'offline') {
        $('#hrdLocationLabel').text('Lokasi / Alamat Wawancara');
        $('#hrd_interview_location').attr('placeholder', 'Mis. Gedung A Lt. 3, Jl. Sudirman No.1');
    } else {
        $('#hrdLocationLabel').text('Lokasi / Keterangan');
        $('#hrd_interview_location').attr('placeholder', 'Contoh: Gedung A Lt. 3 atau link akan dikirim via email');
    }
}
</script>
@endsection
