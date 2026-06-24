@extends('hrd.layout')

@section('breadcrumb')
    <div class="hrd-breadcrumb">
        <i class="fal fa-home"></i>
        <a href="{{ route('hrd.index') }}">Dashboard HRD</a>
        <span>/</span>
        <a href="{{ route('hrd.appliers', $career->id) }}">{{ $career->title }}</a>
        <span>/</span>
        <span>{{ $applier->first_name }} {{ $applier->last_name }}</span>
    </div>
@endsection

@section('content')
<style nonce="{{ $nonce }}">
    .detail-card {
        background: #fff; border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 6px rgba(0,0,0,.07);
        overflow: hidden; margin-bottom: 1.25rem;
    }
    .detail-card-header {
        padding: .85rem 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        background: #f9fafb;
        font-weight: 700; font-size: .9rem; color: #374151;
        display: flex; align-items: center; gap: .5rem;
    }
    .detail-card-header i { color: #1a56db; }
    .detail-card-body { padding: 1.25rem; }

    .info-row { display: flex; padding: .55rem 0; border-bottom: 1px solid #f3f4f6; font-size: .875rem; }
    .info-row:last-child { border-bottom: none; }
    .info-label { min-width: 170px; color: #6b7280; font-weight: 500; flex-shrink: 0; }
    .info-value { color: #111827; font-weight: 400; }

    .doc-btn {
        display: inline-flex; align-items: center; gap: .45rem;
        border-radius: 9px; padding: .55rem 1.1rem;
        font-size: .85rem; font-weight: 600; text-decoration: none;
        transition: opacity .2s, transform .15s; border: none; cursor: pointer;
    }
    .doc-btn:hover { opacity: .88; transform: translateY(-1px); }
    .doc-pdf   { background: #fef2f2; color: #dc2626; }
    .doc-word  { background: #eff6ff; color: #1a56db; }
    .doc-na    { background: #f3f4f6; color: #9ca3af; cursor: not-allowed; }

    .badge-status {
        display: inline-flex; align-items: center; gap: .35rem;
        border-radius: 50px; padding: .3rem .85rem; font-size: .8rem; font-weight: 600;
    }
    .badge-processed { background: #fffbeb; color: #d97706; }
    .badge-accepted  { background: #f0fdf4; color: #16a34a; }
    .badge-rejected  { background: #fff1f2; color: #e11d48; }

    .profile-photo {
        width: 110px; height: 110px; border-radius: 50%;
        object-fit: cover; border: 3px solid #e5e7eb;
    }

    .section-title {
        font-size: 1rem; font-weight: 700; color: #111827;
        border-left: 3px solid #1a56db; padding-left: .65rem; margin-bottom: .85rem;
    }

    .action-btn {
        display: inline-flex; align-items: center; gap: .35rem;
        border-radius: 8px; padding: .5rem 1rem;
        font-size: .85rem; font-weight: 600; text-decoration: none;
        border: none; cursor: pointer; transition: opacity .2s;
    }
    .action-btn:hover { opacity: .88; }
    .btn-accept { background: #f0fdf4; color: #16a34a; }
    .btn-reject { background: #fff1f2; color: #e11d48; }
    .btn-back   { background: #f3f4f6; color: #374151; }

    .tag-list { display: flex; flex-wrap: wrap; gap: .4rem; }
    .tag {
        background: #eff6ff; color: #1a56db;
        border-radius: 6px; padding: .25rem .6rem;
        font-size: .78rem; font-weight: 500;
    }

    table.inner-table { width: 100%; font-size: .82rem; }
    table.inner-table th { background:#f9fafb; padding: .5rem .75rem; font-weight:600; color:#6b7280; text-transform:uppercase; font-size:.73rem; }
    table.inner-table td { padding: .55rem .75rem; border-top: 1px solid #f3f4f6; }
</style>

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

<div class="row g-4">
    {{-- ── Left Sidebar ── --}}
    <div class="col-lg-3">
        {{-- Profile Card --}}
        <div class="detail-card">
            <div class="detail-card-body text-center" style="padding:1.75rem 1.25rem;">
                <img src="{{ $avatarUrl }}" class="profile-photo mb-3" alt="{{ $applier->first_name }}">
                <h5 style="font-weight:800;font-size:1.05rem;margin-bottom:.2rem">
                    {{ strtoupper($applier->first_name) }} {{ strtoupper($applier->last_name) }}
                </h5>
                <div style="font-size:.82rem;color:#6b7280;margin-bottom:.75rem">
                    {{ $applier->birth_place }},
                    {{ $applier->birth_day ? \Carbon\Carbon::parse($applier->birth_day)->age . ' Tahun' : '-' }}
                </div>
                <span style="background:#eff6ff;color:#1a56db;border-radius:50px;padding:.25rem .75rem;font-size:.78rem;font-weight:600;">
                    {{ $career->title }}
                </span>
                <div class="mt-3">
                    @if($applier->status == 'processed')
                        <span class="badge-status badge-processed"><i class="fal fa-clock"></i> Diproses</span>
                    @elseif($applier->status == 'accepted')
                        <span class="badge-status badge-accepted"><i class="fal fa-check"></i> Diterima</span>
                    @elseif($applier->status == 'rejected')
                        <span class="badge-status badge-rejected"><i class="fal fa-times"></i> Ditolak</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kontak --}}
        <div class="detail-card">
            <div class="detail-card-header"><i class="fal fa-address-card"></i> Kontak</div>
            <div class="detail-card-body">
                <div class="info-row">
                    <div class="info-label"><i class="fal fa-envelope mr-1"></i> Email</div>
                    <div class="info-value"><a href="mailto:{{ $applier->email }}" style="color:#1a56db">{{ $applier->email }}</a></div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fal fa-mobile-alt mr-1"></i> WhatsApp</div>
                    <div class="info-value">
                        @if($wa)
                            <a href="https://wa.me/{{ $wa }}?text={{ urlencode($waMsg) }}" target="_blank" style="color:#16a34a">
                                {{ $applier->whatsapp_number }}
                            </a>
                        @else -
                        @endif
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="fal fa-id-card mr-1"></i> NIK</div>
                    <div class="info-value">{{ $applier->id_card ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- Dokumen --}}
        <div class="detail-card">
            <div class="detail-card-header"><i class="fal fa-folder-open"></i> Dokumen</div>
            <div class="detail-card-body d-grid gap-2">
                @if($applier->cv)
                    <a href="{{ route('hrd.download', [$career->id, $applier->id, 'cv']) }}" class="doc-btn doc-pdf" target="_blank">
                        <i class="fal fa-file-pdf"></i> Download CV
                    </a>
                @else
                    <span class="doc-btn doc-na"><i class="fal fa-file-pdf"></i> CV Tidak Tersedia</span>
                @endif

                @if($applier->attachment)
                    <a href="{{ route('hrd.download', [$career->id, $applier->id, 'attachment']) }}" class="doc-btn doc-word" target="_blank">
                        <i class="fal fa-file-alt"></i> Download Surat Lamaran
                    </a>
                @else
                    <span class="doc-btn doc-na"><i class="fal fa-file-alt"></i> Surat Tidak Tersedia</span>
                @endif

                @if($wa)
                    <a href="https://wa.me/{{ $wa }}?text={{ urlencode($waMsg) }}" target="_blank" class="doc-btn" style="background:#f0fdf4;color:#16a34a;">
                        <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                    </a>
                @endif
            </div>
        </div>

        {{-- Status Update --}}
        @if($applier->status == 'processed')
        <div class="detail-card">
            <div class="detail-card-header"><i class="fal fa-cog"></i> Ubah Status</div>
            <div class="detail-card-body d-grid gap-2">
                <form action="{{ route('hrd.status', [$career->id, $applier->id]) }}" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" name="status" value="accepted">
                    <button type="submit" class="action-btn btn-accept w-100 js-confirm" data-msg="Terima pelamar ini?">
                        <i class="fal fa-check-circle"></i> Terima Pelamar
                    </button>
                </form>
                <form action="{{ route('hrd.status', [$career->id, $applier->id]) }}" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="action-btn btn-reject w-100 js-confirm" data-msg="Tolak pelamar ini?">
                        <i class="fal fa-times-circle"></i> Tolak Pelamar
                    </button>
                </form>
            </div>
        </div>
        @endif

        <a href="{{ route('hrd.appliers', $career->id) }}" class="action-btn btn-back d-flex justify-content-center">
            <i class="fal fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    {{-- ── Right Content ── --}}
    <div class="col-lg-9">
        {{-- Data Diri --}}
        <div class="detail-card">
            <div class="detail-card-header"><i class="fal fa-user"></i> Data Diri</div>
            <div class="detail-card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-row"><div class="info-label">Nama Lengkap</div><div class="info-value">{{ $applier->first_name }} {{ $applier->last_name }}</div></div>
                        <div class="info-row"><div class="info-label">Jenis Kelamin</div><div class="info-value">{{ $applier->sex ?? '-' }}</div></div>
                        <div class="info-row"><div class="info-label">Tempat Lahir</div><div class="info-value">{{ $applier->birth_place ?? '-' }}</div></div>
                        <div class="info-row"><div class="info-label">Tanggal Lahir</div><div class="info-value">{{ $applier->birth_day ? \Carbon\Carbon::parse($applier->birth_day)->translatedFormat('d F Y') : '-' }}</div></div>
                        <div class="info-row"><div class="info-label">Agama</div><div class="info-value">{{ $applier->religion ?? '-' }}</div></div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-row"><div class="info-label">Status Menikah</div><div class="info-value">{{ $applier->marital_status ?? '-' }}</div></div>
                        <div class="info-row"><div class="info-label">Kewarganegaraan</div><div class="info-value">{{ $applier->nationality ?? '-' }}</div></div>
                        <div class="info-row"><div class="info-label">Suku</div><div class="info-value">{{ $applier->suku ?? '-' }}</div></div>
                        <div class="info-row"><div class="info-label">NPWP</div><div class="info-value">{{ $applier->npwp ?? '-' }}</div></div>
                        <div class="info-row"><div class="info-label">Posisi yang Dilamar</div><div class="info-value">{{ $applier->position_interest ?? $career->title }}</div></div>
                    </div>
                </div>
                <div class="info-row"><div class="info-label">Alamat KTP</div><div class="info-value">{{ $applier->ktp_address ?? '-' }}</div></div>
                <div class="info-row"><div class="info-label">Alamat Domisili</div><div class="info-value">{{ $applier->permanent_address ?? '-' }}</div></div>
                @if($applier->about_me)
                <div class="info-row flex-column">
                    <div class="info-label mb-1">Tentang Saya</div>
                    <div class="info-value" style="white-space:pre-line;color:#374151">{{ $applier->about_me }}</div>
                </div>
                @endif
            </div>
        </div>

        {{-- Pendidikan --}}
        <div class="detail-card">
            <div class="detail-card-header"><i class="fal fa-graduation-cap"></i> Riwayat Pendidikan</div>
            <div class="detail-card-body">
                @if($educations->isEmpty())
                    <p class="text-muted mb-0" style="font-size:.85rem">Tidak ada data pendidikan.</p>
                @else
                    <table class="inner-table">
                        <thead><tr><th>Institusi</th><th>Jurusan</th><th>Jenjang</th><th>Tahun Lulus</th><th>IPK/Nilai</th></tr></thead>
                        <tbody>
                            @foreach($educations as $edu)
                            <tr>
                                <td>{{ $edu->school_name ?? '-' }}</td>
                                <td>{{ $edu->major ?? '-' }}</td>
                                <td>{{ $edu->degree ?? '-' }}</td>
                                <td>{{ $edu->graduation_year ?? '-' }}</td>
                                <td>{{ $edu->gpa ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        {{-- Pengalaman Kerja --}}
        <div class="detail-card">
            <div class="detail-card-header"><i class="fal fa-briefcase"></i> Pengalaman Kerja</div>
            <div class="detail-card-body">
                @if($works->isEmpty())
                    <p class="text-muted mb-0" style="font-size:.85rem">Tidak ada data pengalaman kerja.</p>
                @else
                    <table class="inner-table">
                        <thead><tr><th>Perusahaan</th><th>Jabatan</th><th>Mulai</th><th>Selesai</th><th>Keterangan</th></tr></thead>
                        <tbody>
                            @foreach($works as $work)
                            <tr>
                                <td>{{ $work->company_name ?? '-' }}</td>
                                <td>{{ $work->position ?? '-' }}</td>
                                <td>{{ $work->start_date ?? '-' }}</td>
                                <td>{{ $work->end_date ?? 'Sekarang' }}</td>
                                <td>{{ $work->description ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        {{-- Sertifikasi --}}
        @if($certifications->isNotEmpty())
        <div class="detail-card">
            <div class="detail-card-header"><i class="fal fa-certificate"></i> Sertifikasi / Pelatihan</div>
            <div class="detail-card-body">
                <table class="inner-table">
                    <thead><tr><th>Nama Sertifikat</th><th>Lembaga</th><th>Tahun</th><th>Dokumen</th></tr></thead>
                    <tbody>
                        @foreach($certifications as $cert)
                        <tr>
                            <td>{{ $cert->name ?? '-' }}</td>
                            <td>{{ $cert->institution ?? '-' }}</td>
                            <td>{{ $cert->year ?? '-' }}</td>
                            <td>
                                @if(!empty($cert->file))
                                    <a href="{{ asset('storage/' . $cert->file) }}" target="_blank" class="doc-btn doc-pdf" style="padding:.2rem .6rem;font-size:.75rem;">
                                        <i class="fal fa-file-pdf"></i> Lihat
                                    </a>
                                @else
                                    <span style="font-size:.78rem;color:#9ca3af">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- STR / Lisensi --}}
        @if($licenses->isNotEmpty())
        <div class="detail-card">
            <div class="detail-card-header"><i class="fal fa-id-badge"></i> STR / Lisensi Profesi</div>
            <div class="detail-card-body">
                <table class="inner-table">
                    <thead><tr><th>Jenis</th><th>Nomor</th><th>Berlaku Hingga</th><th>Dokumen</th></tr></thead>
                    <tbody>
                        @foreach($licenses as $lic)
                        <tr>
                            <td>{{ $lic->type ?? '-' }}</td>
                            <td>{{ $lic->number ?? '-' }}</td>
                            <td>{{ $lic->expiry_date ?? '-' }}</td>
                            <td>
                                @if(!empty($lic->file))
                                    <a href="{{ asset('storage/' . $lic->file) }}" target="_blank" class="doc-btn doc-pdf" style="padding:.2rem .6rem;font-size:.75rem;">
                                        <i class="fal fa-file-pdf"></i> Lihat
                                    </a>
                                @else
                                    <span style="font-size:.78rem;color:#9ca3af">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- Bahasa --}}
        @if($languages->isNotEmpty())
        <div class="detail-card">
            <div class="detail-card-header"><i class="fal fa-language"></i> Kemampuan Bahasa</div>
            <div class="detail-card-body">
                <table class="inner-table">
                    <thead><tr><th>Bahasa</th><th>Membaca</th><th>Menulis</th><th>Berbicara</th></tr></thead>
                    <tbody>
                        @foreach($languages as $lang)
                        <tr>
                            <td>{{ $lang->language ?? '-' }}</td>
                            <td>{{ $lang->reading ?? '-' }}</td>
                            <td>{{ $lang->writing ?? '-' }}</td>
                            <td>{{ $lang->speaking ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- Beasiswa --}}
        @if($scholarships->isNotEmpty())
        <div class="detail-card">
            <div class="detail-card-header"><i class="fal fa-award"></i> Beasiswa / Penghargaan</div>
            <div class="detail-card-body">
                <table class="inner-table">
                    <thead><tr><th>Nama</th><th>Pemberi</th><th>Tahun</th></tr></thead>
                    <tbody>
                        @foreach($scholarships as $sch)
                        <tr>
                            <td>{{ $sch->name ?? '-' }}</td>
                            <td>{{ $sch->institution ?? '-' }}</td>
                            <td>{{ $sch->year ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- Kompensasi --}}
        <div class="detail-card">
            <div class="detail-card-header"><i class="fal fa-money-bill-wave"></i> Ekspektasi Kompensasi</div>
            <div class="detail-card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-row"><div class="info-label">Gaji yang Diharapkan</div><div class="info-value">{{ $applier->compensation_salary ? 'Rp '.number_format($applier->compensation_salary,0,',','.') : '-' }}</div></div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-row"><div class="info-label">Keuntungan</div><div class="info-value">{{ $applier->compensation_benefit ?? '-' }}</div></div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-row"><div class="info-label">Mulai Bekerja</div><div class="info-value">{{ $applier->compensation_workdate ?? '-' }}</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

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
</script>
@endsection
