@extends('inc.layout-blank')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Table <span class="fw-300"><i>Pelamar</i></span>
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th style="white-space: nowrap">No</th>
                                    <th style="white-space: nowrap">Nama</th>
                                    <th style="white-space: nowrap">Jenis Kelamin</th>
                                    <th style="white-space: nowrap">Lulusan</th>
                                    <th style="white-space: nowrap">Tgl. Lahir</th>
                                    <th style="white-space: nowrap">Status</th>
                                    <th style="white-space: nowrap">Input</th>
                                    <th style="white-space: nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appliers as $applier)
                                    <tr>
                                        <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                        <td style="white-space: nowrap">
                                            {{ $applier->first_name }} {{ $applier->last_name ?? '' }}
                                        </td>
                                        <td style="white-space: nowrap">{{ $applier->sex }}</td>
                                        <td style="white-space: nowrap">{{ $applier->school_name }}</td>
                                        <td style="white-space: nowrap">{{ $applier->birth_day }}</td>
                                        <td style="white-space: nowrap">
                                            @if ($applier->status == 'processed')
                                                <span class="badge badge-warning">Diproses</span>
                                            @elseif($applier->status == 'accepted')
                                                <span class="badge badge-success">Diterima</span>
                                            @elseif($applier->status == 'rejected')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $applier->status }}</span>
                                            @endif
                                        </td>
                                        <td style="white-space: nowrap">{{ $applier->created_at->diffForHumans() }}</td>

                                        <td style="white-space: nowrap">
                                            @if ($applier->status == 'processed')
                                                <form
                                                    action="{{ action([\App\Http\Controllers\Pages\CareerController::class, 'updateStatus'], ['career' => $applier->career->id, 'applier' => $applier->id]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button class="badge mx-1 badge-success p-2 border-0 text-white"
                                                        onclick="return confirm('Terima pelamar ini?')">
                                                        <span class="fal fa-check"></span> Terima
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ action([\App\Http\Controllers\Pages\CareerController::class, 'updateStatus'], ['career' => $applier->career->id, 'applier' => $applier->id]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button class="badge mx-1 badge-danger p-2 border-0 text-white"
                                                        onclick="return confirm('Tolak pelamar ini?')">
                                                        <span class="fal fa-times"></span> Tolak
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- Add a new button for opening in a new window -->
                                            <a href="/careers/{{ $applier->career->id }}/{{ $applier->id }}"
                                                class="badge mx-1 badge-info p-2 border-0 text-white open-new-window-button"
                                                data-applier-id="{{ $applier->id }}">
                                                <span class="fal fa-eye"></span> Detail
                                            </a>

                                            <!-- Add a new button for opening in a new window -->
                                            <a href="/careers/{{ $applier->career->id }}/{{ $applier->id }}/download-cv"
                                                class="badge mx-1 badge-warning p-2 border-0 text-white open-new-window-button"
                                                data-applier-id="{{ $applier->id }}">
                                                <span class="fal fa-download"></span> CV
                                            </a>

                                            @php
                                                $waNumber = $applier->whatsapp_number ?? '';
                                                if (substr($waNumber, 0, 1) == '0') {
                                                    $waNumber = '62' . substr($waNumber, 1);
                                                }
                                                $message = "Halo {$applier->first_name}, kami dari HRD RS Livasya terkait lamaran Anda untuk posisi {$applier->career->title}...";
                                            @endphp
                                            @if ($waNumber)
                                                <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($message) }}"
                                                    target="_blank" class="badge mx-1 badge-success p-2 border-0 text-white"
                                                    title="Hubungi via WhatsApp">
                                                    <span class="fab fa-whatsapp"></span> WA
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
