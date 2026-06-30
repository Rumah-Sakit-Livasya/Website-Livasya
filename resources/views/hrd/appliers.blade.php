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
    <div class="card p-3 mb-g shadow-xs border-light-blue">
        <form method="GET" action="{{ route('hrd.appliers', $career->id) }}" class="row g-2 align-items-center">
            <div class="col-md-4 mb-2 mb-md-0">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama atau email..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3 mb-2 mb-md-0">
                <select name="status" class="form-control form-control-sm">
                    <option value="">Semua Status</option>
                    <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Diproses</option>
                    <option value="accepted"  {{ request('status') == 'accepted'  ? 'selected' : '' }}>Diterima</option>
                    <option value="rejected"  {{ request('status') == 'rejected'  ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-primary font-weight-bold px-3">
                    <i class="fal fa-filter mr-1"></i> Filter
                </button>
                @if(request()->hasAny(['search','status']))
                    <a href="{{ route('hrd.appliers', $career->id) }}" class="btn btn-sm btn-outline-secondary ml-1 font-weight-bold">
                        <i class="fal fa-times mr-1"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table list --}}
    <div id="panel-appliers-list" class="panel">
        <div class="panel-hdr bg-faded">
            <h2>
                <i class="fal fa-users mr-2 text-primary"></i> Daftar Berkas Pelamar
            </h2>
        </div>
        <div class="panel-container show">
            <div class="panel-content p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered m-0 align-middle-table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th>Pelamar</th>
                                <th>Kontak</th>
                                <th>Lulusan / Institusi</th>
                                <th style="width: 130px;" class="text-center">Tgl Lahir</th>
                                <th style="width: 120px;" class="text-center">Status</th>
                                <th style="width: 130px;" class="text-center">Waktu Daftar</th>
                                <th style="width: 250px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appliers as $applier)
                            <tr>
                                <td class="text-center font-weight-bold text-muted">{{ $loop->iteration + ($appliers->currentPage()-1) * $appliers->perPage() }}</td>
                                <td>
                                    <div class="d-flex align-items-center" style="gap: 10px;">
                                        @php
                                            $avatar = $applier->user?->avatar;
                                            $avatarExists = false;
                                            $avatarUrl = asset('img/no-image.png');
                                            if ($avatar) {
                                                if (\Illuminate\Support\Str::startsWith($avatar, ['http://','https://'])) {
                                                    $avatarExists = true;
                                                    $avatarUrl = $avatar;
                                                } else {
                                                    $avatarExists = \Illuminate\Support\Facades\Storage::disk('public')->exists($avatar);
                                                    $avatarUrl = asset('storage/' . $avatar);
                                                }
                                            }
                                        @endphp
                                        @if($avatarExists)
                                            <img src="{{ $avatarUrl }}" class="avatar-sm rounded-circle shadow-xs" alt="{{ $applier->first_name }}">
                                        @else
                                            @php
                                                $initial = strtoupper(substr($applier->first_name ?? 'P', 0, 1));
                                                $bgColors = ['#1a56db', '#16a34a', '#d97706', '#e11d48', '#7c3aed', '#db2777', '#2563eb'];
                                                $colorIndex = (ord($initial) % count($bgColors));
                                                $bgColor = $bgColors[$colorIndex];
                                            @endphp
                                            <div class="avatar-sm rounded-circle shadow-xs d-inline-flex align-items-center justify-content-center text-white font-weight-bold" 
                                                 style="width: 36px; height: 36px; background-color: {{ $bgColor }}; font-size: 0.95rem;" 
                                                 title="Avatar tidak tersedia">
                                                {{ $initial }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-weight-bold text-dark fs-md">
                                                {{ $applier->first_name }} {{ $applier->last_name }}
                                            </div>
                                            <small class="text-muted">{{ $applier->sex }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size: .85rem;" class="font-weight-bold">{{ $applier->email }}</div>
                                    <small class="text-muted"><i class="fal fa-phone mr-1"></i>{{ $applier->whatsapp_number ?? '-' }}</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold text-muted">{{ $applier->school_name ?? '-' }}</div>
                                </td>
                                <td class="text-center">{{ $applier->birth_day ? \Carbon\Carbon::parse($applier->birth_day)->format('d M Y') : '-' }}</td>
                                <td class="text-center">
                                    @if($applier->status == 'processed')
                                        <span class="badge badge-warning px-2 py-1" style="border-radius: 4px;">Diproses</span>
                                    @elseif($applier->status == 'accepted')
                                        <span class="badge badge-success px-2 py-1" style="border-radius: 4px;">Diterima</span>
                                    @elseif($applier->status == 'rejected')
                                        <span class="badge badge-danger px-2 py-1" style="border-radius: 4px;">Ditolak</span>
                                    @else
                                        <span class="badge badge-secondary px-2 py-1" style="border-radius: 4px;">{{ $applier->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center text-muted" style="font-size: 0.8rem;">{{ $applier->created_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center" style="gap: 5px;">
                                        {{-- Detail --}}
                                        <a href="{{ route('hrd.detail', [$career->id, $applier->id]) }}" class="btn btn-xs btn-outline-info font-weight-bold" title="Detail Berkas Pelamar">
                                            <i class="fal fa-eye"></i> Detail
                                        </a>

                                        {{-- Terima / Tolak --}}
                                        @if($applier->status == 'processed')
                                            <form action="{{ route('hrd.status', [$career->id, $applier->id]) }}" method="POST" class="d-inline">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit" class="btn btn-xs btn-success font-weight-bold js-confirm" data-msg="Terima pelamar ini?" title="Terima Lamaran Kerja">
                                                    <i class="fal fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('hrd.status', [$career->id, $applier->id]) }}" method="POST" class="d-inline">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-xs btn-danger font-weight-bold js-confirm" data-msg="Tolak pelamar ini?" title="Tolak Lamaran Kerja">
                                                    <i class="fal fa-times"></i>
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
                                            <a href="https://wa.me/{{ $wa }}?text={{ urlencode($waMsg) }}" target="_blank" class="btn btn-xs btn-outline-success font-weight-bold" title="Chat via WhatsApp">
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
        border: 1px solid #e5e7eb;
    }
    .align-middle-table td {
        vertical-align: middle !important;
    }
    .avatar-sm {
        width: 36px;
        height: 36px;
        object-fit: cover;
        border: 2px solid #e5e7eb;
    }
</style>
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
