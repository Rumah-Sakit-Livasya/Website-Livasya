@extends('inc.layout')

@section('title', 'Daftar Pelamar - ' . $career->title)

@section('content')
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon bx bxs-group text-primary'></i> Pelamar: {{ $career->title }}
            <small>
                Dibuat pada: <strong class="text-dark">{{ $career->created_at ? $career->created_at->format('d M Y') : '-' }}</strong> &bull; Total {{ $appliers->total() }} pelamar ditemukan untuk lowongan ini.
            </small>
        </h1>
        <div class="subheader-block">
            <a href="{{ route('hrd.index') }}" class="btn btn-sm btn-outline-secondary font-weight-bold">
                <i class="fal fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="card p-3 mb-g shadow-xs border-light-blue" style="border-radius: 8px;">
        <form method="GET" action="{{ route('hrd.appliers', $career->id) }}" class="row g-2 align-items-center">
            <div class="col-md-4 mb-2 mb-md-0">
                <input type="text" name="search" class="form-control form-control-custom w-100" placeholder="Cari nama atau email..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3 mb-2 mb-md-0">
                <select name="status" class="form-control form-control-custom w-100">
                    <option value="">Semua Status</option>
                    <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Diproses</option>
                    <option value="accepted"  {{ request('status') == 'accepted'  ? 'selected' : '' }}>Diterima</option>
                    <option value="rejected"  {{ request('status') == 'rejected'  ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="col-auto d-flex align-items-center">
                <button type="submit" class="btn btn-primary btn-filter-custom font-weight-bold mr-1">
                    <i class="fal fa-filter mr-1"></i> Filter
                </button>
                @if(request()->hasAny(['search','status']))
                    <a href="{{ route('hrd.appliers', $career->id) }}" class="btn btn-outline-secondary btn-filter-custom font-weight-bold">
                        <i class="fal fa-times mr-1"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table list --}}
    <div id="panel-appliers-list" class="panel" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        <div class="panel-hdr bg-faded">
            <h2>
                <i class="fal fa-users mr-2 text-primary"></i> Daftar Berkas Pelamar
            </h2>
        </div>
        <div class="panel-container show">
            <div class="panel-content p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered m-0 align-middle-table text-nowrap">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th style="width: 50px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">No</th>
                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Pelamar</th>
                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Kontak</th>
                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Lulusan / Institusi</th>
                                <th style="width: 130px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Tgl Lahir</th>
                                <th style="width: 130px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Status</th>
                                <th style="width: 140px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Waktu Daftar</th>
                                <th style="width: 320px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appliers as $applier)
                            <tr>
                                <td class="text-center font-weight-bold text-muted align-middle">{{ $loop->iteration + ($appliers->currentPage()-1) * $appliers->perPage() }}</td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center" style="gap: 10px;">
                                        @php
                                            $avatar = $applier->user?->avatar;
                                            $initial = strtoupper(substr($applier->first_name ?? 'P', 0, 1));
                                            $bgColors = ['#1a56db', '#16a34a', '#d97706', '#e11d48', '#7c3aed', '#db2777', '#2563eb'];
                                            $colorIndex = (ord($initial) % count($bgColors));
                                            $bgColor = $bgColors[$colorIndex];
                                        @endphp
                                        <div class="avatar-wrapper position-relative" style="width: 36px; height: 36px; flex-shrink: 0;">
                                            @if($avatar)
                                                @php
                                                    if (\Illuminate\Support\Str::startsWith($avatar, ['http://','https://'])) {
                                                        $avatarUrl = $avatar;
                                                    } else {
                                                        $avatarUrl = asset('storage/' . $avatar);
                                                    }
                                                @endphp
                                                <img src="{{ $avatarUrl }}" class="avatar-sm rounded-circle shadow-xs" alt="{{ $applier->first_name }}" 
                                                     style="width: 36px; height: 36px; object-fit: cover; border: 2px solid #e5e7eb; display: block;"
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-flex';">
                                                <div class="avatar-sm rounded-circle shadow-xs d-none align-items-center justify-content-center text-white font-weight-bold" 
                                                     style="width: 36px; height: 36px; background-color: {{ $bgColor }}; font-size: 0.95rem;" 
                                                     title="Avatar tidak tersedia">
                                                    {{ $initial }}
                                                </div>
                                            @else
                                                <div class="avatar-sm rounded-circle shadow-xs d-inline-flex align-items-center justify-content-center text-white font-weight-bold" 
                                                     style="width: 36px; height: 36px; background-color: {{ $bgColor }}; font-size: 0.95rem;">
                                                    {{ $initial }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-weight-bold text-dark" style="font-size: 14px; margin-bottom: 2px;">
                                                {{ $applier->first_name }} {{ $applier->last_name }}
                                            </div>
                                            @if(strtolower($applier->sex) == 'laki-laki' || strtolower($applier->sex) == 'l')
                                                <span class="text-muted" style="font-size: 11px;"><i class="fal fa-mars text-info mr-1"></i> Laki-laki</span>
                                            @else
                                                <span class="text-muted" style="font-size: 11px;"><i class="fal fa-venus text-danger mr-1"></i> Perempuan</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div style="font-size: 13px; color: #374151;" class="font-weight-bold">
                                        <i class="fal fa-envelope text-muted mr-1" style="width: 14px;"></i>{{ $applier->email }}
                                    </div>
                                    <div class="text-muted mt-1" style="font-size: 11px;">
                                        <i class="fal fa-phone text-muted mr-1" style="width: 14px;"></i>{{ $applier->whatsapp_number ?? '-' }}
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div style="font-size: 13px; color: #4b5563;" class="font-weight-bold">
                                        <i class="fal fa-graduation-cap text-muted mr-1" style="width: 16px;"></i>
                                        @php
                                            $educationText = '-';
                                            if ($applier->educations && $applier->educations->isNotEmpty()) {
                                                $latestEdu = $applier->educations->first();
                                                $parts = [];
                                                if ($latestEdu->level) {
                                                    $parts[] = $latestEdu->level;
                                                }
                                                if ($latestEdu->institution) {
                                                    $parts[] = $latestEdu->institution;
                                                }
                                                if (!empty($parts)) {
                                                    $educationText = implode(' - ', $parts);
                                                }
                                            } elseif (!empty($applier->school_name) && $applier->school_name !== '-') {
                                                $parts = [];
                                                if ($applier->school_qual) {
                                                    $parts[] = $applier->school_qual;
                                                }
                                                $parts[] = $applier->school_name;
                                                $educationText = implode(' - ', $parts);
                                            }
                                        @endphp
                                        {{ $educationText }}
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <div style="font-size: 13px; color: #4b5563;">
                                        <i class="fal fa-calendar-alt text-muted mr-1"></i>{{ $applier->birth_day ? \Carbon\Carbon::parse($applier->birth_day)->format('d M Y') : '-' }}
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    @if($applier->status == 'processed')
                                        <span class="badge-status badge-status-processed">Diproses</span>
                                    @elseif($applier->status == 'interview_1')
                                        <span class="badge-status badge-status-interview1">Wawancara 1</span>
                                    @elseif($applier->status == 'interview_2')
                                        <span class="badge-status badge-status-interview2">Wawancara 2</span>
                                    @elseif($applier->status == 'accepted')
                                        <span class="badge-status badge-status-accepted">Diterima</span>
                                    @elseif($applier->status == 'rejected')
                                        <span class="badge-status badge-status-rejected">Ditolak</span>
                                    @else
                                        <span class="badge-status badge-status-secondary">{{ $applier->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center text-muted align-middle" style="font-size: 12px;">
                                    <i class="fal fa-clock mr-1"></i>{{ $applier->created_at->diffForHumans() }}
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-flex align-items-center justify-content-center" style="gap: 6px;">
                                        {{-- Detail --}}
                                        <a href="{{ route('hrd.detail', [$career->id, $applier->id]) }}" class="btn-action-custom btn-action-detail" title="Detail Berkas Pelamar">
                                            <i class="fal fa-eye"></i> Detail
                                        </a>

                                        {{-- Video Conference --}}
                                        @php
                                            $roomName = 'Wawancara - ' . $applier->first_name . ' ' . $applier->last_name;
                                            $vconBaseUrl = rtrim(config('services.vcon.url'), '/');
                                            $vconUrl = $vconBaseUrl . '/rooms/auto-create?room_name=' . urlencode($roomName) . '&display_name=' . urlencode('HRD RS Livasya');
                                        @endphp
                                        <a href="{{ $vconUrl }}" target="_blank" class="btn-action-custom btn-action-vcon" title="Mulai Video Conference Wawancara">
                                            <i class="fal fa-video"></i> Video
                                        </a>

                                        {{-- Terima / Tolak Administrasi --}}
                                        @if($applier->status == 'processed')
                                            {{-- Tombol Terima: buka modal jadwal wawancara --}}
                                            <button type="button"
                                                class="btn-action-custom btn-action-accept btn-icon-only btn-terima-appliers"
                                                data-name="{{ $applier->first_name }} {{ $applier->last_name }}"
                                                data-action-url="{{ route('hrd.status', [$career->id, $applier->id]) }}"
                                                title="Terima Berkas & Lanjut Wawancara">
                                                <i class="fal fa-check"></i>
                                            </button>

                                            <form action="{{ route('hrd.status', [$career->id, $applier->id]) }}" method="POST" class="d-inline">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn-action-custom btn-action-reject btn-icon-only js-confirm" data-msg="Tolak berkas administrasi pelamar ini?" title="Tolak Berkas Administrasi">
                                                    <i class="fal fa-times"></i>
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Wawancara 1 --}}
                                        @if($applier->status == 'interview_1')
                                            <a href="{{ route('hrd.interview.form', [$career->id, $applier->id]) }}" class="btn-action-custom btn-action-interview1" title="Isi Lembar Wawancara Tahap 1">
                                                <i class="fal fa-comments"></i> Wawancara 1
                                            </a>
                                        @endif

                                        {{-- Wawancara 2 --}}
                                        @if($applier->status == 'interview_2')
                                            <a href="{{ route('hrd.interview.form', [$career->id, $applier->id]) }}" class="btn-action-custom btn-action-interview2" title="Review & Isi Wawancara Tahap 2">
                                                <i class="fal fa-user-shield"></i> Wawancara 2
                                            </a>
                                        @endif

                                        {{-- Hasil Wawancara (Finalized) --}}
                                        @if(in_array($applier->status, ['accepted', 'rejected']) && $applier->interview)
                                            <a href="{{ route('hrd.interview.form', [$career->id, $applier->id]) }}" class="btn-action-custom btn-action-result" title="Lihat Hasil Wawancara">
                                                <i class="fal fa-file-invoice"></i> Hasil Wawancara
                                            </a>
                                        @endif

                                        {{-- WhatsApp --}}
                                        @if($applier->whatsapp_number)
                                            @php
                                                $wa = $applier->whatsapp_number;
                                                if (substr($wa,0,1) == '0') $wa = '62'.substr($wa,1);
                                                
                                                $roomSlug = \Illuminate\Support\Str::slug('Wawancara - ' . $applier->first_name . ' ' . $applier->last_name);
                                                $vconBaseUrl = rtrim(config('services.vcon.url'), '/');
                                                $vconInviteUrl = $vconBaseUrl . '/?code=' . $roomSlug;
                                                
                                                $waMsg = "Halo {$applier->first_name}, kami dari HRD RS Livasya. Berikut adalah tautan untuk wawancara video conference kita untuk posisi {$career->title}: {$vconInviteUrl}. Silakan bergabung saat jadwal wawancara dimulai.";
                                            @endphp
                                            <a href="https://wa.me/{{ $wa }}?text={{ urlencode($waMsg) }}" target="_blank" class="btn-action-custom btn-action-whatsapp" title="Chat via WhatsApp">
                                                <i class="fab fa-whatsapp"></i> Chat
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fal fa-users text-muted mb-2" style="font-size: 2.5rem;"></i>
                                    <p class="mb-0">Tidak ada pelamar {{ request('status') ? 'dengan status ini' : 'untuk lowongan ini' }}.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    @if($appliers->hasPages())
        <div class="mt-3 d-flex justify-content-end">
            {{ $appliers->links() }}
        </div>
    @endif
</main>

<style nonce="{{ $nonce }}">
    .border-light-blue {
        border: 1px solid #e2e8f0;
    }
    .align-middle-table td, .align-middle-table th {
        vertical-align: middle !important;
        white-space: nowrap !important;
    }
    .avatar-sm {
        width: 36px;
        height: 36px;
        object-fit: cover;
        border: 2px solid #e2e8f0;
    }

    /* Custom Action Buttons */
    .btn-action-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 32px;
        padding: 0 10px;
        font-size: 11.5px;
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
        font-size: 13px;
        margin-right: 0 !important;
    }
    .btn-action-custom.btn-icon-only {
        width: 32px;
        padding: 0;
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

    .btn-action-interview1 {
        background-color: #fffbeb;
        color: #d97706 !important;
        border-color: #fde68a;
    }
    .btn-action-interview1:hover {
        background-color: #d97706;
        color: #ffffff !important;
        border-color: #d97706;
    }

    .btn-action-interview2 {
        background-color: #f3e8ff;
        color: #7c3aed !important;
        border-color: #e9d5ff;
    }
    .btn-action-interview2:hover {
        background-color: #7c3aed;
        color: #ffffff !important;
        border-color: #7c3aed;
    }

    .btn-action-result {
        background-color: #f9fafb;
        color: #4b5563 !important;
        border-color: #e5e7eb;
    }
    .btn-action-result:hover {
        background-color: #4b5563;
        color: #ffffff !important;
        border-color: #4b5563;
    }

    .btn-action-whatsapp {
        background-color: #ecfdf5;
        color: #10b981 !important;
        border-color: #a7f3d0;
    }
    .btn-action-whatsapp:hover {
        background-color: #10b981;
        color: #ffffff !important;
        border-color: #10b981;
    }

    .btn-action-accept {
        background-color: #ecfdf5;
        color: #10b981 !important;
        border-color: #a7f3d0;
    }
    .btn-action-accept:hover {
        background-color: #10b981;
        color: #ffffff !important;
        border-color: #10b981;
    }

    .btn-action-reject {
        background-color: #fef2f2;
        color: #ef4444 !important;
        border-color: #fecaca;
    }
    .btn-action-reject:hover {
        background-color: #ef4444;
        color: #ffffff !important;
        border-color: #ef4444;
    }

    .btn-action-vcon {
        background-color: #ecfeff;
        color: #0891b2 !important;
        border-color: #a5f3fc;
    }
    .btn-action-vcon:hover {
        background-color: #0891b2;
        color: #ffffff !important;
        border-color: #0891b2;
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
        min-width: 100px;
    }
    .badge-status-processed {
        background-color: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
    }
    .badge-status-interview1 {
        background-color: #e0f2fe;
        color: #0284c7;
        border: 1px solid #bae6fd;
    }
    .badge-status-interview2 {
        background-color: #f3e8ff;
        color: #7c3aed;
        border: 1px solid #e9d5ff;
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

    /* Custom Filter Controls */
    .form-control-custom {
        height: 36px;
        font-size: 13px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 6px 12px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        background-color: #ffffff;
    }
    .form-control-custom:focus {
        border-color: #3b82f6;
        outline: 0;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }
    .btn-filter-custom {
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 16px;
        font-size: 13px;
        font-weight: 600;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
</style>

{{-- Modal Jadwal Wawancara (HRD Appliers) --}}
<div class="modal fade" id="modalJadwalAppliers" tabindex="-1" role="dialog" aria-labelledby="modalJadwalAppliersLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalJadwalAppliersLabel">📅 Jadwal Wawancara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formJadwalAppliers" method="POST">
                @csrf @method('PUT')
                <input type="hidden" name="status" value="accepted">
                <div class="modal-body">
                    <p class="text-muted mb-3">Pelamar: <strong id="appliersModalName"></strong></p>

                    <div class="form-group">
                        <label for="ap_interview_date">Tanggal Wawancara <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="ap_interview_date" name="interview_date" required>
                    </div>

                    <div class="form-group">
                        <label for="ap_interview_time">Waktu Wawancara <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="ap_interview_time" name="interview_time" required>
                    </div>

                    <div class="form-group">
                        <label for="ap_interview_type">Jenis Wawancara <span class="text-danger">*</span></label>
                        <select class="form-control no-select2" id="ap_interview_type" name="interview_type" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="online">Online (Video Conference)</option>
                            <option value="offline">Offline / Tatap Muka</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ap_interview_location" id="apLocationLabel">Lokasi / Keterangan</label>
                        <input type="text" class="form-control" id="ap_interview_location" name="interview_location"
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

// Tombol Terima Appliers -> buka modal jadwal
$(document).on('click', '.btn-terima-appliers', function() {
    var name   = $(this).data('name');
    var action = $(this).data('action-url');

    $('#appliersModalName').text(name);
    $('#formJadwalAppliers').attr('action', action);

    $('#ap_interview_date').val('');
    $('#ap_interview_time').val('');
    $('#ap_interview_type').val('');
    $('#ap_interview_location').val('');
    updateApLocationLabel('');

    $('#modalJadwalAppliers').modal('show');
});

$(document).on('change', '#ap_interview_type', function() {
    updateApLocationLabel($(this).val());
});

function updateApLocationLabel(type) {
    if (type === 'online') {
        $('#apLocationLabel').text('Keterangan Tambahan (opsional)');
        $('#ap_interview_location').attr('placeholder', 'Mis. silakan test kamera sebelum sesi');
    } else if (type === 'offline') {
        $('#apLocationLabel').text('Lokasi / Alamat Wawancara');
        $('#ap_interview_location').attr('placeholder', 'Mis. Gedung A Lt. 3, Jl. Sudirman No.1');
    } else {
        $('#apLocationLabel').text('Lokasi / Keterangan');
        $('#ap_interview_location').attr('placeholder', 'Contoh: Gedung A Lt. 3 atau link akan dikirim via email');
    }
}
</script>
@endsection
