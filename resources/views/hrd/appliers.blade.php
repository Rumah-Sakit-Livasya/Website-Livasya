@extends('hrd.layout')

@section('breadcrumb')
    <div class="hrd-breadcrumb">
        <i class="fal fa-home"></i>
        <a href="{{ route('hrd.index') }}">Dashboard HRD</a>
        <span>/</span>
        <span>{{ $career->title }}</span>
    </div>
@endsection

@section('content')
<style nonce="{{ $nonce }}">
    .filter-bar {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: .75rem;
        align-items: center;
    }
    .filter-bar input, .filter-bar select {
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        padding: .45rem .85rem;
        font-size: .85rem;
        outline: none;
        transition: border-color .2s;
    }
    .filter-bar input:focus, .filter-bar select:focus { border-color: #1a56db; }

    .table-card {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,.06);
    }
    .table-card table thead th {
        background: #f9fafb;
        font-size: .78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #6b7280;
        padding: .85rem 1rem;
        border-bottom: 2px solid #e5e7eb;
        white-space: nowrap;
    }
    .table-card table tbody td {
        padding: .8rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f3f4f6;
        font-size: .875rem;
    }
    .table-card table tbody tr:last-child td { border-bottom: none; }
    .table-card table tbody tr:hover { background: #f9fafb; }

    .badge-status {
        display: inline-flex; align-items: center; gap: .35rem;
        border-radius: 50px; padding: .28rem .75rem; font-size: .75rem; font-weight: 600;
    }
    .badge-processed { background: #fffbeb; color: #d97706; }
    .badge-accepted  { background: #f0fdf4; color: #16a34a; }
    .badge-rejected  { background: #fff1f2; color: #e11d48; }
    .badge-other     { background: #f3f4f6; color: #6b7280; }

    .action-btn {
        display: inline-flex; align-items: center; gap: .3rem;
        border-radius: 7px; padding: .3rem .7rem; font-size: .78rem; font-weight: 600;
        text-decoration: none; border: none; cursor: pointer; transition: opacity .2s, transform .15s;
    }
    .action-btn:hover { opacity: .85; transform: translateY(-1px); }
    .btn-detail  { background: #eff6ff; color: #1a56db; }
    .btn-accept  { background: #f0fdf4; color: #16a34a; }
    .btn-reject  { background: #fff1f2; color: #e11d48; }
    .btn-wa      { background: #f0fdf4; color: #16a34a; }

    .avatar-sm {
        width: 36px; height: 36px; border-radius: 50%; object-fit: cover;
        border: 2px solid #e5e7eb;
    }

    .page-heading { font-size: 1.45rem; font-weight: 800; color: #111827; margin-bottom: .2rem; }
    .page-sub { color: #6b7280; font-size: .875rem; margin-bottom: 1.5rem; }

    .empty-state { text-align: center; padding: 3.5rem 1rem; }
    .empty-state i { font-size: 3rem; color: #d1d5db; }
    .empty-state p { color: #9ca3af; margin-top: .75rem; }
</style>

<div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-1">
    <div>
        <h1 class="page-heading">
            <i class="fal fa-users mr-2" style="color:#1a56db"></i>Pelamar: {{ $career->title }}
        </h1>
        <p class="page-sub">
            Total {{ $appliers->total() }} pelamar ditemukan.
        </p>
    </div>
    <a href="{{ route('hrd.index') }}" class="btn-hrd-outline" style="background:#fff;border:1.5px solid #d1d5db;color:#374151;border-radius:8px;padding:.5rem 1rem;font-size:.85rem;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:.4rem;">
        <i class="fal fa-arrow-left"></i> Kembali
    </a>
</div>

{{-- Filter Bar --}}
<form method="GET" action="{{ route('hrd.appliers', $career->id) }}" class="filter-bar">
    <input type="text" name="search" placeholder="&#xF002; Cari nama atau email..." value="{{ request('search') }}" style="min-width:220px;">
    <select name="status">
        <option value="">Semua Status</option>
        <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Diproses</option>
        <option value="accepted"  {{ request('status') == 'accepted'  ? 'selected' : '' }}>Diterima</option>
        <option value="rejected"  {{ request('status') == 'rejected'  ? 'selected' : '' }}>Ditolak</option>
    </select>
    <button type="submit" style="background:#1a56db;color:#fff;border:none;border-radius:8px;padding:.45rem 1rem;font-size:.85rem;font-weight:600;cursor:pointer;">
        <i class="fal fa-search mr-1"></i> Filter
    </button>
    @if(request()->hasAny(['search','status']))
        <a href="{{ route('hrd.appliers', $career->id) }}" style="color:#6b7280;font-size:.82rem;text-decoration:none;">
            <i class="fal fa-times mr-1"></i> Reset
        </a>
    @endif
</form>

{{-- Table --}}
<div class="table-card">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Pelamar</th>
                <th>Kontak</th>
                <th>Lulusan</th>
                <th>Tanggal Lahir</th>
                <th>Status</th>
                <th>Daftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appliers as $applier)
            <tr>
                <td style="color:#9ca3af">{{ $loop->iteration + ($appliers->currentPage()-1) * $appliers->perPage() }}</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        @php
                            $avatar = $applier->user?->avatar;
                            $avatarUrl = asset('img/no-image.png');
                            if ($avatar) {
                                $avatarUrl = \Illuminate\Support\Str::startsWith($avatar, ['http://','https://'])
                                    ? $avatar
                                    : asset('storage/' . $avatar);
                            }
                        @endphp
                        <img src="{{ $avatarUrl }}" class="avatar-sm" alt="{{ $applier->first_name }}">
                        <div>
                            <div style="font-weight:600;color:#111827">
                                {{ $applier->first_name }} {{ $applier->last_name }}
                            </div>
                            <div style="font-size:.75rem;color:#9ca3af">{{ $applier->sex }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div style="font-size:.82rem">{{ $applier->email }}</div>
                    <div style="font-size:.78rem;color:#9ca3af">{{ $applier->whatsapp_number ?? '-' }}</div>
                </td>
                <td style="font-size:.85rem">{{ $applier->school_name ?? '-' }}</td>
                <td style="font-size:.85rem">{{ $applier->birth_day ? \Carbon\Carbon::parse($applier->birth_day)->format('d M Y') : '-' }}</td>
                <td>
                    @if($applier->status == 'processed')
                        <span class="badge-status badge-processed"><i class="fal fa-clock"></i> Diproses</span>
                    @elseif($applier->status == 'accepted')
                        <span class="badge-status badge-accepted"><i class="fal fa-check"></i> Diterima</span>
                    @elseif($applier->status == 'rejected')
                        <span class="badge-status badge-rejected"><i class="fal fa-times"></i> Ditolak</span>
                    @else
                        <span class="badge-status badge-other">{{ $applier->status }}</span>
                    @endif
                </td>
                <td style="font-size:.8rem;color:#9ca3af">{{ $applier->created_at->diffForHumans() }}</td>
                <td>
                    <div class="d-flex flex-wrap gap-1">
                        {{-- Detail --}}
                        <a href="{{ route('hrd.detail', [$career->id, $applier->id]) }}" class="action-btn btn-detail">
                            <i class="fal fa-eye"></i> Detail
                        </a>

                        {{-- Terima / Tolak --}}
                        @if($applier->status == 'processed')
                            <form action="{{ route('hrd.status', [$career->id, $applier->id]) }}" method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" class="action-btn btn-accept js-confirm" data-msg="Terima pelamar ini?">
                                    <i class="fal fa-check"></i> Terima
                                </button>
                            </form>
                            <form action="{{ route('hrd.status', [$career->id, $applier->id]) }}" method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="action-btn btn-reject js-confirm" data-msg="Tolak pelamar ini?">
                                    <i class="fal fa-times"></i> Tolak
                                </button>
                            </form>
                        @endif

                        {{-- WhatsApp --}}
                        @if($applier->whatsapp_number)
                            @php
                                $wa = $applier->whatsapp_number;
                                if (substr($wa,0,1) == '0') $wa = '62'.substr($wa,1);
                                $waMsg = "Halo {$applier->first_name}, kami dari HRD RS Livasya terkait lamaran Anda untuk posisi {$career->title}.";
                            @endphp
                            <a href="https://wa.me/{{ $wa }}?text={{ urlencode($waMsg) }}" target="_blank" class="action-btn btn-wa">
                                <i class="fab fa-whatsapp"></i> WA
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <div class="empty-state">
                        <i class="fal fa-users"></i>
                        <p>Tidak ada pelamar {{ request('status') ? 'dengan status ini' : 'untuk lowongan ini' }}.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
@if($appliers->hasPages())
    <div class="mt-3 d-flex justify-content-end">
        {{ $appliers->links() }}
    </div>
@endif

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
